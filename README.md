# GearSpace API

REST API untuk pengelolaan katalog penyewaan peralatan outdoor, dibangun menggunakan Laravel 12 dan MySQL.

## Fitur

- CRUD data peralatan outdoor.
- Validasi input menggunakan Laravel.
- Format respons JSON menggunakan API Resource.
- Pencarian peralatan berdasarkan kata kunci.
- Filter data peralatan.
- Pengurutan data.
- Pagination.
- Dokumentasi API menggunakan Scramble.

## Teknologi

- PHP 8.2+
- Laravel 12
- MySQL
- Laravel Sanctum
- Scramble API Documentation

## Persyaratan

Pastikan perangkat sudah memiliki PHP, Composer, Node.js dan npm, serta MySQL.

## Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/destrjoy/BTNG-Backend-AuraCantikaPutri.git
   ```

2. Masuk ke direktori project:

   ```bash
   cd BTNG-Backend-AuraCantikaPutri
   ```

3. Install dependency PHP:

   ```bash
   composer install
   ```

4. Salin konfigurasi environment:

   ```bash
   cp .env.example .env
   ```

   Untuk Windows Command Prompt, gunakan:

   ```cmd
   copy .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Buat database MySQL bernama `gearspace_db`, lalu sesuaikan konfigurasi `DB_*` pada file `.env` dengan database lokal.

7. Jalankan migrasi:

   ```bash
   php artisan migrate
   ```

8. Isi data contoh:

   ```bash
   php artisan db:seed --class=PeralatanSeeder
   ```

9. Jalankan server lokal:

   ```bash
   php artisan serve
   ```

API lokal dapat diakses melalui `http://127.0.0.1:8000`.

## Endpoint API

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/peralatan` | Menampilkan daftar peralatan |
| POST | `/api/peralatan` | Menambahkan peralatan |
| GET | `/api/peralatan/{peralatan}` | Menampilkan detail peralatan |
| PUT/PATCH | `/api/peralatan/{peralatan}` | Memperbarui peralatan |
| DELETE | `/api/peralatan/{peralatan}` | Menghapus peralatan |

## Dokumentasi API

Setelah server dijalankan, buka:

`http://127.0.0.1:8000/docs/api`

Dokumentasi menyediakan informasi endpoint, parameter, serta format request dan response API.

## Catatan Konfigurasi

Jangan mengunggah file `.env` yang berisi kredensial atau application key ke repository publik. Gunakan `.env.example` sebagai template konfigurasi.

## Repository

https://github.com/destrjoy/BTNG-Backend-AuraCantikaPutri
