<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    @vite(['resources/css/app.css'])
    <style>
        :root{--ink:#080808;--paper:#fff8bf;--cream:#fffdf0;--blue:#397ff2;--yellow:#ffd51d}
        *{box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{margin:0;background:#fff;color:var(--ink);font-family:Arial,Helvetica,sans-serif;font-size:16px}
        a{color:inherit;text-decoration:none}
        .container{width:100%;max-width:1240px;margin:0 auto;padding:0 28px}
        .site-header{position:sticky;top:0;z-index:100;background:#fff;border-top:3px solid #080808;border-bottom:3px solid #080808}
        .header-inner{min-height:76px;display:flex;align-items:center;justify-content:space-between;gap:24px}
        .brand{display:flex;align-items:center;gap:12px;font-size:15px;font-weight:900;white-space:nowrap;letter-spacing:-.4px;flex-shrink:0}
        .brand-mark{width:43px;height:43px;border:3px solid #080808;display:grid;place-items:center;background:var(--yellow);font-weight:900;font-size:22px;box-shadow:4px 4px 0 #080808;flex-shrink:0}
        .brand small{background:var(--yellow);font-size:10px;padding:2px 4px}
        .nav-actions{display:flex;align-items:center;justify-content:flex-end;gap:14px;white-space:nowrap;flex-shrink:0}
        .nav-user{font-size:13px;font-weight:700;max-width:180px;overflow:hidden;text-overflow:ellipsis}
        .nav-button,.btn,button{display:inline-flex;align-items:center;justify-content:center;background:var(--yellow);color:#080808;border:2px solid #080808;padding:10px 16px;font-weight:900;font-size:13px;box-shadow:3px 3px 0 #080808;cursor:pointer;transition:transform .15s,box-shadow .15s}
        .nav-button:hover,.btn:hover,button:hover{transform:translate(2px,2px);box-shadow:1px 1px 0 #080808}
        .nav-button.secondary,.nav-button.logout{background:#fff}
        .inline{display:inline;margin:0}
        .nav-bar{background:#fff8bf;border-top:1px solid #080808}
        .nav-inner{display:flex;align-items:center;justify-content:flex-start;min-height:52px}
        .nav{display:flex;align-items:center;justify-content:flex-start;gap:6px;flex-wrap:nowrap;width:100%;min-width:0}
        .nav a{display:inline-flex;align-items:center;justify-content:center;min-height:36px;padding:8px 13px;border:1px solid transparent;font-size:13px;font-weight:800;white-space:nowrap;transition:background .15s,color .15s,border-color .15s}
        .nav a:hover{background:var(--yellow);border-color:#080808;color:#080808}
        main{padding-top:0;padding-bottom:0;min-height:60vh}
        main.container{max-width:none;padding:0}
        .flash-wrap{max-width:1200px;margin:20px auto;padding:0 24px}
        .card{background:#fff;border:2px solid #080808;padding:22px;margin:16px 0;box-shadow:5px 5px 0 #080808}
        input,select,textarea{padding:11px 12px;border:2px solid #111;border-radius:0;width:100%;box-sizing:border-box;margin:5px 0 14px;background:#fff}
        label{font-weight:800}.muted{color:#555}.success{padding:12px 15px;background:#e7f8e8;color:#14532d;border:2px solid #111}
        table{width:100%;border-collapse:collapse}td,th{text-align:left;padding:11px;border-bottom:1px solid #ddd}
        footer{background:#080808;color:#fff;padding:28px 24px;text-align:center;font-size:13px;margin-top:0}
        @media(max-width:1050px){
            .header-inner{min-height:72px;gap:16px}
            .nav-inner{padding-top:7px;padding-bottom:7px}
            .nav{flex-wrap:wrap;gap:5px}
            .nav a{padding:8px 10px}
        }
        @media(max-width:620px){
            .container{padding:0 16px}
            .header-inner{padding-top:12px;padding-bottom:12px;gap:12px}
            .brand{font-size:12px;gap:9px}
            .brand-mark{width:36px;height:36px;font-size:19px;box-shadow:3px 3px 0 #080808}
            .brand small{font-size:9px}
            .nav-user{display:none}
            .nav-actions{gap:8px}
            .nav-button{padding:8px 10px;font-size:12px;box-shadow:2px 2px 0 #080808}
            .nav-inner{padding-top:6px;padding-bottom:6px}
            .nav{gap:4px}
            .nav a{min-height:32px;padding:7px 8px;font-size:12px}
        }
    </style>
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="Perpustakaan Digital">
            <span class="brand-mark">G</span>
            <span>PERPUSTAKAAN<br><small>MAS YUNTUR</small></span>
        </a>
        <div class="nav-actions">
            @auth
                <span class="nav-user" title="{{ auth()->user()->name }}">{{ auth()->user()->name }}</span>
                <form class="inline" method="POST" action="{{ route('logout') }}">@csrf<button class="nav-button logout" type="submit">Keluar</button></form>
            @else
                <a class="nav-button secondary" href="{{ route('login') }}">Masuk</a>
                <a class="nav-button" href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>
    <div class="nav-bar">
        <div class="container nav-inner">
            <nav class="nav" aria-label="Navigasi utama">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('buku.index') }}">Daftar Buku</a>
                @auth
                    @can('kelola peminjaman')<a href="{{ route('dashboard') }}">Dashboard</a>@endcan
                    @can('kelola peminjaman')<a href="{{ route('peminjaman.index') }}">Peminjaman</a>
                    @else @can('melihat riwayat peminjaman sendiri')<a href="{{ route('peminjaman.index') }}">Peminjaman Saya</a>@endcan @endcan
                    @can('kelola data pengguna')<a href="{{ route('admin.users.index') }}">Pengguna</a>@endcan
                    @can('lihat laporan perpustakaan')<a href="{{ route('laporan.index') }}">Laporan</a>@endcan
                    @can('lihat profil sendiri')<a href="{{ route('profile.edit') }}">Profil</a>@endcan
                @endauth
            </nav>
        </div>
    </div>
</header>
@if(session('status') || $errors->any())
    <div class="flash-wrap">
        @if(session('status'))<div class="success">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="card" style="color:#a11">{{ $errors->first() }}</div>@endif
    </div>
@endif
<main>
    @yield('content')
</main>
<footer>© {{ date('Y') }} Perpustakaan Digital Kampus · Ruang untuk membaca, belajar, dan bertumbuh.</footer>
</body>
</html>
