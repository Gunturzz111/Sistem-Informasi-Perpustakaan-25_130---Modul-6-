@extends('layouts.app')
@section('title','Peminjaman')
@section('content')
<h1>{{ auth()->user()->hasRole('siswa') ? 'Riwayat Peminjaman Saya' : 'Pengelolaan Peminjaman' }}</h1>
@can('mengajukan peminjaman buku')
<div class="card"><h2>Ajukan Peminjaman Buku</h2>
<form method="POST" action="{{ route('peminjaman.store') }}">@csrf
<label>Pilih Buku</label><select name="buku_id" required><option value="">-- Pilih buku --</option>@foreach($bukus as $buku)<option value="{{ $buku->id }}">{{ $buku->judul }}</option>@endforeach</select>
@hasanyrole('admin|petugas')
<label>Anggota</label><select name="anggota_id" required><option value="">-- Pilih anggota --</option>@foreach($anggotas as $anggota)<option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>@endforeach</select>
@endhasanyrole
<button type="submit">Simpan Pengajuan</button></form></div>
@endcan
<div class="card">@include('peminjaman.table', ['peminjamans' => $peminjamans])
{{ $peminjamans->links() }}</div>
@endsection
