<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::with('roles')->orderBy('name')->paginate(15)]);
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate(['role' => ['required', Rule::in(['admin', 'petugas', 'siswa'])]]);
        abort_if($request->user()->id === $user->id && $data['role'] !== 'admin', 422, 'Admin tidak dapat menurunkan role akunnya sendiri.');
        $user->syncRoles([$data['role']]);
        return back()->with('status', 'Role pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        abort_if($request->user()->id === $user->id, 422, 'Anda tidak dapat menghapus akun sendiri.');
        $user->delete();
        return back()->with('status', 'Pengguna berhasil dihapus.');
    }
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'role' => ['required', Rule::in(['admin', 'petugas', 'siswa'])],
        'password' => ['required', 'confirmed', 'min:8'],
        'no_telepon' => ['nullable', 'string', 'max:20'],
    ]);

    DB::transaction(function () use ($data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Tetapkan role oleh Admin, bukan dari registrasi publik.
        $user->assignRole($data['role']);

        // Jika akun Siswa, hubungkan dengan data anggota perpustakaan.
        if ($data['role'] === 'siswa') {
            Anggota::updateOrCreate(
                ['email' => $user->email],
                [
                    'nama' => $user->name,
                    'email' => $user->email,
                    'no_telepon' => $data['no_telepon'] ?? '-',
                    'user_id' => $user->id,
                ]
            );
        }
    });

    return redirect()
        ->route('admin.users.index')
        ->with('status', 'Akun pengguna berhasil dibuat.');
}
}
