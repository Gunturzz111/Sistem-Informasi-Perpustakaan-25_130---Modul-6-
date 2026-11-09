# Perpustakaan - Lanjutan Tugas Praktikum Modul IV

## Perubahan yang diterapkan
1. Halaman `/buku` sekarang mengambil daftar buku dari `GET /api/buku` memakai Fetch API dan `async/await`.
2. Respons API diatur dengan `App\Http\Resources\BukuResource`.
3. Form tambah buku mengirim `POST /api/buku`, lalu tabel diperbarui tanpa reload.
4. Tombol Ubah mengisi formulir dan mengirim `PUT /api/buku/{id}`.
5. Tombol Hapus meminta konfirmasi lalu mengirim `DELETE /api/buku/{id}`.
6. Penanganan error menggunakan `response.ok`, `try/catch`, dan menampilkan pesan validasi dari API.
7. Validasi tambah/ubah menggunakan `$request->validate()` pada API Controller.

## Pemetaan atribut API
Struktur tabel proyek yang digunakan adalah `bukus(kategori_id, judul, penulis, tahun_terbit)` dan relasi `kategoris.nama`.
- `kategori` pada respons API berasal dari `$buku->kategori->nama`, bukan nama kolom langsung pada tabel `bukus`.
- `kategori_id` tetap dikirim agar formulir Ubah dapat memilih kategori yang benar.
- `judul`, `penulis`, dan `tahun_terbit` berasal dari kolom dengan nama yang sama.

## Cara menjalankan
1. Ekstrak folder project.
2. Buka terminal di folder `perpustakaan_25130`.
3. Pastikan konfigurasi database pada `.env` sesuai dengan database lokal yang sudah digunakan.
4. Jalankan MySQL/Laragon.
5. Jalankan `php artisan serve`.
6. Buka `http://127.0.0.1:8000/buku`.

Tidak perlu membuat ulang endpoint CRUD karena rute `Route::apiResource('buku', BukuController::class)` sudah tersedia.

## Catatan pengujian
Rute API sudah diperiksa dengan `php artisan route:list --path=api/buku`, dan tiga file PHP yang diubah lolos `php -l`. Uji akhir pada browser tetap perlu dilakukan di komputer yang menjalankan database lokal.
