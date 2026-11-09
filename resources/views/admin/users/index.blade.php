@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

<h1>Kelola Pengguna & Role</h1>

{{-- Pesan sukses --}}
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

{{-- Pesan error validasi --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM TAMBAH PENGGUNA --}}
<div class="card" style="margin-bottom: 25px; padding: 20px;">

    <h2>Tambah Akun Pengguna</h2>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Nama Lengkap</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Nomor Telepon (khusus Siswa)</label>
            <input type="text"
                   name="no_telepon"
                   value="{{ old('no_telepon') }}"
                   style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Role Pengguna</label>
            <select name="role" required
                    style="width:100%; padding:10px;">
                <option value="">-- Pilih Role --</option>
                <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                <option value="petugas" @selected(old('role') == 'petugas')>Petugas</option>
                <option value="siswa" @selected(old('role') == 'siswa')>Siswa</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Password</label>
            <input type="password"
                   name="password"
                   required
                   style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   required
                   style="width:100%; padding:10px;">
        </div>

        <button type="submit">Tambah Pengguna</button>
    </form>
</div>

{{-- DAFTAR PENGGUNA --}}
<div class="card">

    <h2>Daftar Pengguna</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Ubah Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>
                        {{ $user->getRoleNames()->implode(', ') }}
                    </td>

                    <td>
                        <form method="POST"
                              action="{{ route('admin.users.role', $user) }}">
                            @csrf
                            @method('PATCH')

                            <select name="role">
                                @foreach(['admin', 'petugas', 'siswa'] as $role)
                                    <option value="{{ $role }}"
                                        @selected($user->hasRole($role))>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit">Simpan</button>
                        </form>
                    </td>

                    <td>
                        <form method="POST"
                              action="{{ route('admin.users.destroy', $user) }}"
                              onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

</div>

@endsection