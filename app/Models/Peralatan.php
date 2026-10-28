<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 'peralatan';
    protected $fillable = [
        'nama',
        'brand',
        'kategori',
        'deskripsi',
        'harga_sewa',
        'stok',
        'kondisi',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'harga_sewa' => 'decimal:2',
            'stok' => 'integer',
        ];
    }
}
