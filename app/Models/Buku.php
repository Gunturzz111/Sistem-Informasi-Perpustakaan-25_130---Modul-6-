<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    public $timestamps = false;

protected $fillable = [
    'kategori_id',
    'judul',
    'penulis',
    'tahun_terbit',
    'cover',
];

    /**
     * Relasi Buku dengan Kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi Buku dengan Peminjaman.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
