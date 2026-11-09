<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->filled('cari')) {
            $cari = $request->string('cari')->toString();
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                    ->orWhere('penulis', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->integer('kategori'));
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->integer('tahun'));
        }

        return BukuResource::collection(
            $query->orderByDesc('id')->paginate(100)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'judul' => 'required|string|min:3|max:200',
            'penulis' => 'required|string|min:3|max:150',
            'tahun_terbit' => 'required|integer|between:1900,' . date('Y'),
        ], [
            'kategori_id.required' => 'Kategori buku wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak ditemukan.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.min' => 'Judul buku minimal 3 karakter.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penulis.min' => 'Nama penulis minimal 3 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.between' => 'Tahun terbit harus antara 1900 dan tahun sekarang.',
        ]);

        $buku = Buku::create($validated);
        $buku->load('kategori');

        return (new BukuResource($buku))
            ->additional(['pesan' => 'Buku berhasil ditambahkan.'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $buku = Buku::with('kategori')->find($id);

        if (!$buku) {
            return response()->json(['pesan' => 'Data buku tidak ditemukan.'], 404);
        }

        return new BukuResource($buku);
    }

    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json(['pesan' => 'Data buku tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'judul' => 'required|string|min:3|max:200',
            'penulis' => 'required|string|min:3|max:150',
            'tahun_terbit' => 'required|integer|between:1900,' . date('Y'),
        ], [
            'kategori_id.required' => 'Kategori buku wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak ditemukan.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.min' => 'Judul buku minimal 3 karakter.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penulis.min' => 'Nama penulis minimal 3 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.between' => 'Tahun terbit harus antara 1900 dan tahun sekarang.',
        ]);

        $buku->update($validated);
        $buku->load('kategori');

        return (new BukuResource($buku))
            ->additional(['pesan' => 'Data buku berhasil diperbarui.']);
    }

    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json(['pesan' => 'Data buku tidak ditemukan.'], 404);
        }

        try {
            $buku->delete();
            return response()->json(['pesan' => 'Buku berhasil dihapus.']);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => 'Buku tidak dapat dihapus karena masih memiliki data peminjaman.',
            ], 409);
        }
    }
}
