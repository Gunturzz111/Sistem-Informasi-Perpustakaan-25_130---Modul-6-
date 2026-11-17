<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function index(): View
    {
        $buku = Buku::with('kategori')->orderByDesc('id')->get();
        $kategori = Kategori::orderBy('nama')->get();
        $canManage = auth()->check() && auth()->user()->can('kelola-buku');

        return view('buku.index', compact('buku', 'kategori', 'canManage'));
    }

    public function show($id): View
    {
        $dataBuku = Buku::with('kategori')->findOrFail($id);
        return view('buku.show', compact('dataBuku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'integer', 'exists:kategoris,id'],
            'judul' => ['required', 'string', 'min:3', 'max:200'],
            'penulis' => ['required', 'string', 'min:3', 'max:150'],
            'tahun_terbit' => ['required', 'integer', 'between:1900,' . date('Y')],
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')->with('status', 'Buku berhasil ditambahkan.');
    }

    public function edit($id): View
    {
        $dataBuku = Buku::findOrFail($id);
        $kategori = Kategori::orderBy('nama')->get();

        return view('buku.edit', compact('dataBuku', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => ['required', 'integer', 'exists:kategoris,id'],
            'judul' => ['required', 'string', 'min:3', 'max:200'],
            'penulis' => ['required', 'string', 'min:3', 'max:150'],
            'tahun_terbit' => ['required', 'integer', 'between:1900,' . date('Y')],
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')->with('status', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        try {
            $buku->delete();
        } catch (QueryException $e) {
            return redirect()->route('buku.index')
                ->withErrors(['buku' => 'Buku tidak dapat dihapus karena masih memiliki riwayat peminjaman.']);
        }

        return redirect()->route('buku.index')->with('status', 'Buku berhasil dihapus.');
    }

    // Pencarian menggunakan parameter binding.
    public function cariRentan(Request $request)
    {
        $judul = $request->query('judul', '');
        $buku = DB::select('SELECT * FROM bukus WHERE judul = ?', [$judul]);

        return response()->json($buku);
    }
}
