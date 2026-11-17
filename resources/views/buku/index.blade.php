@extends('layouts.app')

@section('title', 'Koleksi Buku - Perpustakaan Digital')

@section('content')
<style>
    .books-wrap{max-width:1240px;margin:28px auto;padding:0 24px}
    .books-head{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
    .books-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(235px,1fr));gap:18px;margin-top:20px}
    .book-item{border:2px solid #080808;box-shadow:4px 4px 0 #080808;background:#fff;display:flex;flex-direction:column}
    .book-body{padding:16px;display:flex;flex-direction:column;gap:8px;flex:1}
    .book-tag{display:inline-block;background:#fff1a8;border:1px solid #111;padding:5px 8px;font-size:12px;font-weight:800;width:max-content}
    .book-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:auto;padding-top:12px}
    .book-actions form{display:inline}
    .btn-small{padding:8px 11px;font-size:12px}
    .btn-danger{background:#ffdede}
    .book-search{max-width:360px}
    .form-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:12px}
    .muted{color:#555}
</style>

<div class="books-wrap">
    <div class="books-head">
        <div>
            <h1 style="margin:0 0 6px">Koleksi Buku</h1>
            <p class="muted" style="margin:0">Temukan buku dan ajukan peminjaman.</p>
        </div>
        <input class="book-search" id="book-search" type="search" placeholder="Cari judul, penulis, kategori...">
    </div>

    @can('kelola-buku')
        <section class="card" id="form-tambah">
            <h2 style="margin-top:0">Tambah Buku</h2>
            <form method="POST" action="{{ route('buku.store') }}">
                @csrf
                <div class="form-grid">
                    <div>
                        <label for="kategori_id">Kategori</label>
                        <select id="kategori_id" name="kategori_id" required>
                            <option value="">Pilih kategori</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="judul">Judul buku</label>
                        <input id="judul" name="judul" value="{{ old('judul') }}" required minlength="3" maxlength="200">
                    </div>
                    <div>
                        <label for="penulis">Penulis</label>
                        <input id="penulis" name="penulis" value="{{ old('penulis') }}" required minlength="3" maxlength="150">
                    </div>
                    <div>
                        <label for="tahun_terbit">Tahun terbit</label>
                        <input id="tahun_terbit" name="tahun_terbit" type="number" min="1900" max="{{ date('Y') }}" value="{{ old('tahun_terbit') }}" required>
                    </div>
                </div>
                <button type="submit">Simpan Buku</button>
            </form>
        </section>
    @endcan

    <section class="books-grid" id="books-grid">
        @forelse($buku as $item)
            <article class="book-item" data-search="{{ \Illuminate\Support\Str::lower($item->judul.' '.$item->penulis.' '.($item->kategori->nama ?? '')) }}">
                <div style="height:130px;background:#fff1a8;display:grid;place-items:center;font-size:52px">📚</div>
                <div class="book-body">
                    <span class="book-tag">{{ $item->kategori->nama ?? 'Tanpa Kategori' }}</span>
                    <h3 style="margin:0">{{ $item->judul }}</h3>
                    <div class="muted">Penulis: {{ $item->penulis }}</div>
                    <div class="muted">Tahun: {{ $item->tahun_terbit }}</div>
                    <div class="book-actions">
                        <a class="btn btn-small" href="{{ route('buku.show', $item->id) }}">Detail</a>

                        @can('kelola-buku')
                            <a class="btn btn-small" href="{{ route('buku.edit', $item->id) }}">Ubah</a>
                            <form method="POST" action="{{ route('buku.destroy', $item->id) }}" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-small btn-danger" type="submit">Hapus</button>
                            </form>
                        @else
                            @can('mengajukan peminjaman buku')
                                <form method="POST" action="{{ route('peminjaman.store') }}">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $item->id }}">
                                    <button class="btn-small" type="submit">Pinjam Buku</button>
                                </form>
                            @endcan
                        @endcan
                    </div>
                </div>
            </article>
        @empty
            <div class="card">Belum ada buku tersedia.</div>
        @endforelse
    </section>
</div>

<script>
document.getElementById('book-search')?.addEventListener('input', function () {
    const term = this.value.toLowerCase().trim();
    document.querySelectorAll('.book-item').forEach(card => {
        card.hidden = !card.dataset.search.includes(term);
    });
});
</script>
@endsection
