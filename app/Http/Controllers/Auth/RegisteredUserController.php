<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

/**
 * Registrasi mengikuti pola controller Laravel Breeze, dengan penyesuaian
 * agar akun publik selalu dibuat sebagai siswa dan terhubung ke data anggota.
 */
class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Role tidak pernah diterima dari form registrasi publik.
        $user->assignRole('siswa');

        Anggota::updateOrCreate(['email' => $user->email], [
            'nama' => $user->name,
            'email' => $user->email,
            'no_telepon' => $validated['no_telepon'] ?? '-',
            'user_id' => $user->id,
        ]);

        event(new Registered($user));
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('buku.index')
            ->with('status', 'Registrasi berhasil. Selamat datang di Perpustakaan Digital!');
    }
}
