<?php

namespace Database\Seeders;

use App\Models\Peralatan;
use Illuminate\Database\Seeder;

class PeralatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Tenda Camping 4 Orang',
                'brand' => 'Eiger',
                'kategori' => 'Tenda',
                'deskripsi' => 'Tenda camping untuk empat orang.',
                'harga_sewa' => 75000,
                'stok' => 5,
                'kondisi' => 'baik',
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Carrier 60 Liter',
                'brand' => 'Consina',
                'kategori' => 'Tas',
                'deskripsi' => 'Tas carrier untuk pendakian.',
                'harga_sewa' => 40000,
                'stok' => 8,
                'kondisi' => 'baik',
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Sleeping Bag',
                'brand' => 'Naturehike',
                'kategori' => 'Perlengkapan Tidur',
                'deskripsi' => 'Kantong tidur untuk kegiatan outdoor.',
                'harga_sewa' => 25000,
                'stok' => 10,
                'kondisi' => 'baru',
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Kompor Portable',
                'brand' => 'Kovar',
                'kategori' => 'Memasak',
                'deskripsi' => 'Kompor portable untuk camping.',
                'harga_sewa' => 30000,
                'stok' => 4,
                'kondisi' => 'baik',
                'status' => 'tersedia',
            ],
            [
                'nama' => 'Trekking Pole',
                'brand' => 'Naturehike',
                'kategori' => 'Pendakian',
                'deskripsi' => 'Tongkat untuk membantu pendakian.',
                'harga_sewa' => 15000,
                'stok' => 6,
                'kondisi' => 'perlu_perbaikan',
                'status' => 'tidak_tersedia',
            ],
        ];

        foreach ($data as $item) {
            Peralatan::create($item);
        }
    }
}
