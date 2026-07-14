# Fujiyama Ramen — Progress Tracker

## Tech Stack
- Laravel v13.8.0 / PHP 8.3.30 / Composer 2.9.4 / Node (npm)
- Laravel Modules v13.0.0 / Laravel Breeze v2.4.2 (blade)
- Database: MySQL `fujiyama_ramen`
- Environment: Windows + Laragon + PowerShell

---

## Modul Selesai

### Core, Menu & Admin
- [x] **Core & Menu** — Modul Core + Menu, migration users (+phone, address, role), categories, menus. Seeder: 3 kategori + 7 menu dummy.
- [x] **Admin (Auth + Dashboard + Layout)** — AdminMiddleware, layout AdminLTE v4 CDN, dashboard statistik (Quick Actions, grafik pendapatan 7 hari, menu terlaris mingguan), login redirect by role.
- [x] **Rate Limiting Login Admin** — Keamanan brute-force pada halaman login admin.
- [x] **Ganti Password** — Form ganti password di admin panel, logout otomatis setelah sukses.
- [x] **Log Aktivitas Admin** — Activity log seluruh action admin (create/update/delete) via Spatie ActivityLog.
- [x] **Sidebar Admin** — 5 grup collapsible (Dashboard, Operasional, Katalog, Konten Website, Pengaturan) dengan Alpine.js, search filter, hierarki visual parent/child, auto-expand grup aktif.
- [x] **Breadcrumb Admin** — Navigasi otomatis berdasarkan route name (Grup > Modul > Aksi).
- [x] **Locale Bahasa Indonesia** — File `lang/id/auth.php`, `APP_LOCALE=id`, `APP_FALLBACK_LOCALE=id`.
- [x] **Validasi Bahasa Indonesia** — File `lang/id/validation.php` dengan terjemahan lengkap semua pesan validasi standar Laravel (max, min, required, image, mimes, dimensions, uploaded, dll) + custom attribute names (`'attributes' => [...]`) untuk mengganti nama field teknis (seperti `image` → `gambar`, `logo_dark` → `logo mode gelap`) dalam pesan error. Semua form upload gambar (Menu, Banner, Event, Gallery, Testimonial, Branding) sudah diaudit dan konsisten dengan validasi `image|mimes:...|max:2048`.

### Client (Landing Page)
- [x] **Client (Landing Page)** — Layout `guest.blade.php` dark theme (neutral-950), sticky navbar Alpine.js, landing page bergaya Crunchyroll (hero → menu unggulan → tentang → galeri → lokasi → testimoni → event → FAQ).
- [x] **Dark/Light Mode** — Toggle di navbar desktop + bottom nav mobile, HANYA sisi Client.
- [x] **Bottom Navbar Mobile** — Floating glass pill custom dengan curved center button (SVG notch), 5 item + label.
- [x] **Lazy Loading Gambar** — Gambar di sisi Client menggunakan `loading="lazy"` + `decoding="async"` di semua view client: guest.blade.php, home.blade.php, menu.blade.php, events.blade.php, events-show.blade.php, gallery.blade.php, gallery-grid.blade.php.

- [ ] **Image Optimization (intervention/image)** — Ditunda karena perlu composer require + service class + modifikasi controller (pekerjaan besar, dikerjakan di sesi terpisah).
- [x] **Logo "FujiYama4"** — Branding gradient+outline di navbar & footer client. (FALLBACK: sekarang menjadi fallback teks jika logo gambar belum diupload)

### Menu
- [x] **Halaman Menu per Kategori** — Menu dipisah per kategori dengan sticky tab navigasi.

### Cart & Order
- [x] **Cart & Order (Checkout via WhatsApp, tanpa login)** — Cart via session_id (guest), checkout → simpan DB → kode FUJI-YYYYMMDD-XXXX → redirect WhatsApp. Admin: index order + ubah status.
- [x] **Client-Side Cart (Alpine.js)** — Store cart pakai fetch API, badge real-time, toast feedback.

### Reservation
- [x] **Reservation (dengan opsi pre-order menu)** — reservation_id nullable di tabel orders, validasi No HP Indonesia.

### Banner
- [x] **Banner (Hero Slider)** — Alpine.js carousel autoplay 5 detik + pagination dots, fallback hero statis.

### Event
- [x] **Event (Promo & Acara)** — Hero banner single-card + floating tab navigation di landing page, halaman /events (filter All/Ongoing/Upcoming, card grid, badge diskon).
- [x] **Halaman Detail Event** — Route model binding by ID, hero full-width, 2-kolom desktop: detail kiri + sidebar "Event Lainnya" kanan, mobile: vertikal + horizontal scroll cards.

