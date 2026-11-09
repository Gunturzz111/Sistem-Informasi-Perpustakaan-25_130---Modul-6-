@extends('layouts.app')
@section('title', 'Laporan Perpustakaan')
@section('content')
<div class="container" style="padding-top:24px;padding-bottom:32px">
    <h1>Laporan Perpustakaan</h1>
    <p class="muted">Ringkasan data buku, anggota, dan transaksi peminjaman.</p>

    <div class="card">
        <h3>{{ $jumlahBuku }} Buku</h3>
        <h3>{{ $jumlahAnggota }} Anggota</h3>
        <h3>{{ $totalPeminjaman }} Total Peminjaman</h3>
        <p>Menunggu: <strong>{{ $menunggu }}</strong> |
           Disetujui: <strong>{{ $disetujui }}</strong> |
           Dikembalikan: <strong>{{ $dikembalikan }}</strong></p>
    </div>

    <div class="card">
        <h2>Rincian Peminjaman</h2>
        <table>
            <thead><tr><th>Anggota</th><th>Buku</th><th>Tanggal Pinjam</th><th>Status</th><th>Tanggal Kembali</th></tr></thead>
            <tbody>
            @forelse($peminjaman as $item)
                <tr>
                    <td>{{ $item->anggota->nama ?? '-' }}</td>
                    <td>{{ $item->buku->judul ?? '-' }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ ucfirst($item->status ?? ($item->tanggal_kembali ? 'dikembalikan' : 'menunggu')) }}</td>
                    <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada transaksi peminjaman.</td></tr>
            @endforelse
            </tbody>
        </table>
        {{ $peminjaman->links() }}
    </div>
</div>
@endsection
