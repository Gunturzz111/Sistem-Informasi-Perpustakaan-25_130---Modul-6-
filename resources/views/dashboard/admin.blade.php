@extends('layouts.app')
@section('title','Dashboard Admin')
@section('content')
<h1>Dashboard Admin</h1><p class="muted">Ringkasan administrasi perpustakaan.</p>
<div class="card"><h3>{{ $jumlahBuku }} Buku</h3><h3>{{ $jumlahPengguna }} Pengguna</h3><h3>{{ $jumlahPeminjaman }} Peminjaman</h3></div>
<div class="card"><h2>Peminjaman Terbaru</h2>@include('peminjaman.table', ['peminjamans' => $peminjaman])</div>
@endsection
