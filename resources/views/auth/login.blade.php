@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="card" style="max-width:480px;margin:30px auto">
<h1>Login Pengguna</h1><p class="muted">Masuk menggunakan email dan kata sandi terdaftar.</p>
<form method="POST" action="{{ route('login.store') }}">@csrf
<label>Email</label><input type="email" name="email" value="{{ old('email') }}" required autofocus>
<label>Kata Sandi</label><input type="password" name="password" required>
<label><input type="checkbox" name="remember" value="1" style="width:auto"> Ingat saya</label>
<button type="submit">Login</button>
</form><p>Belum punya akun? <a href="{{ route('register') }}">Registrasi</a></p>
</div>
@endsection
