<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Koleksi Buku - Perpustakaan GTR</title>

    <style>
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:#fff;color:#080808;font-family:Arial,Helvetica,sans-serif;font-size:16px}a{color:inherit;text-decoration:none}
.site-header{background:#fff;border-top:3px solid #080808;border-bottom:3px solid #080808}.header-container{max-width:1200px;min-height:72px;margin:auto;padding:12px 24px;display:flex;align-items:center;gap:32px}.logo{width:42px;height:42px;flex:0 0 42px;display:grid;place-items:center;background:#ffd51e;border:3px solid #080808;color:#080808;font-size:22px;font-weight:900;box-shadow:4px 4px 0 #080808}.header-info{display:flex;align-items:center;gap:10px}.header-info h1{margin:0;font-size:15px;font-weight:900;line-height:1.1}.header-info p{display:none}.navbar{background:#fff}.navbar-container{max-width:1200px;min-height:0;margin:auto;padding:0 24px 14px;display:flex;justify-content:space-between;align-items:center;gap:18px}.navbar-brand{display:none}.navbar-menu{display:flex;flex-wrap:wrap;gap:clamp(14px,2.4vw,32px);align-items:center}.nav-link{color:#080808;font-size:15px;font-weight:800}.nav-link:hover{color:#8a6c00;text-decoration:underline;text-decoration-thickness:2px;text-underline-offset:5px}
.page-container{max-width:none;margin:0 auto;padding:18px 24px 24px}.page-title{margin-bottom:20px}.page-title h1{margin:0 0 8px;font-size:30px}.page-title p,.collection-heading p{color:#555;line-height:1.5;margin:0}.panel{background:#fff;border:2px solid #080808;border-radius:0;padding:20px;margin-bottom:18px;box-shadow:5px 5px 0 #080808}.panel h2{margin:0 0 14px;font-size:22px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px 22px}.form-group{display:flex;flex-direction:column;gap:7px}.form-group label{font-size:14px;font-weight:800}.form-group input,.form-group select,.search-input{width:100%;padding:11px 12px;border:2px solid #111;border-radius:0;font-size:14px;background:#fff;color:#080808}.form-group input:focus,.form-group select:focus,.search-input:focus{outline:2px solid #ffd51e;outline-offset:1px}.btn-primary,.btn-detail,.btn-secondary,.btn-edit,.btn-delete,button{display:inline-flex;align-items:center;justify-content:center;border:2px solid #080808;border-radius:0;padding:10px 15px;font-size:14px;font-weight:900;cursor:pointer;transition:transform .15s,box-shadow .15s;background:#ffd51e;color:#080808;box-shadow:3px 3px 0 #080808}button:hover,.btn-primary:hover,.btn-detail:hover,.btn-secondary:hover,.btn-edit:hover,.btn-delete:hover{transform:translate(2px,2px);box-shadow:1px 1px 0 #080808}button:disabled{opacity:.6;cursor:not-allowed}.btn-secondary{background:#fff}.btn-edit{background:#ffd51e}.btn-delete{background:#fff;color:#b91c1c;border-color:#b91c1c;box-shadow:3px 3px 0 #b91c1c}.form-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:20px}.message{display:none;padding:12px 14px;border:2px solid #080808;margin-bottom:16px;line-height:1.5;overflow-wrap:anywhere}.message.success{display:block;background:#f0fdf4;color:#166534}.message.error{display:block;background:#fff1f2;color:#991b1b}.message.info{display:block;background:#fff8bf;color:#080808}.collection-heading{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px;margin-bottom:20px}.collection-heading h2{margin-bottom:5px}.search-box{width:100%;max-width:380px}
.book-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}.book-card{min-width:0;display:flex;flex-direction:column;overflow:hidden;background:#fff;border:2px solid #080808;border-radius:0;box-shadow:4px 4px 0 #080808;transition:transform .15s}.book-card:hover{transform:translate(2px,2px);box-shadow:2px 2px 0 #080808}.book-cover{height:220px;display:flex;justify-content:center;align-items:center;overflow:hidden;background:#ffd51e;border-bottom:2px solid #080808}.book-cover img{width:100%;height:100%;object-fit:contain;background:#fff}.book-placeholder{font-size:68px}.book-info{flex:1;display:flex;flex-direction:column;align-items:flex-start;text-align:left;padding:18px}.book-info h3{margin:0 0 10px;font-size:19px;line-height:1.35;overflow-wrap:anywhere}.book-meta{margin:4px 0;color:#555;font-size:14px;line-height:1.5}.book-category{display:inline-block;padding:5px 9px;margin-bottom:10px;border:1px solid #080808;background:#fff8bf;color:#080808;font-size:12px;font-weight:800}.book-actions{display:flex;justify-content:flex-start;flex-wrap:wrap;gap:9px;margin-top:auto;padding-top:18px}.empty-state{grid-column:1/-1;padding:35px 20px;text-align:center;color:#555;background:#fff8bf;border:2px solid #080808}footer{background:#080808;color:#fff;padding:22px 24px;text-align:center;font-size:13px;margin-top:0}
@media(max-width:900px){.header-container{flex-wrap:wrap;gap:16px}.navbar-container{padding-top:8px}.book-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:600px){.header-container{padding:12px 16px}.header-info h1{font-size:14px}.navbar-container{padding:8px 16px 14px;align-items:flex-start;flex-direction:column}.navbar-menu{gap:12px}.nav-link{font-size:13px}.page-container{padding:16px 14px 22px}.panel{padding:15px}.form-grid,.book-grid{grid-template-columns:1fr}.page-title h1{font-size:25px}.search-box{max-width:100%}.book-cover{height:210px}}
</style>
</head>

<body>

<header class="site-header">
    <div class="header-container">
        <a href="{{ route('home') }}" class="logo" aria-label="Perpustakaan Digital">B</a>
        <div class="header-info"><h1>PERPUSTAKAAN<br><span style="display:inline-block;background:#ffd51e;font-size:10px;padding:2px 4px;margin-top:4px">DIGITAL KAMPUS</span></h1></div>
    </div>
    <nav class="navbar"><div class="navbar-container">
        <div class="navbar-menu">
            <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            <a href="{{ route('buku.index') }}" class="nav-link">Daftar Buku</a>
            @auth
                @can('kelola peminjaman')<a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>@endcan
                @can('kelola peminjaman')<a href="{{ route('peminjaman.index') }}" class="nav-link">Peminjaman</a>@else @can('melihat riwayat peminjaman sendiri')<a href="{{ route('peminjaman.index') }}" class="nav-link">Peminjaman Saya</a>@endcan @endcan
                @can('kelola data pengguna')<a href="{{ route('admin.users.index') }}" class="nav-link">Pengguna</a>@endcan
                @can('lihat laporan perpustakaan')<a href="{{ route('laporan.index') }}" class="nav-link">Laporan</a>@endcan
                @can('lihat profil sendiri')<a href="{{ route('profile.edit') }}" class="nav-link">Profil</a>@endcan
            @endauth
            @if($canManage)<a href="#form-section" class="nav-link">Tambah Buku</a>@endif
        </div>
        <div style="display:flex;align-items:center;gap:14px;font-size:13px;font-weight:700">
            @auth<span>{{ auth()->user()->name }}</span><form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit" style="background:#fff">Keluar</button></form>
            @else<a href="{{ route('login') }}" class="nav-link">Masuk</a><a href="{{ route('register') }}" class="nav-link">Daftar</a>@endauth
        </div>
    </div></nav>
</header>

<main class="page-container">

    <header class="page-title">
        <h1>Koleksi Buku</h1>
        <p>Selamat datang di perpustakaan. Temukan buku yang kamu butuhkan.</p>
    </header>

    {{-- FORM TAMBAH DAN UBAH BUKU --}}
    @if($canManage)
    <section class="panel" id="form-section">

        <h2 id="form-title">Tambah Buku</h2>

        <div id="form-message" class="message"
             role="status" aria-live="polite"></div>

        <form id="form-buku">

            <div class="form-grid">

                <div class="form-group">
                    <label for="kategori_id">Kategori Buku</label>

                    <select id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih kategori</option>

                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="judul">Judul Buku</label>

                    <input type="text"
                           id="judul"
                           name="judul"
                           placeholder="Masukkan judul buku"
                           required>
                </div>

                <div class="form-group">
                    <label for="penulis">Penulis</label>

                    <input type="text"
                           id="penulis"
                           name="penulis"
                           placeholder="Masukkan nama penulis"
                           required>
                </div>

                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit</label>

                    <input type="number"
                           id="tahun_terbit"
                           name="tahun_terbit"
                           placeholder="Contoh: 2025"
                           min="1000"
                           max="9999"
                           required>
                </div>

            </div>

            <div class="form-actions">

                <button type="submit"
                        class="btn-primary"
                        id="btn-simpan">
                    Simpan Buku
                </button>

                <button type="button"
                        class="btn-secondary"
                        id="btn-batal"
                        hidden>
                    Batal Ubah
                </button>

            </div>
        </form>
    </section>
    @endif

    {{-- DAFTAR BUKU --}}
    <section class="panel">

        <div class="collection-heading">
            <div>
                <h2>Daftar Buku</h2>
                <p>Temukan buku yang tersedia di perpustakaan.</p>
            </div>

            <div class="search-box">
                <input type="search"
                       id="search-buku"
                       class="search-input"
                       placeholder="Cari judul, penulis, atau kategori...">
            </div>
        </div>

        <div id="list-message"
             class="message"
             role="status"
             aria-live="polite"></div>

<div id="daftar-buku" class="book-grid">

    @forelse($buku as $item)
        <article class="book-card">
            <div class="book-cover">
                <span class="book-placeholder">📚</span>
            </div>

            <div class="book-info">
                <span class="book-category">
                    {{ $item->kategori->nama ?? 'Tanpa Kategori' }}
                </span>

                {{-- KERENTANAN A1: STORED XSS --}}
                <h3>{{ $item->judul }}</h3>

                <p class="book-meta">
                    Penulis: {{ $item->penulis }}
                </p>

                <p class="book-meta">
                    Tahun terbit: {{ $item->tahun_terbit }}
                </p>
            </div>
        </article>
    @empty
        <div class="empty-state">
            Belum ada buku tersedia.
        </div>
    @endforelse

</div>

    </section>

</main>

<footer>© {{ date('Y') }} Perpustakaan Digital Kampus · Ruang untuk membaca, belajar, dan bertumbuh.</footer>

<script>
    const API_BUKU = '/api/buku';
    const CAN_MANAGE = @json($canManage);

    const daftarBuku = document.getElementById('daftar-buku');
    const listMessage = document.getElementById('list-message');
    const searchBuku = document.getElementById('search-buku');

    // Elemen form hanya tersedia untuk pengguna yang memiliki permission.
    const form = document.getElementById('form-buku');
    const formMessage = document.getElementById('form-message');
    const selectKategori = document.getElementById('kategori_id');
    const btnSimpan = document.getElementById('btn-simpan');
    const btnBatal = document.getElementById('btn-batal');
    const formTitle = document.getElementById('form-title');

    let bukuTersimpan = [];

    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
    )?.content || '';

    function tampilkanPesan(element, pesan, jenis = 'info') {
        if (!element) return;

        element.textContent = pesan;
        element.className = `message ${jenis}`;
    }

    function hapusPesan(element) {
        if (!element) return;

        element.textContent = '';
        element.className = 'message';
    }

    async function bacaJSON(response) {
        const text = await response.text();

        if (!text) return {};

        try {
            return JSON.parse(text);
        } catch {
            return { message: text };
        }
    }

    function ambilData(result) {
        if (Array.isArray(result)) return result;

        if (Array.isArray(result.data)) {
            return result.data;
        }

        return result;
    }

    function namaKategori(kategori) {
        if (typeof kategori === 'string') {
            return kategori;
        }

        return kategori?.nama
            ?? kategori?.nama_kategori
            ?? kategori?.kategori
            ?? 'Tanpa Kategori';
    }

    function tampilkanPlaceholder(cover) {
        const placeholder = document.createElement('span');

        placeholder.className = 'book-placeholder';
        placeholder.textContent = '📚';

        cover.replaceChildren(placeholder);
    }

    function buatTombol(teks, className, callback) {
        const button = document.createElement('button');

        button.type = 'button';
        button.textContent = teks;
        button.className = className;

        button.addEventListener('click', callback);

        return button;
    }

    function buatKartu(buku) {
        const kartu = document.createElement('article');
        kartu.className = 'book-card';

        // COVER BUKU
        const cover = document.createElement('div');
        cover.className = 'book-cover';

        if (buku.cover) {
            const img = document.createElement('img');

            img.src = buku.cover;
            img.alt = `Sampul ${buku.judul || 'buku'}`;

            img.onerror = () => tampilkanPlaceholder(cover);

            cover.appendChild(img);
        } else {
            tampilkanPlaceholder(cover);
        }

        // INFORMASI BUKU
        const info = document.createElement('div');
        info.className = 'book-info';

        const kategori = document.createElement('span');
        kategori.className = 'book-category';
        kategori.textContent = namaKategori(buku.kategori);

        const judul = document.createElement('h3');
        judul.textContent = buku.judul || '-';

        const penulis = document.createElement('p');
        penulis.className = 'book-meta';
        penulis.textContent = `Penulis: ${buku.penulis || '-'}`;

        const tahun = document.createElement('p');
        tahun.className = 'book-meta';

        tahun.textContent =
            `Tahun terbit: ${buku.tahun_terbit ?? buku.tahun ?? '-'}`;

        // TOMBOL AKSI
        const aksi = document.createElement('div');
        aksi.className = 'book-actions';

        // Detail dapat diakses semua pengguna.
        const detail = buatTombol(
            'Lihat Detail',
            'btn-detail',
            () => {
                if (buku.id == null) {
                    tampilkanPesan(
                        listMessage,
                        'ID buku tidak ditemukan.',
                        'error'
                    );
                    return;
                }

                window.location.href =
                    `/buku/${encodeURIComponent(buku.id)}`;
            }
        );

        aksi.appendChild(detail);

        // Ubah dan hapus hanya jika memiliki permission.
        if (CAN_MANAGE) {

            const ubah = buatTombol(
                'Ubah',
                'btn-edit',
                () => mulaiUbah(buku)
            );

            const hapus = buatTombol(
                'Hapus',
                'btn-delete',
                () => hapusBuku(buku)
            );

            aksi.append(ubah, hapus);
        }

        info.append(
            kategori,
            judul,
            penulis,
            tahun,
            aksi
        );

        kartu.append(cover, info);

        return kartu;
    }

    // MENAMPILKAN DAFTAR BUKU
    async function loadBuku() {
        daftarBuku.replaceChildren();

        const loading = document.createElement('div');
        loading.className = 'empty-state';
        loading.textContent = 'Memuat koleksi buku...';

        daftarBuku.appendChild(loading);

        try {
            const response = await fetch(API_BUKU, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await bacaJSON(response);

            if (!response.ok) {
                throw new Error(
                    result.message ||
                    `Gagal mengambil data buku (HTTP ${response.status}).`
                );
            }

            const data = ambilData(result);

            if (!Array.isArray(data)) {
                throw new Error(
                    'Format data buku dari API tidak sesuai.'
                );
            }

            bukuTersimpan = data;

            tampilkanBuku(data);

            hapusPesan(listMessage);

        } catch (error) {

            daftarBuku.replaceChildren();

            const gagal = document.createElement('div');
            gagal.className = 'empty-state';
            gagal.textContent = 'Data buku gagal dimuat.';

            daftarBuku.appendChild(gagal);

            tampilkanPesan(
                listMessage,
                error.message || 'API tidak dapat diakses.',
                'error'
            );
        }
    }

    // RENDER DAN PENCARIAN BUKU
    function tampilkanBuku(data) {
        daftarBuku.replaceChildren();

        if (!data.length) {
            const kosong = document.createElement('div');

            kosong.className = 'empty-state';
            kosong.textContent = 'Belum ada buku tersedia.';

            daftarBuku.appendChild(kosong);
            return;
        }

        data.forEach(buku => {
            daftarBuku.appendChild(buatKartu(buku));
        });
    }

    if (searchBuku) {
        searchBuku.addEventListener('input', function() {

            const kataKunci = this.value
                .toLowerCase()
                .trim();

            const hasil = bukuTersimpan.filter(buku => {

                const judul = (buku.judul || '').toLowerCase();

                const penulis = (buku.penulis || '').toLowerCase();

                const kategori = namaKategori(
                    buku.kategori
                ).toLowerCase();

                return judul.includes(kataKunci)
                    || penulis.includes(kataKunci)
                    || kategori.includes(kataKunci);
            });

            tampilkanBuku(hasil);
        });
    }

    // ====================================
    // BAGIAN KHUSUS ADMIN DAN PETUGAS
    // ====================================

    function isiPilihanKategori() {
        if (!selectKategori) return;

        const pilihanSebelumnya = selectKategori.value;

        selectKategori.replaceChildren();

        const opsiAwal = document.createElement('option');

        opsiAwal.value = '';
        opsiAwal.textContent = 'Pilih kategori';

        selectKategori.appendChild(opsiAwal);

        // Mengambil kategori langsung dari Blade.
        @foreach($kategori as $item)
            const opsi{{ $item->id }} = document.createElement('option');

            opsi{{ $item->id }}.value = @json((string) $item->id);
            opsi{{ $item->id }}.textContent = @json($item->nama);

            selectKategori.appendChild(opsi{{ $item->id }});
        @endforeach

        selectKategori.value = pilihanSebelumnya;
    }

    function mulaiUbah(buku) {
        if (!CAN_MANAGE || !form) return;

        if (buku.id == null) {
            tampilkanPesan(
                formMessage,
                'ID buku tidak ditemukan.',
                'error'
            );
            return;
        }

        form.dataset.id = buku.id;

        isiPilihanKategori();

        if (selectKategori) {
            selectKategori.value = String(
                buku.kategori_id ?? ''
            );
        }

        form.elements['judul'].value = buku.judul ?? '';
        form.elements['penulis'].value = buku.penulis ?? '';

        form.elements['tahun_terbit'].value =
            buku.tahun_terbit ?? buku.tahun ?? '';

        formTitle.textContent = 'Ubah Buku';

        btnSimpan.textContent = 'Simpan Perubahan';

        btnBatal.hidden = false;

        tampilkanPesan(
            formMessage,
            'Silakan ubah data buku kemudian simpan.',
            'info'
        );

        document.getElementById(
            'form-section'
        ).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function resetForm() {
        if (!form) return;

        form.reset();

        delete form.dataset.id;

        formTitle.textContent = 'Tambah Buku';

        btnSimpan.textContent = 'Simpan Buku';

        btnBatal.hidden = true;

        hapusPesan(formMessage);
    }

    if (CAN_MANAGE && form) {

        isiPilihanKategori();

        btnBatal.addEventListener('click', resetForm);

        form.addEventListener('submit', async function(event) {

            event.preventDefault();

            hapusPesan(formMessage);

            const id = form.dataset.id;

            const dataBuku = {
                kategori_id: form.elements['kategori_id'].value,
                judul: form.elements['judul'].value.trim(),
                penulis: form.elements['penulis'].value.trim(),
                tahun_terbit: Number(
                    form.elements['tahun_terbit'].value
                )
            };

            if (
                !dataBuku.kategori_id ||
                !dataBuku.judul ||
                !dataBuku.penulis ||
                !dataBuku.tahun_terbit
            ) {
                tampilkanPesan(
                    formMessage,
                    'Semua kolom wajib diisi.',
                    'error'
                );
                return;
            }

            const sedangUbah = Boolean(id);

            const url = sedangUbah
                ? `${API_BUKU}/${encodeURIComponent(id)}`
                : API_BUKU;

            btnSimpan.disabled = true;
            btnSimpan.textContent = 'Menyimpan...';

            try {

                const response = await fetch(url, {
                    method: sedangUbah ? 'PUT' : 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },

                    body: JSON.stringify(dataBuku)
                });

                const result = await bacaJSON(response);

                if (!response.ok) {

                    if (response.status === 422 && result.errors) {
                        const errors = Object.values(result.errors)
                            .flat()
                            .join(' ');

                        throw new Error(
                            errors || 'Periksa kembali data yang diisi.'
                        );
                    }

                    throw new Error(
                        result.message ||
                        `Gagal menyimpan buku (HTTP ${response.status}).`
                    );
                }

                resetForm();

                tampilkanPesan(
                    formMessage,
                    sedangUbah
                        ? 'Buku berhasil diperbarui.'
                        : 'Buku berhasil ditambahkan.',
                    'success'
                );

                await loadBuku();

            } catch (error) {

                tampilkanPesan(
                    formMessage,
                    error.message || 'Terjadi kesalahan.',
                    'error'
                );

            } finally {

                btnSimpan.disabled = false;

                btnSimpan.textContent = form.dataset.id
                    ? 'Simpan Perubahan'
                    : 'Simpan Buku';
            }
        });
    }

    // HAPUS BUKU
    async function hapusBuku(buku) {

        if (!CAN_MANAGE) return;

        if (buku.id == null) {
            tampilkanPesan(
                listMessage,
                'ID buku tidak ditemukan.',
                'error'
            );
            return;
        }

        const setuju = confirm(
            `Yakin ingin menghapus buku "${buku.judul}"?`
        );

        if (!setuju) return;

        try {

            const response = await fetch(
                `${API_BUKU}/${encodeURIComponent(buku.id)}`,
                {
                    method: 'DELETE',

                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            );

            const result = await bacaJSON(response);

            if (!response.ok) {
                throw new Error(
                    result.message ||
                    `Gagal menghapus buku (HTTP ${response.status}).`
                );
            }

            if (
                form &&
                String(form.dataset.id) === String(buku.id)
            ) {
                resetForm();
            }

            tampilkanPesan(
                listMessage,
                'Buku berhasil dihapus.',
                'success'
            );

            await loadBuku();

        } catch (error) {

            tampilkanPesan(
                listMessage,
                error.message || 'Gagal menghapus buku.',
                'error'
            );
        }
    }

document.addEventListener('DOMContentLoaded', function() {
    loadBuku(); 
});
</script>

</body>
</html>