### About & Gallery
- [x] **About (Tentang Kami + Gallery Foto)** — Tentang Kami 2-column layout dengan "Baca Selengkapnya" toggle, gallery grid interior/food/beverage + lightbox.
- [x] **Halaman Galeri Foto Terpisah (/galeri)** — Blade partial `gallery-grid.blade.php` dipakai bersama oleh landing page dan halaman /galeri.
- [x] **Photo Selection di About (Admin)** — ~~Modal picker Alpine.js (search, filter kategori, pagination, grid scrollable).~~ **DIGANTI**: Halaman penuh `/admin/about/pilih-foto/{slot}` tanpa modal/Alpine.js — menghilangkan bug overlay CSS yang merusak tampilan. Dua slot preview (Foto Utama + Foto Sekunder) di sidebar kanan edit.blade.php dengan tombol "Pilih/Ganti Foto" (link ke halaman pilih-foto) dan "Hapus Pilihan" (link simpan-foto dengan photo=0). Pilih-foto.blade.php: grid foto, filter kategori via query string, pagination 12 foto/halaman, opsi "Tanpa Foto". Semua navigasi menggunakan `<a href>` biasa — TIDAK ada Alpine.js modal, TIDAK ada `x-data`, TIDAK ada `x-show`, TIDAK ada `@click` overlay.
- [x] **Gallery Categories (Admin)** — CRUD kategori galeri (nama + foto count). Navigasi via tombol "Kelola Kategori" dari halaman /admin/gallery, tanpa item sidebar sendiri. Route prefix `admin/gallery-categories`.

### Location & Settings
- [x] **Setting/Location (Lokasi & Jam Buka)** — Google Maps embed, status buka/tutup real-time + progress bar, floating card overlay (desktop), bottom sheet (mobile).
- [x] **Pengaturan Footer (Admin)** — Form terpisah untuk deskripsi footer & copyright, tersimpan di `restaurant_settings`.
- [x] **Branding (Logo & Favicon)** — Upload logo dark & logo light (2 field terpisah) + favicon via admin panel, preview, Alpine.js switch gambar real-time saat toggle dark/light mode, fallback teks "FujiYama4" jika belum upload. Diterapkan di navbar desktop, navbar mobile, dan footer client. (Update 7/13/2026)
- [x] **Section Content** — Edit judul/subjudul/badge per section landing page (Menu Unggulan, Galeri, Lokasi, Testimoni, Event, FAQ). Blade directive `@accentTitle()` untuk teks aksen gradient.

### Social Media
- [x] **Social Media Links** — Admin CRUD social links (Instagram, Facebook, WhatsApp, TikTok, YouTube, Twitter/X), icon SVG di footer Client per platform, shared via View::composer.

### Testimonial & FAQ
- [x] **Testimonial** — Mobile single-card carousel + desktop paginated 3-column grid, autoplay 4 detik. Seeder: 5 testimoni.
- [x] **FAQ** — Mobile accordion inline + desktop split-view (kiri: daftar pertanyaan, kanan: jawaban). Seeder: 6 FAQ.

---

## Catatan Arsitektur Penting

- Cart & Order bisa diakses tanpa login (guest via session_id).
- Checkout & Reservasi redirect ke WhatsApp setelah simpan ke database.
- Reservasi bisa disertai pre-order menu (reservation_id nullable di tabel orders).
- Dark/light mode HANYA diterapkan di sisi Client, TIDAK di Admin.
- Environment development: Windows + Laragon + PowerShell (bukan bash/Unix shell).
- Validasi No HP Indonesia: regex `^(+62|0)8[1-9][0-9]{6,10}$`.
- Hero slider dual-mode: Alpine.js carousel + fallback hero statis jika tidak ada banner aktif.
- Gallery partial: Blade partial `gallery-grid.blade.php` digunakan bersama oleh landing page (`#galeri-foto`) dan halaman `/galeri` terpisah.
- Struktur section landing page: Hero → Menu Unggulan → Tentang Kami → Galeri → Lokasi → Testimoni → Events & Promo → FAQ.
- Event detail page: route model binding via ID (bukan slug), hero image full-width, layout 2-kolom desktop (65%/35%), sidebar sticky "Event Lainnya", status badge otomatis.
- Social Media: icon SVG inline per platform di footer, icon fallback link icon untuk platform lain, dishare ke semua client views via View::composer.
- Timezone aplikasi: `Asia/Jakarta` (WIB) via `config/app.php` dengan env fallback `APP_TIMEZONE`.
- **WhatsApp**: nomor & isi pesan HARUS selalu ambil dari data database/config (`restaurant_settings`), jangan hardcode.
- **Semua gambar** (banner, event, galeri, menu, logo) harus memiliki fallback image jika file tidak ditemukan di storage.
- Sidebar Admin: semua toggle menggunakan Alpine.js sebagai single source of truth (tidak campur AdminLTE `data-lte-toggle`).

