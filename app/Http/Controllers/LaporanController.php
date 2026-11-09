<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->latest('id')
            ->paginate(20);

        return view('laporan.index', [
            'peminjaman' => $peminjaman,
            'jumlahBuku' => Buku::count(),
            'jumlahAnggota' => Anggota::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui' => Peminjaman::where('status', 'disetujui')->count(),
            'dikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),
        ]);
    }
}
