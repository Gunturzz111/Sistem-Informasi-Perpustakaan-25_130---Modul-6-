@extends('layouts.app')
@section('title','Dashboard Petugas')
@section('content')
<h1>Dashboard Petugas</h1><p class="muted">Panel operasional perpustakaan.</p>
<div class="card"><h3>{{ $jumlahBuku }} Buku</h3><h3>{{ $jumlahPeminjaman }} Peminjaman</h3></div>
<div class="card"><h2>Peminjaman Terbaru</h2>@include('peminjaman.table', ['peminjamans' => $peminjaman])</div>
@endsection
