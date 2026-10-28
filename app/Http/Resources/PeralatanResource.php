<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeralatanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'brand' => $this->brand,
            'kategori' => $this->kategori,
            'deskripsi' => $this->deskripsi,
            'harga_sewa' => $this->harga_sewa,
            'stok' => $this->stok,
            'kondisi' => $this->kondisi,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
