# Panduan Pengujian Tugas Praktikum Modul 5

Dokumen ini adalah lembar pengujian. Kolom **Hasil Aktual** harus diisi setelah setiap skenario benar-benar dicoba di browser; jangan mengisi berdasarkan hasil yang diharapkan saja.

## Persiapan
1. Jalankan `composer install` dan `npm install`.
2. Siapkan konfigurasi database pada `.env` lokal (jangan membagikan file `.env`).
3. Jalankan `php artisan key:generate` bila aplikasi baru disiapkan.
4. Jalankan `php artisan migrate:fresh --seed` pada database pengujian (perintah ini menghapus tabel/data lama).
5. Jalankan `npm run build`, lalu `php artisan serve`.
6. Akun admin awal dari seeder: `admin@perpustakaan.test` dengan password `Admin123!`. Ganti password setelah login dan jangan gunakan kredensial contoh di server publik.
7. Buat akun Petugas dan Siswa dari menu Pengguna sebagai Admin. Akun registrasi publik otomatis menjadi Siswa.

## Skenario pengujian
| No. | Akun / Role | Skenario | Hasil yang diharapkan | Hasil aktual |
|---:|---|---|---|---|
| 1 | Belum login | Buka `/dashboard` | Dialihkan ke halaman login | Belum diuji |
| 2 | Admin | Buka `/dashboard` | Dashboard Admin dapat dibuka | Belum diuji |
| 3 | Admin | Tambah, ubah, dan hapus buku melalui fitur buku | Operasi berhasil | Belum diuji |
| 4 | Admin | Tambah pengguna dan ubah role | Operasi berhasil | Belum diuji |
| 5 | Admin | Buka data peminjaman, pengembalian, dan `/laporan` | Data dapat diakses | Belum diuji |
| 6 | Petugas | Buka `/dashboard` | Dashboard Petugas dapat dibuka | Belum diuji |
| 7 | Petugas | Tambah, ubah, dan hapus buku | Operasi berhasil | Belum diuji |
| 8 | Petugas | Setujui peminjaman dan catat pengembalian | Operasi berhasil | Belum diuji |
| 9 | Petugas | Buka `/admin/pengguna` | Akses ditolak | Belum diuji |
| 10 | Siswa | Buka daftar dan detail buku | Data buku dapat dilihat | Belum diuji |
| 11 | Siswa | Buka dan ubah `/profil` | Hanya profil sendiri yang dapat diubah | Belum diuji |
| 12 | Siswa | Buka `/peminjaman` | Hanya riwayat miliknya yang terlihat | Belum diuji |
| 13 | Siswa | Buka `/dashboard` dan mencoba operasi pengelolaan buku | Akses ditolak | Belum diuji |
| 14 | Siswa | Mencoba membuka riwayat siswa lain | Data siswa lain tidak terlihat | Belum diuji |
| 15 | Admin/Petugas/Siswa | Logout, lalu buka URL yang dilindungi | Harus login kembali | Belum diuji |

## Catatan
- Uji juga URL secara langsung, bukan hanya menyembunyikan menu.
- Untuk skenario nomor 14, gunakan dua akun Siswa dengan transaksi berbeda dan pastikan masing-masing hanya melihat transaksinya sendiri.
- Status `Belum diuji` wajib diganti berdasarkan hasil percobaan nyata sebelum laporan dikumpulkan.
