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
        $user = $request->user();
        $query = Peminjaman::with(['anggota', 'buku'])->latest('id');

        if ($user->hasRole('siswa')) {
            $anggota = $user->anggota ?: Anggota::where('email', $user->email)->first();
            $query->where('anggota_id', $anggota?->id ?? 0);
        }

        return view('peminjaman.index', [
            'peminjamans' => $query->paginate(15),
            'bukus' => Buku::orderBy('judul')->get(),
            'anggotas' => $user->hasAnyRole(['admin', 'petugas'])
                ? Anggota::orderBy('nama')->get()
                : collect(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_id' => ['required', 'exists:bukus,id'],
            'anggota_id' => ['nullable', 'exists:anggotas,id'],
        ]);

        if ($request->user()->hasRole('siswa')) {
            $user = $request->user();
            $anggota = $user->anggota;

            // Hubungkan akun siswa lama dengan data anggota berdasarkan email,
            // atau buat profil anggota bila belum tersedia.
            if (!$anggota) {
                $anggota = Anggota::firstOrCreate(
                    ['email' => $user->email],
                    [
                        'nama' => $user->name,
                        'no_telepon' => '-',
                        'user_id' => $user->id,
                    ]
                );

                if (!$anggota->user_id) {
                    $anggota->user_id = $user->id;
                    $anggota->save();
                }
            }

            $anggotaId = $anggota->id;
        } else {
            $request->validate([
                'anggota_id' => ['required', 'exists:anggotas,id'],
            ]);
            $anggotaId = $data['anggota_id'];
        }

        Peminjaman::create([
            'anggota_id' => $anggotaId,
            'buku_id' => $data['buku_id'],
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
            'status' => 'menunggu',
        ]);

        return redirect()->route('peminjaman.index')
            ->with('status', 'Pengajuan peminjaman berhasil dicatat dan menunggu persetujuan petugas.');
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
        $peminjaman->update([
            'tanggal_kembali' => now()->toDateString(),
            'status' => 'dikembalikan',
        ]);

        return back()->with('status', 'Pengembalian berhasil dicatat.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->findOrFail($id);
        Gate::authorize('view', $peminjaman);

        return view('peminjaman.show', compact('peminjaman'));
    }
}
