# Fujiyama Ramen — Progress Tracker

## Tech Stack
- Laravel v13.8.0 / PHP 8.3.30 / Composer 2.9.4 / Node (npm)
- Laravel Modules v13.0.0 / Laravel Breeze v2.4.2 (blade)
- Database: MySQL `fujiyama_ramen`

---

## Fase 0 — Setup Awal ✅
- `.clinerules`, Laravel 11, `nwidart/laravel-modules`, Laravel Breeze, Tailwind CSS
- Database MySQL `fujiyama_ramen`, `.env` + `.env.example`
- Migration default, `npm install && npm run build`

## Fase 1 — Modul Core & Menu ✅
- Modul `Core` + `Menu`
- Migration: `users` (+phone, address, role), `categories`, `menus`
- Model: `Category` hasMany `Menu`, `Menu` belongsTo `Category`
- Seeder: 3 kategori + 7 menu dummy

## Fase 2 — Modul Admin (Layout + Auth) ✅
- Modul `Admin` + `AdminMiddleware`
- AdminLTE v4 (CDN) layout: sidebar, topbar, konten, footer
- Dashboard: 3 small-box statistik
- Login redirect by role (admin → /admin/dashboard, customer → /)

## Fase 3 — CRUD Kategori & Menu (Admin) ✅
- `CategoryController` + `MenuController`: full CRUD + validasi + upload gambar ke `storage/app/public/menus`
- Slug auto-generated, delete dicegah jika kategori punya menu
- Views: index (tabel pagination), create, edit

## Fase 4 — Modul Client: Landing Page ✅
- Modul `Client`, route `/` → `ClientController@home`
- Layout `guest.blade.php`: dark theme (neutral-950), sticky navbar (Alpine.js), footer
- `home.blade.php`: hero, featured menu grid, category cards, promo CTA banner

## Fase 5 — Halaman Menu + Modul Cart ✅
- Modul `Cart` + migration `carts` & `cart_items`
- `CartController`: index, store, update, destroy (cart via session + user_id)
- View `cart/index.blade.php`: dark-theme, qty +/- / hapus, subtotal + total
- Halaman `/menu`: grouping per kategori, tombol "Tambah ke Keranjang" → `cart.store`
- Navbar client: Beranda, Menu, Keranjang (desktop + mobile hamburger)

## Fase 6 — Modul Order (Checkout + Admin) ✅
- Modul `Order`, migration `orders` & `order_items` (snapshot harga)
- `OrderController`: checkout → store (FUJI-YYYYMMDD-XXXX) → success
- Admin: index (pagination + dropdown status), show (detail + ubah status)
- Dashboard admin: data real dari tabel orders

