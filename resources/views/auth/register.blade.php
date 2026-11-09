@extends('layouts.app')
@section('title','Registrasi')
@section('content')
<div class="card" style="max-width:480px;margin:30px auto">
<h1>Registrasi Siswa</h1><p class="muted">Akun baru akan otomatis mendapat role siswa.</p>
<form method="POST" action="{{ route('register.store') }}">@csrf
<label>Nama lengkap</label><input name="name" value="{{ old('name') }}" required>
<label>Email</label><input type="email" name="email" value="{{ old('email') }}" required>
<label>Nomor telepon</label><input name="no_telepon" value="{{ old('no_telepon') }}">
<label>Kata sandi</label><input type="password" name="password" required>
<label>Konfirmasi kata sandi</label><input type="password" name="password_confirmation" required>
<button type="submit">Daftar</button>
</form><p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
