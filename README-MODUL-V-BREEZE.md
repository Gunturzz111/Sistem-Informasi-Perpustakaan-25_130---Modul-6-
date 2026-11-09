# Modul V — Autentikasi Laravel Breeze

Autentikasi proyek ini menggunakan pola scaffolding Laravel Breeze (Blade):

- `app/Http/Requests/Auth/LoginRequest.php` menangani validasi login, autentikasi, dan pembatasan percobaan login.
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` menangani login/logout. Pengalihan setelah login disesuaikan dengan role perpustakaan.
- `app/Http/Controllers/Auth/RegisteredUserController.php` menangani registrasi dan menyesuaikannya dengan tabel `anggota` serta Spatie Permission.
- `routes/web.php` membatasi halaman login/registrasi dengan middleware `guest` dan halaman privat dengan middleware `auth`.
- Form login dan registrasi mempertahankan desain antarmuka proyek.

## Menjalankan proyek

1. Buka terminal di folder proyek `perpustakaan_25130`.
2. Pastikan konfigurasi database di `.env` sesuai dengan MySQL lokal.
3. Jalankan `composer install` jika dependensi belum tersedia.
4. Jalankan `php artisan migrate --seed` pada database pengembangan yang benar.
5. Jalankan `npm install` lalu `npm run build` jika aset frontend perlu dibangun ulang.
6. Jalankan `php artisan serve` dan buka alamat lokal yang ditampilkan.

## Catatan

- Paket `laravel/breeze` sudah tercantum di `composer.json` dan `composer.lock`. Breeze adalah scaffolding: kode autentikasinya disalin ke aplikasi lalu dapat disesuaikan. Controller dan `LoginRequest` di atas mengikuti pola Breeze dengan penyesuaian kebutuhan proyek.
- Jangan menjalankan `php artisan breeze:install` tanpa backup, karena scaffolding dapat menimpa route, controller, dan view yang sudah disesuaikan untuk perpustakaan.
- Registrasi publik selalu menetapkan role `siswa`; role admin/petugas hanya boleh diberikan oleh mekanisme admin/seeder.
- Pengujian sintaks PHP dan route login telah dilakukan. Pengujian database serta alur login di browser tetap perlu dilakukan pada komputer lokal dengan database aktif.
