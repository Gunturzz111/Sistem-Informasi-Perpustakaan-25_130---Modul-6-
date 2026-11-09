<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index(): View
    {
        // Mengambil buku tanpa mengurutkan berdasarkan created_at
        $buku = Buku::with('kategori')
            ->orderBy('id', 'desc')
            ->get();

        // Mengambil daftar kategori
        $kategori = Kategori::orderBy('nama')->get();

        // Memeriksa hak akses pengguna
        $canManage = auth()->check()
            && auth()->user()->can('kelola data buku');

        return view('buku.index', compact(
            'buku',
            'kategori',
            'canManage'
        ));
    }

    public function show($id): View
    {
        $dataBuku = Buku::with('kategori')
            ->findOrFail($id);

        return view('buku.show', compact('dataBuku'));
    }
// A2: SQL Injection SUDAH DIPERBAIKI
public function cariRentan(Request $request)
{
    $judul = $request->query('judul', '');

    $buku = DB::select(
        'SELECT * FROM bukus WHERE judul = ?',
        [$judul]
    );

    return response()->json($buku);
}
}