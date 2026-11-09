<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kategori' => $this->kategori?->nama ?? 'Tanpa Kategori',
            'kategori_id' => $this->kategori_id,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => (int) $this->tahun_terbit,
        ];
    }
}
