# Fujiyama Ramen — Progress Tracker

## Tech Stack
- Laravel v13.8.0 / PHP 8.3.30 / Composer 2.9.4 / Node (npm)
- Laravel Modules v13.0.0 / Laravel Breeze v2.4.2 (blade)
- Database: MySQL `fujiyama_ramen`
- Environment: Windows + Laragon + PowerShell

---

## Modul Selesai

- [x] **Core & Menu** — Modul `Core` + `Menu`, migration `users` (+phone, address, role), `categories`, `menus`. Model `Category` hasMany `Menu`, `Menu` belongsTo `Category`. Seeder: 3 kategori + 7 menu dummy.

- [x] **Admin (Auth + Dashboard + Layout)** — Modul `Admin`, `AdminMiddleware`, layout AdminLTE v4 CDN (sidebar, topbar, footer). Dashboard statistik. Login redirect by role (admin → /admin/dashboard, customer → /).

- [x] **CRUD Kategori & Menu (Admin)** — `CategoryController` + `MenuController`: full CRUD, validasi, upload gambar ke `storage/app/public/menus`. Slug auto-generated, delete dicegah jika kategori punya menu.

- [x] **Client (Landing Page)** — Modul `Client`, route `/` → `ClientController@home`. Layout `guest.blade.php` dark theme (neutral-950), sticky navbar (Alpine.js), footer. `home.blade.php`: hero, featured menu grid, category cards, promo CTA banner.

- [x] **Cart & Order (Checkout via WhatsApp, tanpa perlu login)** — Modul `Cart` (migration `carts` & `cart_items`) + Modul `Order` (migration `orders` & `order_items` snapshot harga). Cart via session_id (guest) atau user_id. Halaman `/menu` grouping per kategori + "Tambah ke Keranjang". Checkout → simpan ke DB → generate kode FUJI-YYYYMMDD-XXXX → redirect WhatsApp. Admin: index order (pagination + dropdown status), show (detail + ubah status).

- [x] **Reservation (dengan opsi pre-order menu)** — Modul `Reservation`, migration `reservations` (name, phone, date, time, guests, note, status). Pre-order: kolom `reservation_id` nullable di `orders`, cart item snapshot saat reservasi. Validasi No HP: regex `^(+62|0)8[1-9][0-9]{6,10}$`. Admin: CRUD index/show/updateStatus.

- [x] **Client-Side Cart (Alpine.js)** — Alpine.js cart store (`resources/js/app.js`) — add/update/remove via fetch API. Badge keranjang real-time + toast feedback.

- [x] **Event (Promo & Acara)** — Modul `Event`, migration `events` (title, desc, start/end date, image, discount_promo, status). Admin CRUD. Client: hero banner single-card + floating tab navigation di landing page + halaman `/events`.

- [x] **Banner (Hero Slider)** — Modul `Banner`, migration `banners` (title, subtitle, desc, cta_text/link, image, order, is_active). Admin CRUD. Client: Alpine.js carousel autoplay 5 detik + pagination dots. Fallback hero statis jika tidak ada banner.

- [x] **Dark/Light Mode Toggle** — `darkMode: 'class'` di Tailwind, anti-flash script di `<head>`. Toggle button (desktop navbar + mobile bottom nav). Dual-mode colors di SEMUA view Client (home, menu, cart, checkout, success, reservation, events, gallery, partials). HANYA berlaku di sisi Client, TIDAK di Admin.

- [x] **Bottom Navbar Mobile** — Floating glass pill custom: curved center button (oranye), SVG notch, 5 item + label, `lg:hidden`. Matching transparency/blur dengan floating card di lokasi.

- [x] **About (Tentang Kami + Gallery Foto)** — Modul `About`, migration `about_us` (singleton: title, subtitle, story) + `about_gallery` (image, caption, category, order). Admin: edit teks Tentang Kami + CRUD Galeri terpisah (thumbnail grid + filter kategori). Client: section `#tentang-kami` (story + "Baca Selengkapnya" toggle, gallery grid interior), section `#galeri-foto` (3 tab filter + bento grid + lightbox modal + scroll-reveal). Seeder: 1 record AboutUs + 6 foto gallery.

- [x] **Halaman Galeri Foto Terpisah (/galeri)** — Route `/galeri` (tanpa login). View `gallery.blade.php` memakai partial `gallery-grid.blade.php` yang sama dengan landing page. Landing page dibatasi 9 foto + tombol "Lihat Semua Foto" jika total > 9.

- [x] **Setting/Location (Lokasi & Jam Buka)** — Modul `Setting`, migration `restaurant_settings` (singleton: address, phone, google_maps_embed_url, opening_hours JSON). Admin: form edit alamat, telepon, Google Maps embed URL, 7 hari jam operasional. Client: full-width map + floating card overlay (status hari ini, progress bar, alamat, telepon, jam buka accordion). Real-time open/close badge dengan animasi pulse. Mobile: full-bleed map + bottom sheet (ride-share UI style). Seeder: default alamat + jam operasional.

- [x] **Testimonial (Apa Kata Pelanggan)** — Modul `Testimonial`, migration `testimonials` (customer_name, customer_photo, rating 1-5, review, order_type, status, order). Admin: CRUD lengkap. Client: Alpine.js slider — mobile single-card carousel + desktop paginated 3-column grid (autoplay 4 detik). Empty state friendly. Seeder: 5 testimoni dummy.

- [x] **FAQ (Pertanyaan Umum)** — Modul `Faq`, migration `faqs` (question, answer, order, is_active). Admin: CRUD lengkap. Client: Alpine.js accordion dengan animasi expand/collapse, highlight border oranye saat aktif. Seeder: 6 FAQ items.

---

## Catatan Arsitektur Penting

- **Cart & Order bisa diakses tanpa login** — Guest diidentifikasi via `session_id`, tidak wajib register/login untuk checkout.
- **Checkout & Reservasi redirect ke WhatsApp** — Setelah data disimpan ke database, user diarahkan ke `wa.me/{RESTAURANT_WHATSAPP}` dengan pesan terformat.
- **Reservasi bisa disertai pre-order menu** — Kolom `reservation_id` nullable di tabel `orders` memungkinkan order menu bersamaan dengan reservasi.
- **Dark/light mode HANYA di sisi Client** — Admin tetap menggunakan tema terang AdminLTE. Tidak ada toggle dark mode di panel admin.
- **Environment development: Windows + Laragon + PowerShell** — Semua perintah CLI menggunakan PowerShell (bukan bash/Unix shell). Gunakan `Get-Content`, `Select-String`, `Get-ChildItem`, dll.
- **Validasi No HP Indonesia** — Regex `^(+62|0)8[1-9][0-9]{6,10}$` untuk format 08xx atau +62.
- **Hero slider dual-mode** — Fallback hero statis jika tidak ada banner aktif. Alpine.js carousel dengan transisi opacity, autoplay, pagination dots.
- **Bottom navbar mobile** — Custom floating glass pill dengan curved center button (SVG notch), konsisten dengan floating card di section lokasi.
- **Gallery partial** — Blade partial `gallery-grid.blade.php` digunakan bersama oleh landing page (`#galeri-foto`) dan halaman `/galeri` terpisah.
- **Struktur section landing page**: Hero → Menu → Tentang Kami → Galeri → Lokasi → Testimoni → Events & Promo → FAQ.