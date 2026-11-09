<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            return view('dashboard.admin', [
                'jumlahBuku' => Buku::count(),
                'jumlahPengguna' => User::count(),
                'jumlahPeminjaman' => Peminjaman::count(),
                'peminjaman' => Peminjaman::with(['anggota', 'buku'])->latest('id')->take(8)->get(),
            ]);
        }
        if ($user->hasRole('petugas')) {
            return view('dashboard.petugas', [
                'jumlahBuku' => Buku::count(),
                'jumlahPeminjaman' => Peminjaman::count(),
                'peminjaman' => Peminjaman::with(['anggota', 'buku'])->latest('id')->take(8)->get(),
            ]);
        }
        return redirect()->route('buku.index');
    }
}
