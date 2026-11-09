@extends('layouts.app')
@section('title','Profil Saya')
@section('content')
<div class="card" style="max-width:620px"><h1>Profil Saya</h1>
<form method="POST" action="{{ route('profile.update') }}">@csrf @method('PATCH')
<label>Nama</label><input name="name" value="{{ old('name',$user->name) }}" required>
<label>Email</label><input type="email" name="email" value="{{ old('email',$user->email) }}" required>
<button type="submit">Simpan Perubahan</button></form></div>
@endsection
