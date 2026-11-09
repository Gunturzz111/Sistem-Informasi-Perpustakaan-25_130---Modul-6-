<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanFactory extends Factory
{
    protected $model = Peminjaman::class;

    public function definition(): array
    {
        $tanggalPinjam = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'anggota_id' => Anggota::query()->inRandomOrder()->value('id'),
            'buku_id' => Buku::query()->inRandomOrder()->value('id'),
            'tanggal_pinjam' => $tanggalPinjam->format('Y-m-d'),
            'tanggal_kembali' => fake()->boolean(70)
                ? fake()->dateTimeBetween($tanggalPinjam, 'now')->format('Y-m-d')
                : null,
        ];
    }
}