## Fase 7 — Finishing MVP ✅
- Validasi form di semua controller, README.md, flash message
- Middleware admin di semua route /admin/*

### ✅ MVP v1.0 SELESAI — 6 modul: Core, Menu, Admin, Client, Cart, Order

---

## Post-MVP — Reservasi + WhatsApp + Validasi HP ✅
- **Modul Reservation**: migration `reservations` (name, phone, date, time, guests, note, status)
- **WhatsApp**: redirect ke `wa.me/{RESTAURANT_WHATSAPP}` setelah checkout/reservasi
- **Validasi No HP**: regex `^(+62|0)8[1-9][0-9]{6,10}$`
- **Admin Reservasi**: CRUD index/show/updateStatus
- **Pre-Order via Reservasi**: kolom `reservation_id` di `orders`, cart item snapshot saat reservasi

## Client-Side Cart Integration ✅
- Alpine.js cart store (`resources/js/app.js`) — add/update/remove via fetch API
- Badge keranjang real-time + toast feedback

## Modul Event (Promo & Acara) ✅
- Modul `Event`, migration `events` (title, desc, start/end date, image, discount_promo, status)
- Admin CRUD, Client: section card slider di landing page + halaman `/events`

## Modul Banner (Hero Slider) ✅
- Modul `Banner`, migration `banners` (title, subtitle, desc, cta_text/link, image, order, is_active)
- Admin CRUD, Client: Alpine.js carousel autoplay 5 detik + pagination dots
- Fallback hero statis jika tidak ada banner

## Dark Mode Toggle ✅
- `darkMode: 'class'` di Tailwind, anti-flash script di `<head>`
- Toggle button (desktop navbar + mobile bottom nav)
- Dual-mode colors di semua view client: guest, home, menu, cart, checkout, success, reservation, events

---

## 🎨 UI Polish ✅
- **Navbar Glassmorphism**: `bg-white/90 dark:bg-neutral-950/90 backdrop-blur-2xl`, border highlight, shadow
- **Hapus bookmark button** & login/register link dari client navbar
- **Bottom Navbar Mobile**: curved center button (oranye), SVG notch, 5 item + label, `lg:hidden`
- **Hero 2-Kolom Desktop**: grid `md:grid-cols-2` — kiri teks, kanan gambar card (`rounded-2xl`, shadow, border)
- **Hero Mobile Blend**: gambar atas + fade gradient → teks overlap (`-mt-6`)
- **Hero Tinggi**: `h-[calc(100vh-4rem)] lg:h-[calc(100vh-5rem)]`, text bottom-aligned
- **Hero Dual-Mode**: gradient overlay, badge, title, description, pagination dots, CTA — semua light/dark

## Modul About (Tentang Kami) ✅
- Modul `About`, migration `about_us` (singleton: title, subtitle, story), `about_gallery` (image, caption, category, order)
- Model: `AboutUs::getContent()` auto `firstOrCreate` default record, `AboutGallery` dengan accessor `image_url`, scope `category()`
- Admin: halaman `/admin/about` (singleton edit text + tab "Interior" + tab "Galeri Foto" dengan upload + label kategori)
- Client: section `#tentang-kami` di landing page — story text dengan "Baca Selengkapnya" toggle, gallery grid khusus interior (category=interior)
- Client: section `#galeri-foto` di landing page — 3 tab (Proses Masak, Suasana, Lainnya), grid foto, lightbox modal
- Seeder: 1 record AboutUs + 6 placeholder foto gallery (2 interior, 2 proses_masak, 2 suasana)
- Menu "Tentang Kami" di sidebar Admin

## Modul Setting (Lokasi & Jam Buka) ✅
- Modul `Setting`, migration `restaurant_settings` (singleton: address, phone, google_maps_embed_url, opening_hours JSON)
- Model: `RestaurantSetting::getContent()` auto `firstOrCreate` default record
- Admin: halaman `/admin/settings/location` — form edit alamat, telepon, Google Maps embed URL, 7 hari jam operasional
- Client: section `#lokasi` di landing page — alamat, telepon, Google Maps iframe, tabel jam operasional per-hari
- Real-time open/close badge dengan animasi pulse hijau/merah + jadwal hari ini
- Highlight hari ini di tabel jam operasional dengan border oranye
- Seeder: default alamat + jam operasional Fujiyama Ramen
- Menu "Pengaturan" → "Lokasi & Jam Buka" di sidebar Admin

---

## Modul Testimonial (Apa Kata Pelanggan) ✅
- Modul `Testimonial`, migration `testimonials` (customer_name, customer_photo, rating 1-5, review, order_type, status, order)
- Model: `Testimonial` dengan accessor `initials`, `customer_photo_url`, scope `active()`, scope `ordered()`
- Admin: CRUD lengkap di `/admin/testimonials` — index, create, edit, delete dengan konfirmasi
- Client: section `#testimoni` di landing page — grid card 3 kolom, bintang rating, quote icon, nama + inisial pelanggan, empty state
- Seeder: 5 testimoni dummy dengan nama lokal dan pesanan menu ramen
- Menu "Testimoni" di sidebar Admin

## Modul FAQ (Pertanyaan Umum) ✅
- Modul `Faq`, migration `faqs` (question, answer, order, is_active)
- Model: `Faq` dengan scope `active()`, scope `ordered()`
- Admin: CRUD lengkap di `/admin/faqs` — index, create, edit, delete dengan konfirmasi
- Client: section `#faq` di landing page — Alpine.js accordion dengan animasi expand/collapse, highlight border oranye saat aktif
- Seeder: 6 FAQ items (jam buka, reservasi, menu vegetarian, parkir, pesan online, makanan dibawa pulang)
- Menu "FAQ" di sidebar Admin

---

## 🐛 Bug Fixes Summary ✅

| Bug | Root Cause | Fix |
|-----|-----------|-----|
| **Cart badge reset** | Race condition seed via `window.__CART_COUNT__` | View Composer seeding langsung dari Blade |
| **Client routes not registered** | Client tidak punya RouteServiceProvider | Buat RouteServiceProvider + register di module.json |
| **Event module self-reference** | EventServiceProvider daftarkan dirinya sendiri | Ganti ke `Illuminate\Foundation\Support\Providers\EventServiceProvider` |
| **Events table not migrated** | Migration modul Event belum dijalankan | `php artisan module:migrate Event` |
| **Storage link missing** | Public storage symlink belum ada | `php artisan storage:link` |
| **Reservasi dark mode statis** | File orphan `create.blade` vs `create.blade.php` | Overwrite + hapus file orphan |
| **Admin redirect loop** | Middleware `web` dipasang 2x | Hapus middleware `web` dari route group admin |
| **Gambar Menu 403/404** | `APP_URL` tidak include subfolder proyek | Ubah `APP_URL` + `optimize:clear` |
| **Pagination /events error** | `->get()` bukan `->paginate()` | Ubah ke `->paginate(6)` |
| **Gambar Event 403/404** | Accessor double path `storage/events/events/...` | Fix: `asset('storage/' . $this->image)` |
| **Cart view syntax error** | Unclosed bracket `[` line 120 | Fix bracket mismatch |
| **CoreServiceProvider missing** | Modul Core tidak punya provider | Tambah RouteServiceProvider |

---

## 📋 Route Summary

### Client Routes
| Method | URI | Name |
|--------|-----|------|
| GET | `/` | client.home |
| GET | `/menu` | client.menu |
| GET | `/events` | client.events |
| GET,POST | `/cart` | cart.index, cart.store |
| PATCH,DELETE | `/cart/{cartItem}` | cart.update, cart.destroy |
| GET,POST | `/checkout` | order.checkout, order.store |
| GET | `/order/success/{orderCode}` | order.success |
| GET,POST | `/reservation` | reservation.create, reservation.store |

### Admin Routes
| Method | URI | Name |
|--------|-----|------|
| GET | `/admin/dashboard` | admin.dashboard |
| GET,POST,PUT,DELETE | `/admin/categories` | admin.categories.* |
| GET,POST,PUT,DELETE | `/admin/menus` | admin.menus.* |
| GET,POST,PUT,DELETE | `/admin/events` | admin.events.* |
| GET,POST,PUT,DELETE | `/admin/banners` | admin.banners.* |
| GET,POST,PATCH | `/admin/orders` | admin.orders.* |
| GET,POST,PATCH | `/admin/reservations` | admin.reservations.* |
| GET,PUT | `/admin/about` | admin.about.edit, admin.about.update |
| POST | `/admin/about/gallery` | admin.about.gallery.store |
| DELETE | `/admin/about/gallery/{gallery}` | admin.about.gallery.destroy |
| GET,POST,PUT,DELETE | `/admin/testimonials` | admin.testimonials.* |
| GET,PUT | `/admin/settings/location` | admin.settings.location.edit, admin.settings.location.update |

### Auth Routes (Breeze — hanya yang diaktifkan)
| Method | URI | Name |
|--------|-----|------|
| GET,POST | `/login` | login |
| POST | `/logout` | logout |

---

**Status: Production Ready ✅**