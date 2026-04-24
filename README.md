# Sistem Data Bantuan Sosial Pemerintah (Laravel 13)

Project ini adalah implementasi REST API untuk manajemen data bantuan sosial.

## Fitur
- Migration tabel: `kecamatan`, `desa`, `warga`, `program_bantuan`, `penerima_bantuan`
- Relasi Eloquent sesuai kebutuhan studi kasus
- Seeder data awal
- Endpoint:
  - `GET /api/penerima`
  - `GET /api/penerima?tahun=2025&status=verified`
  - `POST /api/penerima`
  - `GET /api/laporan/kecamatan`
  - `GET /api/anomali`
- Business rule: 1 warga maksimal 2 program per tahun

## Menjalankan project
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Catatan
Jika Anda menggunakan PostgreSQL, migration `penerima_bantuan` sudah menambahkan index expression untuk optimasi query tahunan.