---

## Bug Fix Mobile Gallery (7/13/2026)

- [x] **Halaman /galeri mobile tidak menampilkan semua foto + filter tab hilang** — Partial `gallery-grid.blade.php` yang dipakai bersama oleh landing page (`home.blade.php`) dan halaman `/galeri` (`gallery.blade.php`) memiliki dua bug: (1) filter tab disembunyikan di mobile (`hidden md:flex`), (2) grid mobile hanya mengambil 2 foto (`take(2)`). Bug ini berasal dari desain landing page yang sengaja membatasi 2 foto + tidak ada filter di mobile — namun setting tersebut ikut terbawa ke halaman /galeri. Solusi: tambahkan parameter `$context` ('landing'|'fullpage') dan `$showFilter` (boolean) ke partial. **Landing page**: context='landing' (default, 2 foto, no filter di mobile). **Halaman /galeri**: context='fullpage', showFilter=true (semua foto + filter tampil di mobile). Desktop grid tidak berubah (tetap bento 4-col untuk kedua halaman).

## Footer Navigasi — Sembunyikan di Mobile (7/13/2026)

- [x] **Kolom Navigasi di Footer disembunyikan khusus mobile** — Ditambahkan `hidden md:block` pada div wrapper kolom Navigasi di footer (`guest.blade.php`). Alasan: di mobile sudah ada bottom navbar (floating pill dengan icon Beranda/Event/Menu/Reservasi/Cart) yang berfungsi sama sebagai navigasi, sehingga kolom Navigasi di footer menjadi duplikat tidak perlu. Desktop tetap menampilkan kolom Navigasi normal via `md:block`. Grid `md:grid-cols-3` tetap 3 kolom di desktop, mobile single-column (Brand → Kontak) — tidak ada celah kosong.

## Perbaikan Bug Migration (7/11/2026)

- [x] **Fix: `migrate:fresh` gagal karena FK `cart_items.menu_id` → `menus` belum exist** — Rename file migration Cart & Order untuk memperbaiki urutan eksekusi:
  - Menu: `2026_01_01_000001` (categories), `000002` (menus)
  - Cart: `2026_01_01_000003` (carts), `000004` (cart_items)
  - Order: `2026_01_01_000005` (orders), `000006` (order_items)
  - Akar masalah: sebelumnya Cart (`Cart/`) alfabetis lebih dulu dari Menu (`Menu/`), sedangkan `cart_items` punya FK ke `menus` yang belum dibuat.

## Konsolidasi Database Seeder (7/11/2026)

- [x] **Audit seluruh seeder** — Terdapat 20 file seeder: 9 dengan data aktual, 11 wrapper kosong (`XxxDatabaseSeeder` yang hanya `// $this->call([])`).
- [x] **Buat `GalleryCategorySeeder`** — Seed 4 kategori galeri (Interior, Proses Masak, Suasana, Lainnya) via `GalleryCategory::firstOrCreate()`.
- [x] **Fix `AboutSeeder`** — Sebelumnya menggunakan kolom `category` (enum) yang sudah dihapus oleh migrasi `2026_07_11_150001_change_about_gallery_category_to_fk.php`. Diperbaiki: map enum lama ke `GalleryCategory` model, gunakan `gallery_category_id` FK.
- [x] **Update `DatabaseSeeder.php`** — Urutan panggil 10 seeder aktif berdasarkan dependency:
  1. `MenuDatabaseSeeder`
  2. `SettingSeeder`
  3. `SocialLinkSeeder`
  4. `BannerDatabaseSeeder`
  5. `GalleryCategorySeeder` (baru)
  6. `AboutSeeder`
  7. `EventDatabaseSeeder`
  8. `TestimonialSeeder`
  9. `FaqSeeder`
  10. `SectionContentSeeder`
- [x] **Verifikasi `migrate:fresh --seed`** — Semua 31 migration + 10 seeder sukses tanpa error.

---

## Belum Dikerjakan / Rencana Selanjutnya

- [ ] Search & filter menu (berdasarkan nama, kategori, harga)
- [ ] Halaman detail menu (single menu page)
- [ ] Export laporan order (PDF / Excel)
- [ ] User profile & riwayat order (customer side)
- [ ] Blog / artikel
- [ ] Program loyalitas / poin