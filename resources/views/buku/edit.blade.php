@extends('layouts.app')

@section('title', 'Ubah Buku - Perpustakaan Digital')

@section('content')
<div class="container" style="max-width:850px;padding-top:30px;padding-bottom:36px">
    <section class="card">
        <h1>Ubah Buku</h1>
        <form method="POST" action="{{ route('buku.update', $dataBuku->id) }}">
            @csrf
            @method('PUT')
            <label for="kategori_id">Kategori</label>
            <select id="kategori_id" name="kategori_id" required>
                @foreach($kategori as $item)
                    <option value="{{ $item->id }}" @selected(old('kategori_id', $dataBuku->kategori_id) == $item->id)>{{ $item->nama }}</option>
                @endforeach
            </select>

            <label for="judul">Judul buku</label>
            <input id="judul" name="judul" value="{{ old('judul', $dataBuku->judul) }}" required minlength="3" maxlength="200">

            <label for="penulis">Penulis</label>
            <input id="penulis" name="penulis" value="{{ old('penulis', $dataBuku->penulis) }}" required minlength="3" maxlength="150">

            <label for="tahun_terbit">Tahun terbit</label>
            <input id="tahun_terbit" name="tahun_terbit" type="number" min="1900" max="{{ date('Y') }}" value="{{ old('tahun_terbit', $dataBuku->tahun_terbit) }}" required>

            <div style="display:flex;gap:10px;margin-top:16px">
                <button type="submit">Simpan Perubahan</button>
                <a class="btn" href="{{ route('buku.index') }}">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
