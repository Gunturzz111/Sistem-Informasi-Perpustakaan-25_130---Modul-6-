# Implementasi Praktikum Modul V — Sistem Perpustakaan Digital

## Yang ditambahkan
- Login, registrasi siswa, logout, session regeneration dan invalidation.
- Password di-hash melalui Laravel hashed cast.
- Middleware `auth`, `guest`, `role`, dan `permission`.
- Role `admin`, `petugas`, `siswa` beserta 16 permission.
- Pengelolaan pengguna dan role oleh admin.
- Dashboard admin/petugas, profil, pengajuan dan riwayat peminjaman.
- Riwayat siswa difilter berdasarkan `anggota.user_id` milik akun login.
- Endpoint GET daftar/detail buku tetap publik; operasi API tulis dilindungi autentikasi dan permission.

## Instalasi setelah mengekstrak ZIP
Jalankan dari folder proyek (folder yang berisi `artisan`):

```bash
composer update
npm install
cp .env.example .env
php artisan key:generate
```

Atur koneksi database pada `.env`, kemudian:

```bash
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Jika database proyek sebelumnya sudah berisi data, jangan menjalankan `migrate:fresh` karena perintah itu menghapus seluruh tabel dan data.

## Akun awal
- Email: `admin@perpustakaan.test`
- Password: `Admin123!`

Akun admin dibuat oleh `RolePermissionSeeder`. Segera ubah password setelah login. Registrasi publik tidak menyediakan pilihan role dan seluruh akun baru otomatis menjadi `siswa`. Role petugas/admin hanya dapat ditetapkan oleh admin melalui menu Kelola Pengguna.

## Catatan dependensi
`composer.json` menambahkan `laravel/breeze` sebagai dependency pengembangan dan `spatie/laravel-permission` sebagai dependency aplikasi. Jalankan `composer update` agar `composer.lock` diselaraskan dengan dependency baru. UI autentikasi Laravel disediakan dengan alur session dan validasi yang kompatibel dengan scaffolding Breeze.

## Skenario uji
1. Belum login: buka `/dashboard` → dialihkan ke `/login`.
2. Admin: login `admin@perpustakaan.test` → dashboard admin dan menu kelola pengguna tersedia.
3. Admin: ubah role akun menjadi `petugas` atau `siswa`.
4. Petugas: dashboard petugas, pengelolaan peminjaman tersedia; `/admin/pengguna` ditolak.
5. Siswa: daftar/detail buku, profil dan riwayat sendiri tersedia; dashboard admin dan pengelolaan pengguna ditolak.
6. Siswa: riwayat peminjaman difilter memakai `anggota.user_id`, bukan parameter ID yang dikirim browser.
7. Semua role: logout, lalu buka URL terlindungi → dialihkan kembali ke login.

Kolom Hasil Aktual pada lembar praktikum harus diisi setelah skenario benar-benar dijalankan pada komputer/lokal.
