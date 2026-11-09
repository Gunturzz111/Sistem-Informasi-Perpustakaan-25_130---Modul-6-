@extends('layouts.app')

@section('title', 'Beranda - Perpustakaan Digital Kampus')

@section('content')
<style>
    .home-page{color:#080808}
    .breadcrumb-bar{background:#fffdf0;border-bottom:1px solid #e8e2b1}
    .breadcrumb-inner{max-width:1200px;margin:auto;padding:27px 24px;font-size:15px;color:#64615a}
    .breadcrumb-inner span{padding:0 12px;color:#aaa}
    .hero{background:#fff8bf;min-height:610px;display:flex;align-items:center}
    .hero-inner{max-width:1200px;width:100%;margin:0 auto;padding:75px 24px 82px}
    .hero-copy{max-width:790px;margin-left:clamp(0px,15vw,275px)}
    .eyebrow{display:inline-block;background:#397ff2;color:#fff;font-size:17px;font-weight:900;padding:15px 25px;border:3px solid #080808;box-shadow:5px 5px 0 #080808;margin-bottom:27px}
    .hero h1{font-size:clamp(42px,5vw,66px);line-height:1.02;letter-spacing:-2.8px;font-weight:950;margin:0 0 28px;max-width:820px}
    .hero-description{font-size:18px;line-height:1.75;color:#39372b;max-width:660px;margin:0 0 30px}
    .hero-meta{display:flex;align-items:center;gap:14px;flex-wrap:wrap;color:#5c594a;font-weight:700;font-size:14px;margin:0 0 26px}
    .hero-meta .divider{color:#b3ac81}
    .topic-list{display:flex;gap:10px;flex-wrap:wrap;max-width:720px}
    .topic{display:inline-block;padding:8px 12px;border:2px solid #080808;background:#fff;font-size:12px;font-weight:900;letter-spacing:.5px}
    .hero-actions{display:flex;gap:14px;flex-wrap:wrap;margin-top:30px}
    .hero-cta{display:inline-flex;align-items:center;justify-content:center;background:#ffd51e;color:#080808;border:2px solid #080808;padding:14px 20px;font-weight:900;box-shadow:5px 5px 0 #080808;transition:transform .15s,box-shadow .15s}
    .hero-cta:hover{transform:translate(2px,2px);box-shadow:3px 3px 0 #080808}
    .hero-cta.outline{background:#fff}
    .content-section{max-width:1200px;margin:0 auto;padding:78px 24px}
    .section-kicker{font-size:12px;font-weight:900;letter-spacing:1.7px;text-transform:uppercase;margin-bottom:14px}
    .section-title{font-size:clamp(32px,4vw,46px);line-height:1.08;letter-spacing:-1.5px;margin:0 0 14px;font-weight:950}
    .section-intro{max-width:650px;line-height:1.75;color:#555;margin:0 0 34px}
    .information-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px}
    .information-box{background:#fff;border:2px solid #080808;padding:28px 25px;min-height:200px;box-shadow:6px 6px 0 #080808;transition:transform .15s,box-shadow .15s}
    .information-box:hover{transform:translate(2px,2px);box-shadow:4px 4px 0 #080808}
    .info-number{display:inline-grid;place-items:center;width:37px;height:37px;background:#ffd51e;border:2px solid #080808;font-weight:950;margin-bottom:22px}
    .information-box h3{font-size:21px;margin:0 0 12px;font-weight:900;letter-spacing:-.4px}
    .information-box p{margin:0;color:#555;line-height:1.7;font-size:15px}
    .collection-banner{background:#fff8bf;border-top:2px solid #080808;border-bottom:2px solid #080808}
    .collection-inner{max-width:1200px;margin:auto;padding:46px 24px;display:flex;align-items:center;justify-content:space-between;gap:28px}
    .collection-inner h2{font-size:clamp(28px,3.5vw,40px);font-weight:950;letter-spacing:-1px;margin:0 0 10px}
    .collection-inner p{margin:0;color:#555;line-height:1.65}
    @media(max-width:850px){.hero{min-height:auto}.hero-inner{padding:65px 24px}.hero-copy{margin-left:0}.hero h1{letter-spacing:-1.7px}.information-grid{grid-template-columns:1fr}.content-section{padding:58px 24px}.collection-inner{align-items:flex-start;flex-direction:column}}
    @media(max-width:560px){.breadcrumb-inner{padding:20px 16px}.hero-inner{padding:52px 18px 60px}.eyebrow{font-size:14px;padding:12px 18px;margin-bottom:23px}.hero h1{font-size:42px;line-height:1.04}.hero-description{font-size:16px}.hero-meta{font-size:12px;gap:8px}.topic{font-size:10px;padding:7px 9px}.content-section{padding:48px 18px}.information-box{padding:23px}.collection-inner{padding:38px 18px}}
</style>

<div class="home-page">
    <div class="breadcrumb-bar">
        <div class="breadcrumb-inner">
            Beranda <span>›</span> Perpustakaan Digital <span>›</span> <strong style="color:#080808">Jelajahi pengetahuan tanpa batas</strong>
        </div>
    </div>

    <section class="hero">
        <div class="hero-inner">
            <div class="hero-copy">
                <div class="eyebrow">Ruang Baca Digital</div>
                <h1>Perpustakaan Kampus: Temukan Bacaan, Buka Wawasan.</h1>
                <p class="hero-description">
                    Satu tempat untuk menjelajahi koleksi buku, menemukan sumber referensi,
                    dan mendukung perjalanan belajar mahasiswa. Cari bacaan berikutnya dan
                    mulai temukan ide baru hari ini.
                </p>
                <div class="hero-meta">
                    <span>Koleksi Perpustakaan Kampus</span><span class="divider">|</span>
                    <span>Belajar · Membaca · Bertumbuh</span>
                </div>
                <div class="topic-list">
                    <span class="topic">KOLEKSI BUKU</span>
                    <span class="topic">KATALOG DIGITAL</span>
                    <span class="topic">SUMBER REFERENSI</span>
                    <span class="topic">LAYANAN PERPUSTAKAAN</span>
                </div>
                <div class="hero-actions">
                    <a href="{{ route('buku.index') }}" class="hero-cta">Jelajahi Daftar Buku ↗</a>
                    @guest
                        <a href="{{ route('login') }}" class="hero-cta outline">Masuk ke Akun</a>
                    @else
                        @can('kelola peminjaman')
                            <a href="{{ route('dashboard') }}" class="hero-cta outline">Buka Dashboard</a>
                        @else
                            @can('melihat riwayat peminjaman sendiri')
                                <a href="{{ route('peminjaman.index') }}" class="hero-cta outline">Peminjaman Saya</a>
                            @endcan
                        @endcan
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="section-kicker">Kenali layanan kami</div>
        <h2 class="section-title">Informasi Perpustakaan</h2>
        <p class="section-intro">Semua yang kamu perlukan untuk menemukan bacaan dan referensi akademik tersedia dalam satu sistem yang mudah digunakan.</p>

        <div class="information-grid">
            <article class="information-box">
                <span class="info-number">01</span>
                <h3>Koleksi Buku</h3>
                <p>Jelajahi berbagai koleksi buku untuk mendukung kegiatan belajar, tugas kuliah, dan pengembangan diri.</p>
            </article>
            <article class="information-box">
                <span class="info-number">02</span>
                <h3>Sumber Referensi</h3>
                <p>Temukan bacaan dan bahan referensi yang membantu memperluas wawasan serta menunjang kegiatan akademik.</p>
            </article>
            <article class="information-box">
                <span class="info-number">03</span>
                <h3>Layanan Perpustakaan</h3>
                <p>Gunakan sistem untuk melihat koleksi dan mengakses layanan perpustakaan sesuai hak akunmu.</p>
            </article>
        </div>
    </section>

    <section class="collection-banner">
        <div class="collection-inner">
            <div>
                <div class="section-kicker">Mulai membaca</div>
                <h2>Ada banyak hal untuk ditemukan.</h2>
                <p>Lihat koleksi yang tersedia dan pilih buku yang ingin kamu jelajahi.</p>
            </div>
            <a href="{{ route('buku.index') }}" class="hero-cta">Lihat Semua Buku ↗</a>
        </div>
    </section>
</div>
@endsection
