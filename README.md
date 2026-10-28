# GearSpace API

REST API untuk pengelolaan katalog penyewaan peralatan outdoor, dibangun menggunakan Laravel 12 dan MySQL.

## Fitur

- CRUD data peralatan outdoor.
- Validasi input menggunakan Laravel.
- Format respons JSON menggunakan API Resource.
- Pencarian peralatan berdasarkan kata kunci.
- Filter data berdasarkan kategori, kondisi, status, dan harga.
- Pengurutan data.
- Pagination.
- Statistik inventaris.
- Pengujian otomatis menggunakan PHPUnit.
- Dokumentasi API menggunakan Scramble.

## Teknologi

- PHP 8.2+
- Laravel 12
- MySQL
- Laravel API Resource
- Scramble API Documentation
- PHPUnit

## Persyaratan

Pastikan perangkat sudah memiliki:

- PHP dan ekstensi yang dibutuhkan Laravel.
- Composer.
- MySQL.
- Node.js dan npm jika diperlukan untuk aset frontend Laravel.

## Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/destrjoy/BTNG-Backend-AuraCantikaPutri.git
   ```

2. Masuk ke direktori proyek:

   ```bash
   cd BTNG-Backend-AuraCantikaPutri
   ```

3. Install dependency PHP:

   ```bash
   composer install
   ```

4. Salin konfigurasi environment.

   Untuk Git Bash atau Linux:

   ```bash
   cp .env.example .env
   ```

   Untuk Windows Command Prompt:

   ```cmd
   copy .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Buat database MySQL bernama `gearspace_db`, lalu sesuaikan konfigurasi database pada file `.env`.

   Contoh konfigurasi:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gearspace_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```

8. Isi database dengan data contoh:

   ```bash
   php artisan db:seed
   ```

9. Jalankan server lokal:

   ```bash
   php artisan serve
   ```

API lokal dapat diakses melalui:

`http://127.0.0.1:8000`

## Endpoint API

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/peralatan` | Menampilkan daftar peralatan |
| POST | `/api/peralatan` | Menambahkan peralatan |
| GET | `/api/peralatan/{peralatan}` | Menampilkan detail peralatan |
| PUT/PATCH | `/api/peralatan/{peralatan}` | Memperbarui peralatan |
| DELETE | `/api/peralatan/{peralatan}` | Menghapus peralatan |
| GET | `/api/peralatan/statistik` | Menampilkan statistik inventaris |

### Fitur pencarian dan filter

Endpoint daftar peralatan mendukung parameter pencarian dan filter, antara lain:

- `search`: mencari peralatan berdasarkan kata kunci.
- `kategori`: memfilter berdasarkan kategori.
- `kondisi`: memfilter berdasarkan kondisi peralatan.
- `status`: memfilter berdasarkan status ketersediaan.
- `harga_min`: menentukan harga sewa minimum.
- `harga_max`: menentukan harga sewa maksimum