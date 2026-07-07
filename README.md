# 🍜 Fujiyama Ramen

Website pemesanan ramen berbasis Laravel 11 dengan arsitektur modular (nwidart/laravel-modules).

## Teknologi

| Item | Detail |
|---|---|
| Backend | Laravel 11 (PHP 8.3+) |
| Arsitektur | Modular — package `nwidart/laravel-modules` |
| Frontend Client | Blade + Tailwind CSS + Alpine.js (dark theme ala Crunchyroll) |
| Frontend Admin | Blade + AdminLTE v4 (CDN) |
| Database | MySQL |
| Autentikasi | Laravel Breeze (blade stack) |

## Struktur Modul

```
Modules/
├── Core/        → User model, migration tambahan (phone, address, role)
├── Menu/        → Kategori & Menu (Model, Migration, Seeder)
├── Cart/        → Keranjang belanja (session/DB based)
├── Order/       → Checkout & manajemen pesanan
├── Client/      → Landing page & tampilan sisi customer
└── Admin/       → Dashboard admin, CRUD kategori/menu/pesanan
```

## Fitur

### Client
- Landing page dark theme (gaya Crunchyroll) — hero banner, menu unggulan, kategori
- Halaman menu per kategori dengan tombol tambah ke keranjang
- Keranjang interaktif (Alpine.js) — qty +/-, hapus, subtotal otomatis
- Checkout — form data pemesan, pilih metode bayar, order_code unik (FUJI-YYYYMMDD-XXXX)

### Admin
- Login admin (redirect berdasarkan role)
- Dashboard — statistik pesanan hari ini, pendapatan, menu tersedia
- CRUD Kategori (nama unik)
- CRUD Menu (upload gambar, slug auto-generate)
- Manajemen Pesanan — lihat detail, ubah status (pending → diproses → selesai/batal)

## Cara Install

### 1. Clone Project
```bash
git clone <repo-url> fujiyama-ramen
cd fujiyama-ramen
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
```

Edit `.env`, sesuaikan database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fujiyama_ramen
DB_USERNAME=root
DB_PASSWORD=
```

**PENTING:** Ganti `APP_ENV=production` menjadi `APP_ENV=local` di `.env` agar error debugging muncul.

Kemudian generate APP_KEY:
```bash
php artisan key:generate
```

### 4. Buat Database MySQL
```sql
CREATE DATABASE fujiyama_ramen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

Ini akan menjalankan migration dari semua modul dan membuat user admin default.

### 6. Build Frontend Assets
```bash
npm run build
```

### 7. Symlink Storage (untuk gambar menu)
```bash
php artisan storage:link
```

### 8. Jalankan Server
```bash
php artisan serve
```

Buka `http://localhost:8000` di browser.

## Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | admin@fujiyama.test | password |
| Customer | Register sendiri di /register | — |

> Catatan: Jika user admin belum ada, daftar dulu via `/register`, lalu ubah role di database menjadi `admin`.

## Development

Gunakan perintah module Laravel untuk development:

```bash
# Buat modul baru
php artisan module:make NamaModul

# Jalankan migration modul tertentu
php artisan module:migrate NamaModul

# Seed modul tertentu
php artisan module:seed NamaModul
```

## Lisensi

Proyek internal — Fujiyama Ramen.