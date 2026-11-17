@extends('layouts.app')

@section('title', 'Detail Buku - Perpustakaan Digital')

@section('content')
<div class="container" style="max-width:900px;padding-top:30px;padding-bottom:36px">
    <p><a href="{{ route('buku.index') }}">← Kembali ke koleksi buku</a></p>

    <section class="card">
        <span class="book-tag" style="display:inline-block;background:#fff1a8;padding:6px 10px;font-weight:800">
            {{ $dataBuku->kategori->nama ?? 'Tanpa Kategori' }}
        </span>
        <h1>{{ $dataBuku->judul }}</h1>
        <p><strong>Penulis:</strong> {{ $dataBuku->penulis }}</p>
        <p><strong>Tahun terbit:</strong> {{ $dataBuku->tahun_terbit }}</p>
        <p><strong>ID Buku:</strong> {{ $dataBuku->id }}</p>

        @can('mengajukan peminjaman buku')
            @if(auth()->user()->hasRole('siswa'))
                <form method="POST" action="{{ route('peminjaman.store') }}">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $dataBuku->id }}">
                    <button type="submit">Pinjam Buku Ini</button>
                </form>
            @endif
        @endcan

        @can('kelola-buku')
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:16px">
                <a class="btn" href="{{ route('buku.edit', $dataBuku->id) }}">Ubah Buku</a>
                <form method="POST" action="{{ route('buku.destroy', $dataBuku->id) }}" onsubmit="return confirm('Hapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus Buku</button>
                </form>
            </div>
        @endcan
    </section>
</div>
@endsection
