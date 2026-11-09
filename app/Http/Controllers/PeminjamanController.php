<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['anggota', 'buku'])->latest('id');
        if ($request->user()->hasRole('siswa')) {
            $anggotaId = $request->user()->anggota?->id;
            $query->where('anggota_id', $anggotaId ?? 0);
        }
        return view('peminjaman.index', [
            'peminjamans' => $query->paginate(15),
            'bukus' => Buku::orderBy('judul')->get(),
            'anggotas' => $request->user()->hasAnyRole(['admin', 'petugas']) ? Anggota::orderBy('nama')->get() : collect(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_id' => ['required', 'exists:bukus,id'],
            'anggota_id' => ['nullable', 'exists:anggotas,id'],
        ]);
        if ($request->user()->hasRole('siswa')) {
            $data['anggota_id'] = $request->user()->anggota?->id;
            abort_unless($data['anggota_id'], 403, 'Profil anggota belum terhubung.');
        } else {
            $request->validate(['anggota_id' => ['required', 'exists:anggotas,id']]);
        }
        Peminjaman::create([
            'anggota_id' => $data['anggota_id'],
            'buku_id' => $data['buku_id'],
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
        ]);
        return back()->with('status', 'Pengajuan peminjaman berhasil dicatat.');
    }

    public function approve(Peminjaman $peminjaman)
    {
        abort_if($peminjaman->status !== 'menunggu', 422, 'Pengajuan ini sudah diproses.');
        $peminjaman->update(['status' => 'disetujui']);
        return back()->with('status', 'Pengajuan peminjaman disetujui.');
    }

    public function returnBook(Peminjaman $peminjaman)
    {
        abort_unless($peminjaman->status === 'disetujui', 422, 'Hanya peminjaman yang disetujui yang dapat dikembalikan.');
        $peminjaman->update(['tanggal_kembali' => now()->toDateString(), 'status' => 'dikembalikan']);
        return back()->with('status', 'Pengembalian berhasil dicatat.');
    }
    // A4: IDOR (KODE RENTAN)
public function show($id)
{
    $peminjaman = Peminjaman::with([
        'anggota',
        'buku'
    ])->findOrFail($id);

    Gate::authorize('view', $peminjaman);

    return view('peminjaman.show', compact('peminjaman'));
}
}
