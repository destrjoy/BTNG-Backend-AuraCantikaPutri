<?php

namespace Tests\Feature;

use App\Models\Peralatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeralatanApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_daftar_peralatan_dapat_diakses(): void
    {
        $response = $this->getJson('/api/peralatan');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data',
                'meta',
            ]);
    }

    public function test_statistik_peralatan_mengembalikan_data(): void
    {
        Peralatan::create([
            'nama' => 'Tenda Camping',
            'brand' => 'Eiger',
            'kategori' => 'Tenda',
            'deskripsi' => 'Tenda untuk camping',
            'harga_sewa' => 50000,
            'stok' => 3,
            'kondisi' => 'baik',
            'status' => 'tersedia',
        ]);

        $response = $this->getJson('/api/peralatan/statistik');

        $response->assertStatus(200)
            ->assertJsonPath('data.total_peralatan', 1)
            ->assertJsonPath('data.stok_tersedia', 1)
            ->assertJsonPath('data.stok_habis', 0)
            ->assertJsonPath('data.perlu_perbaikan', 0)
            ->assertJsonPath('data.total_kategori', 1);
    }
    public function test_tambah_peralatan_dengan_data_kosong_ditolak(): void
{
    $response = $this->postJson('/api/peralatan', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'nama',
            'brand',
            'kategori',
            'harga_sewa',
            'stok',
            'kondisi',
            'status',
        ]);
}
public function test_peralatan_berhasil_ditambahkan(): void
{
    $response = $this->postJson('/api/peralatan', [
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
        'kategori' => 'Tenda',
        'deskripsi' => 'Tenda untuk camping',
        'harga_sewa' => 50000,
        'stok' => 3,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    $response->assertStatus(201)
        ->assertJsonPath('message', 'Peralatan berhasil ditambahkan');

   $this->assertDatabaseHas('peralatan', [
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
    ]);
}

public function test_pencarian_peralatan_berdasarkan_nama(): void
{
    Peralatan::create([
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
        'kategori' => 'Tenda',
        'deskripsi' => 'Tenda untuk camping',
        'harga_sewa' => 50000,
        'stok' => 3,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    Peralatan::create([
        'nama' => 'Carrier Gunung',
        'brand' => 'Consina',
        'kategori' => 'Tas',
        'deskripsi' => 'Tas untuk mendaki',
        'harga_sewa' => 30000,
        'stok' => 5,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    $response = $this->getJson('/api/peralatan?search=Tenda');

    $response->assertStatus(200)
        ->assertJsonPath('meta.total', 1)
        ->assertJsonPath('data.0.nama', 'Tenda Camping');
}

public function test_filter_peralatan_berdasarkan_kategori(): void
{
    Peralatan::create([
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
        'kategori' => 'Tenda',
        'deskripsi' => 'Tenda untuk camping',
        'harga_sewa' => 50000,
        'stok' => 3,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    Peralatan::create([
        'nama' => 'Carrier Gunung',
        'brand' => 'Consina',
        'kategori' => 'Tas',
        'deskripsi' => 'Tas untuk mendaki',
        'harga_sewa' => 30000,
        'stok' => 5,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    $response = $this->getJson('/api/peralatan?kategori=Tenda');

    $response->assertStatus(200)
        ->assertJsonPath('meta.total', 1)
        ->assertJsonPath('data.0.kategori', 'Tenda');
}

public function test_filter_peralatan_berdasarkan_harga_minimum(): void
{
    Peralatan::create([
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
        'kategori' => 'Tenda',
        'deskripsi' => 'Tenda untuk camping',
        'harga_sewa' => 50000,
        'stok' => 3,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    Peralatan::create([
        'nama' => 'Carrier Gunung',
        'brand' => 'Consina',
        'kategori' => 'Tas',
        'deskripsi' => 'Tas untuk mendaki',
        'harga_sewa' => 30000,
        'stok' => 5,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    $response = $this->getJson('/api/peralatan?harga_min=40000');

    $response->assertStatus(200)
        ->assertJsonPath('meta.total', 1)
        ->assertJsonPath('data.0.nama', 'Tenda Camping');
}

public function test_peralatan_berhasil_diperbarui(): void
{
    $peralatan = Peralatan::create([
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
        'kategori' => 'Tenda',
        'deskripsi' => 'Tenda untuk camping',
        'harga_sewa' => 50000,
        'stok' => 3,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    $response = $this->putJson('/api/peralatan/' . $peralatan->id, [
        'nama' => 'Tenda Camping Premium',
        'harga_sewa' => 75000,
    ]);

    $response->assertStatus(200)
        ->assertJsonPath('data.nama', 'Tenda Camping Premium');

    $this->assertDatabaseHas('peralatan', [
        'id' => $peralatan->id,
        'nama' => 'Tenda Camping Premium',
        'harga_sewa' => 75000,
    ]);
}
public function test_peralatan_berhasil_dihapus(): void
{
    $peralatan = Peralatan::create([
        'nama' => 'Tenda Camping',
        'brand' => 'Eiger',
        'kategori' => 'Tenda',
        'deskripsi' => 'Tenda untuk camping',
        'harga_sewa' => 50000,
        'stok' => 3,
        'kondisi' => 'baik',
        'status' => 'tersedia',
    ]);

    $response = $this->deleteJson('/api/peralatan/' . $peralatan->id);

    $response->assertStatus(200)
        ->assertJsonPath('message', 'Peralatan berhasil dihapus');

    $this->assertDatabaseMissing('peralatan', [
        'id' => $peralatan->id,
    ]);
}
}
