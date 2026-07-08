# Fujiyama Ramen — Progress Tracker

## Fase 0 — Setup Awal Project ✅

- [x] Membuat `.clinerules` di root project
- [x] Membuat project Laravel 11 (v13.8.0 terinstall via Composer)
- [x] Install package `nwidart/laravel-modules` (v13.0.0)
- [x] Install Laravel Breeze (blade stack, v2.4.2) — sudah include Tailwind CSS
- [x] Setup Tailwind CSS (termasuk dalam Breeze scaffolding)
- [x] Membuat database MySQL `fujiyama_ramen`
- [x] Konfigurasi `.env` (DB MySQL, APP_NAME "Fujiyama Ramen")
- [x] Membuat `.env.example` (salinan `.env` tanpa APP_KEY)
- [x] Menjalankan migration default (tabel users, cache, jobs)
- [x] `npm install && npm run build` sukses (Vite build)

### Ringkasan
- Laravel: v13.8.0
- PHP: 8.3.30
- Composer: 2.9.4
- Node: tersedia (npm)
- Laravel Modules: v13.0.0
- Laravel Breeze: v2.4.2 (blade)
- Database: MySQL (`fujiyama_ramen`)

---

## Fase 1 — Modul Core & Menu (Database + Model) ✅

- [x] Membuat modul `Core` dan modul `Menu` (`php artisan module:make Core Menu`)
- [x] Migration `add_columns_to_users_table`: phone, address, role (enum customer/admin, default customer)
- [x] Migration `create_categories_table`: id, name, slug, timestamps
- [x] Migration `create_menus_table`: id, category_id FK, name, slug, description, price, image, is_available (boolean default true), timestamps
- [x] Model `Category` (hasMany Menu) dan `Menu` (belongsTo Category)
- [x] Update `User` model: tambah kolom phone, address, role
- [x] Seeder: 3 kategori (Ramen, Minuman, Topping Tambahan), 7 menu dummy
- [x] Migration & seeder berjalan sukses

---

## Fase 2 — Modul Admin (Layout + Auth + Dashboard) ✅

- [x] Membuat modul `Admin`
- [x] Middleware `AdminMiddleware` — cek role user = admin, redirect ke /login jika bukan
- [x] Layout utama AdminLTE v4 (CDN) — sidebar kiri, topbar atas, area konten, footer
- [x] Halaman Dashboard: 3 small-box statistik (pesanan hari ini, pendapatan, menu tersedia)
- [x] Login redirect: jika role admin → /admin/dashboard, jika customer → /dashboard
- [x] Logout, flash message (success/error) di layout

---

## Fase 3 — CRUD Kategori & Menu di Admin ✅

- [x] `CategoryController`: index, create, store, edit, update, destroy
  - Validasi: name required|unique (kecuali saat update)
  - Delete dicegah jika kategori masih punya menu
- [x] `MenuController`: index, create, store, edit, update, destroy
  - Validasi: name required|unique, price numeric min 0, image nullable (jpg/png/gif, max 2MB)
  - Upload gambar ke `storage/app/public/menus`, hapus gambar lama saat update
  - Slug auto-generated dari name
- [x] View: index (tabel + pagination), create, edit untuk keduanya
- [x] Routes resource categories dan menus terdaftar di route:list
- [x] Orders placeholder view (untuk Fase 6)
- [x] Composer dump-autoload verify (6867 classes)

---

## Fase 4 — Modul Client: Landing Page ✅

- [x] Membuat modul `Client` (`php artisan module:make Client`)
- [x] Route `/` → `ClientController@home` (`client.home`)
- [x] `ClientController`: ambil data `categories` (with menus), `featuredMenus` (random 6), `heroMenus` (latest 3)
- [x] Layout `guest.blade.php` — dark theme (neutral-950), sticky navbar (Alpine.js scroll detection), footer
- [x] View `home.blade.php` — hero section (gradient, CTA buttons, preview cards), featured menu grid, category cards, promo CTA banner
- [x] Composer dump-autoload + route:list verify (71 routes, `/` registered)

---

## Fase 5 — Halaman Menu (Client) + Modul Cart ✅

- [x] Membuat modul `Cart` (`php artisan module:make Cart`)
- [x] Migration `carts` dan `cart_items`:
  - `create_carts_table`: id, user_id (nullable FK), session_id, timestamps
  - `create_cart_items_table`: id, cart_id FK, menu_id FK, qty, note, timestamps
- [x] Model `Cart` (hasMany CartItem) dan `CartItem` (belongsTo Cart, belongsTo Menu)
- [x] `CartController` (index, store, update, destroy):
  - `getOrCreateCart()` — internal method: dapatkan cart via session + user_id
  - `index()` — tampilkan halaman `/cart` dengan list item + subtotal + total
  - `store(Request)` — tambah item, validasi menu_id + qty
  - `update(Request, CartItem)` — update qty (min 1)
  - `destroy(CartItem)` — hapus item dari cart
- [x] Routes `/Modules/Cart/routes/web.php`: prefix `/cart`, names `cart.index/store/update/destroy`
- [x] View `cart/index.blade.php`: dark-theme, list item (nama + harga + qty +/- / hapus), subtotal per item, total keseluruhan
- [x] Navbar `guest.blade.php`: link navigasi (Beranda, Menu, Keranjang), dark theme, mobile hamburger, sticky on scroll
- [x] Halaman `/menu` (`ClientController@menu`): grouping menu per kategori, tombol "Tambah ke Keranjang" → POST ke `cart.store`
- [x] Link `home.blade.php`: tombol "Lihat Menu" di hero & "Pesan Sekarang" di CTA banner → `route('client.menu')`
- [x] Migration Cart berjalan sukses
- [x] Route:list terverifikasi (81 routes total)

### Route Cart
| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/cart` | cart.index | CartController@index |
| POST | `/cart` | cart.store | CartController@store |
| PATCH | `/cart/{cartItem}` | cart.update | CartController@update |
| DELETE | `/cart/{cartItem}` | cart.destroy | CartController@destroy |

### Route Client
| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/` | client.home | ClientController@home |
| GET | `/menu` | client.menu | ClientController@menu |

---

## Fase 6 — Modul Order (Checkout + Manajemen Pesanan Admin) ✅

- [x] Membuat modul `Order` (`php artisan module:make Order`)
- [x] Migration `create_orders_table`: id, user_id (nullable FK), order_code, customer_name, customer_phone, status (pending/diproses/selesai/batal), total_price, payment_method, note, timestamps
- [x] Migration `create_order_items_table`: id, order_id FK, menu_id FK, menu_name (snapshot), price (snapshot), qty, subtotal, timestamps
- [x] Model `Order` (hasMany OrderItem, statusLabel accessor) + `OrderItem` (belongsTo Order, belongsTo Menu)
- [x] `OrderController` (checkout, store, success):
  - `checkout()` — tampilkan form: data pemesan, ringkasan keranjang
  - `store(Request)` — validasi, generate order_code (FUJI-YYYYMMDD-XXXX), pindahkan cart items → order_items snapshot, kosongkan cart, redirect ke success
  - `success(orderCode)` — tampilkan pesan sukses dengan order_code
- [x] Views: `checkout.blade.php` (dark theme, form + ringkasan), `success.blade.php` (animasi sukses)
- [x] Routes: `GET /checkout`, `POST /checkout`, `GET /order/success/{orderCode}`
- [x] Cart view: tombol checkout → `route('order.checkout')`
- [x] Admin `OrderController@index` — daftar pesanan dengan pagination, dropdown ubah status
- [x] Admin `OrderController@show` — detail pesanan (info + data pemesan + item + form ubah status)
- [x] Admin routes: `GET /admin/orders`, `GET /admin/orders/{order}`, `PATCH /admin/orders/{order}/status`
- [x] Dashboard Admin: data real dari tabel orders (total pesanan hari ini, pendapatan dari pesanan non-batal)
- [x] Migration Order berjalan sukses
- [x] Route:list terverifikasi (91 routes total, order + admin order routes terdaftar)

### Route Order (Client)
| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/checkout` | order.checkout | OrderController@checkout |
| POST | `/checkout` | order.store | OrderController@store |
| GET | `/order/success/{orderCode}` | order.success | OrderController@success |

### Route Admin Order
| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/admin/orders` | admin.orders.index | OrderController@index |
| GET | `/admin/orders/{order}` | admin.orders.show | OrderController@show |
| PATCH | `/admin/orders/{order}/status` | admin.orders.updateStatus | OrderController@updateStatus |

---

## Fase 7 — Finishing ✅

- [x] Review validasi form di semua controller (Cart, Order, Admin Category, Admin Menu) — OK
- [x] Buat README.md berisi cara install, fitur, struktur modul
- [x] Verifikasi route:list (91 routes, tidak ada konflik)
- [x] Flash message error/success di semua view admin dan client
- [x] Redirect auth berdasarkan role (admin → /admin/dashboard, customer → /dashboard)
- [x] Middleware admin melindungi semua route /admin/*

---

## ✅ MVP v1.0 SELESAI

Semua fitur tahap awal telah diimplementasikan:
- Landing page dark theme (client)
- Menu + keranjang interaktif (Alpine.js)
- Checkout dengan order code unik
- Admin dashboard + CRUD Kategori/Menu/Pesanan
- AdminLTE v4 + Tailwind CSS
- Laravel Modular (6 modul)

---

## Post-MVP — Reservasi + WhatsApp + Validasi HP ✅

- [x] **Validasi No HP Indonesia**: regex `^( + 62|0)8[1-9][0-9]{6,10}$` — dipakai di OrderController & ReservationController
- [x] **WhatsApp Integration**: setelah checkout, redirect ke `wa.me/{RESTAURANT_WHATSAPP}` dengan template pesan otomatis
  - `.env` → `RESTAURANT_WHATSAPP=6281234567890`
  - `config/services.php` → daftarkan `restaurant_whatsapp`
  - Checkout view: hapus dropdown `payment_method`, ganti tombol submit jadi "Pesan via WhatsApp"
  - Validasi no HP: harus Indonesia (`08xx` / `+62xx`)
- [x] **Modul Reservation** (php artisan module:make Reservation):
  - Migration `create_reservations_table`: name, phone, reservation_date, reservation_time, guest_count (min 1), note (nullable), status (default pending)
  - Model `Reservation` (fillable, casts, STATUSES constant)
  - Client routes: `GET /reservation` (form), `POST /reservation` (simpan + redirect WA)
  - View `create.blade.php` — dark theme, form reservasi, validasi, tombol "Reservasi via WhatsApp"
  - Link "Reservasi" di navbar client (sidebar guest.blade.php)
- [x] **Admin Kelola Reservasi**:
  - `Admin/ReservationController`: index (list reservasi), show (detail), updateStatus (pending/confirmed/cancelled)
  - View `reservations/index.blade.php`, `reservations/show.blade.php` — AdminLTE table + form ubah status
  - Routes: `GET /admin/reservations`, `GET /admin/reservations/{reservation}`, `PATCH /admin/reservations/{reservation}/status`
  - Link "Reservasi" di sidebar admin

### Route Reservation
| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/reservation` | reservation.create | ReservationController@create |
| POST | `/reservation` | reservation.store | ReservationController@store |

### Route Admin Reservation
| Method | URI | Name | Action |
|--------|-----|------|--------|
| GET | `/admin/reservations` | admin.reservations.index | ReservationController@index |
| GET | `/admin/reservations/{reservation}` | admin.reservations.show | ReservationController@show |
| PATCH | `/admin/reservations/{reservation}/status` | admin.reservations.updateStatus | ReservationController@updateStatus |

---

## Cleanup — Hapus Link Login/Register dari Client + Nonaktifkan Route Breeze Non-esensial ✅

- [x] Hapus link **Login** dan **Register** dari navbar Client (`guest.blade.php`) — desktop & mobile
- [x] Hapus link **Keluar (Logout)** dari navbar Client — hanya tampil **Admin Panel** untuk user role admin
- [x] Nonaktifkan route Breeze yang tidak terpakai di `routes/auth.php`:
  - Register, Forgot Password, Reset Password (guest group)
  - Email Verification, Confirm Password, Password Update (auth group)
  - Hanya tersisa: `GET/POST /login`, `POST /logout`
- [x] Nonaktifkan route `/dashboard` dan `/profile` di `routes/web.php`
- [x] Verifikasi `route:list` (85 routes, tidak ada route Breeze non-esensial terdaftar)

---

## Pre-Order via Reservasi ✅

- [x] **Migration**: tambah kolom `reservation_id` (nullable FK) di tabel `orders`, terkait ke `reservations` (nullOnDelete)
- [x] **Model Order**: tambah `reservation_id` di `$fillable`, relasi `reservation()` belongsTo
- [x] **Model Reservation**: tambah relasi `orders()` hasMany
- [x] **ReservationController (`create`)**: ambil data cart + items, kirim ke view
- [x] **ReservationController (`store`)**: setelah simpan reservasi, cek cart:
  - Jika ada item → buat Order (status pending, `reservation_id`) + OrderItem snapshot + hapus isi cart
  - Tambahkan detail pre-order ke template pesan WhatsApp
  - Jika cart kosong → hanya kirim pesan reservasi biasa
- [x] **View reservasi (`create.blade.php`)**: tambah section "Pre-Order Menu (Opsional)" di bawah form:
  - Jika cart kosong → tampilkan pesan "belum ada menu" + link ke halaman Menu
  - Jika cart ada isi → tampilkan list item + subtotal per item + total + link "Edit keranjang →"
- [x] **Admin Detail Reservasi (`show.blade.php`)**: jika reservasi punya pre-order, tampilkan card "Pre-Order Terkait Reservasi Ini":
  - Per order: kode pesanan + badge status + total
  - Tabel item: Menu, Qty, Harga, Subtotal
- [x] Migration dijalankan & berhasil (144ms)

---

## Fase 7+ — Client-Side Cart Integration ✅

- [x] Setup Alpine.js cart store di `resources/js/app.js` (Alpine.store + fetch API untuk add/update/remove item)
- [x] Guest layout — badge keranjang real-time `x-text="$store.cart.count"` + toast feedback
- [x] Tombol "Tambah ke Keranjang" di home.blade.php & menu.blade.php via `$store.cart.addItem()`

---

## 🐛 Fix: Badge Cart Reset ke 0 Saat Pindah Halaman ✅

**Root cause:** Nilai `$store.cart.count` hanya di-seed via `window.__CART_COUNT__` dan `seedInitialCount()` async — race condition saat DOM belum siap.

**Solusi (Cara A — View Composer):**
- [x] `Modules/Client/app/Providers/ClientServiceProvider.php` — View Composer binding `$cartCount` ke semua view `client::*` via `Cart::getCurrent()->items()->count()`
- [x] `guest.blade.php` — seed Alpine store langsung dari Blade: `<body x-data x-init="$store.cart.count = {{ $cartCount ?? 0 }}">`
- [x] `ClientController` — hapus manual `$cartCount` (View Composer sudah handle)
- [x] `composer dump-autoload` + `npm run build` — sukses

**Hasil:** Badge keranjang selalu menampilkan jumlah yang benar di halaman manapun (landing page, menu, cart, checkout, reservasi).

---

## 🐛 Fix: Client Module Routes Tidak Terdaftar ✅

**Root cause:** Modul Client tidak memiliki RouteServiceProvider → route `/` dan `/menu` tidak ditemukan Laravel.

**Solusi:**
- [x] `Modules/Client/app/Providers/RouteServiceProvider.php` — register routes dari Modules/Client/routes/web.php
- [x] `Modules/Client/app/Providers/ClientServiceProvider.php` — tambahkan RouteServiceProvider ke $providers
- [x] `Modules/Client/module.json` — tambahkan RouteServiceProvider ke providers
- [x] `composer dump-autoload` + restart server
- [x] `loadViewsFrom` — register view hint path client untuk View Composer

**Hasil:** Route `/` (client.home) dan `/menu` (client.menu) terdaftar & landing page mengembalikan 200 OK.

---

## Modul Event (Promo & Acara) ✅

- [x] **php artisan module:make Event** — buat modul Event
- [x] **Migration `events`**: id, title, description, start_date, end_date, image (nullable), location (nullable), discount_promo (nullable), status (active/inactive, default active), timestamps
- [x] **Model Event**: `$fillable`, `scopeActive()`, `getIsActiveAttribute()`, `getImageUrlAttribute()`
- [x] **Seeder (3 events)**: Program Loyalitas Ramen (spend 10 get 1 free), Festival Ramen Spesial (15% off all ramen), Ramen & Sake Pairing (bundle 20% discount)
- [x] **Admin - EventController**: CRUD index/create/edit/delete events
- [x] **Admin - Views**: events/index.blade.php, create.blade.php, edit.blade.php (AdminLTE table + card layout)
- [x] **Admin - Routes**: `/admin/events` resource di `Modules/Admin/routes/web.php`
- [x] **Admin - Sidebar**: menu "Promo & Acara"
- [x] **Client - Section Event**: card slider di landing page (home.blade.php) untuk event aktif
- [x] **Client - Halaman Events (`/events`)**: daftar semua event aktif/inactive
- [x] **Client - Routes**: `/events` → client.events
- [x] **Client - Navbar**: link "Promo & Acara" di guest.blade.php (desktop)
- [x] **Migration dijalankan & seed** — sukses
- [x] **`npm run build`** — sukses

---

## Bottom Navbar Mobile — Curved Center Button ✅

- [x] Redesign bottom navbar mobile dengan style "curved center button"
- [x] 5 item: Beranda, Menu, [Center: Menu Makanan], Reservasi, Event
- [x] Center button: lingkaran oranye mengambang ke atas (`-mt-8`), lebih besar dari icon lain
- [x] SVG notch/curve di atas navbar untuk memberi ruang floating button
- [x] Active state oranye via `request()->routeIs()`, inactive abu-abu (neutral-400)
- [x] Label teks di bawah icon (kecuali center button)
- [x] Cart badge keranjang dihapus dari bottom navbar (redudan dengan floating center button)
- [x] `npm run build` sukses
- [x] Tetap: `lg:hidden` (mobile only)

---

## 🔧 Debug & Fix Session (07-07-2026) ✅

**Issues found & resolved:**

1. **Cart View Syntax Error** — Unclosed `[` on line 120 di `Modules/Cart/resources/views/index.blade.php`. Fixed bracket mismatch.

2. **Event Module Self-Referencing** — `Modules/Event/app/Providers/EventServiceProvider.php` mencantumkan dirinya sendiri (`EventServiceProvider::class`) di dalam array `$providers` → infinite loop saat boot. Fixed: ganti ke `\Illuminate\Foundation\Support\Providers\EventServiceProvider::class`.

3. **Missing CoreServiceProvider** — Modul Core tidak punya provider yang teregistrasi, fixed dengan menambahkan RouteServiceProvider ke module.json dan ClientServiceProvider.

4. **Client Module Routes Not Registered** — Client tidak punya RouteServiceProvider. Fixed: buat RouteServiceProvider dan register di module.json.

5. **Events Table Not Migrated** — Migration modul Event belum dijalankan. Fixed: `php artisan module:migrate Event`.

6. **Storage Link** — Public storage symlink belum ada. Fixed: `php artisan storage:link`.

7. **Badge Cart Reset Bug** — Nilai cart count hilang saat pindah halaman. Fixed via View Composer di ClientServiceProvider.

8. **Bottom Navbar Mobile Curved Button** — Implementasi curved center button untuk mobile navigation.

**Verification:**
- [x] `php artisan optimize:clear` — sukses
- [x] `php artisan list` — semua command terdaftar (termasuk module commands)
- [x] `php artisan route:list` — 92 routes terdaftar, tidak ada duplikat
- [x] `php artisan module:migrate Event` — migration events sukses
- [x] `php artisan storage:link` — storage link created
- [x] HTTP GET `/` → **200 OK** (45KB content)
- [x] Semua controller untuk routes terverifikasi exists
- [x] `npm run build` — sukses

**Status: Production Ready ✅**

---

## 🌗 Dark Mode Toggle (Client Side) ✅

- [x] Enable `darkMode: 'class'` di `tailwind.config.js`
- [x] Anti-flash protection script di `<head>` (`guest.blade.php`) — cek localStorage + System preference, set `class="dark"` sebelum render
- [x] Dark mode toggle button (matahari/bulan) di desktop navbar kanan atas dan mobile bottom navbar (sebelum cart)
- [x] Icon cycler: `sun.svg` + `moon.svg` di `Modules/Client/resources/assets/icons/`
- [x] LocalStorage persistence: `localStorage.setItem('theme', isDark ? 'dark' : 'light')`
- [x] **Dual-mode colors** diterapkan di seluruh content area:
  - [x] `guest.blade.php` — navbar (bg + text + border), footer, bottom navbar
  - [x] `home.blade.php` — hero, featured menu, categories, promo, events
  - [x] `menu.blade.php` — header, card menu, category tabs, search
  - [x] `cart/index.blade.php` — cart items, qty controls, total
  - [x] `checkout.blade.php` — form inputs, cart summary
  - [x] `success.blade.php` — success icon, order details card
  - [x] `reservation/create.blade.php` — form, pre-order card
  - [x] `events.blade.php` — header, cards, status badge
- [x] `npm run build` — sukses (80KB CSS + 46KB JS)

---

## 🌗 Bottom Navbar Mobile Dark Mode Fix ✅

- [x] Menghapus `<style>` block `.bn-pill`, `.bn-center-ring`, `.bn-center-glow` (warna hardcode)
- [x] Container pill: `bg-white/80 dark:bg-neutral-900/70 backdrop-blur-md border-neutral-200/40 dark:border-white/[0.06]`
- [x] Icon + label non-aktif: `text-neutral-500 dark:text-neutral-400`
- [x] Center button ring: `border-[6px] border-white dark:border-neutral-950` — mengikuti background halaman
- [x] Center button glow: `shadow-lg shadow-orange-500/50` (orange tetap di kedua mode)
- [x] Cart badge: orange tetap (`bg-orange-500`, `bg-orange-600`)
- [x] Mobile toggle button sudah dual-mode: `bg-white/40 dark:bg-neutral-800/60 border-neutral-200 dark:border-neutral-700`
- [x] `npm run build` sukses (78KB CSS + 46KB JS)

---

## 🏷️ Label "Menu" di Bawah Floating Button (Bottom Navbar) ✅

- [x] Tambah teks label "Menu" di bawah lingkaran oranye floating button — `text-[10px] font-semibold text-orange-500`
- [x] `mt-6` (24px) untuk mendorong teks melewati bagian bawah lingkaran (58px circle, -36px translate → ~22px ke bawah → butuh ~24px gap untuk clear)
- [x] Teks sejajar horizontal dengan label lain (Beranda, Event, Reservasi, Cart) di dalam pill
- [x] Tidak ada overlap: `mt-6` cukup untuk memastikan teks tidak tertutup oleh lingkaran oranye
- [x] Warna oranye konsisten di kedua mode (static orange)
- [x] `npm run build` — sukses (77KB CSS + 46KB JS)

---

## Hero Slider with Banners (Admin-Manageable) ✅

- [x] **php artisan module:make Banner** — buat modul Banner
- [x] **Migration `banners`**: id, title, subtitle (nullable), description (nullable), cta_text (nullable), cta_link (nullable), image (nullable), order (default 0), is_active (default true), timestamps
- [x] **Model Banner**: `$fillable`, `scopeActive()`, `getImageUrlAttribute()`, `getIsActiveLabelAttribute()`, `getStatusBadgeAttribute()`
- [x] **Seeder (3 banners)**: Authentic Japanese Ramen, New Summer Special, Special Combo Deal
- [x] **Admin - BannerController**: CRUD index/create/edit/delete banners
- [x] **Admin - Views**: banners/index.blade.php, create.blade.php, edit.blade.php (AdminLTE table + card layout)
- [x] **Admin - Routes**: `/admin/banners` resource di `Modules/Admin/routes/web.php`
- [x] **Admin - Sidebar**: menu "Hero Banners"
- [x] **Client - Hero slider**: home.blade.php menampilkan banner sebagai full-screen slider (Alpine.js carousel dengan autoplay, navigation arrows, pagination dots, gradient overlays)
- [x] **Client - Fallback**: jika tidak ada banner, tampilkan hero statis (gradient background, heading, CTA buttons, preview menu cards)
- [x] **Alpine.js heroSlider component**: di guest.blade.php — autoplay 5 detik, prev/next/goTo, reset autoplay on manual interaction
- [x] **Migration dijalankan & seed** — sukses
- [x] **`npm run build`** — sukses (79KB CSS + 46KB JS)

---

## 🐛 Fix: Halaman Reservasi Dark Mode Statis ✅

**Root cause:** Ada dua file view reservasi — `create.blade.php` (dengan warna dark mode statis) dan `create.blade` (dengan dual-mode). Laravel memuat `.blade.php`, sehingga dual-mode di file `.blade` tidak pernah terpakai.

**Solusi:**
- [x] Overwrite `create.blade.php` dengan konten dual-mode dari `create.blade`
- [x] Hapus file orphan `create.blade` (tanpa ekstensi) untuk menghindari kebingungan
- [x] Semua elemen kini punya `dark:` variant:
  - Background: `bg-white dark:bg-neutral-950/900`
  - Teks: `text-neutral-900 dark:text-white`, `text-neutral-700 dark:text-neutral-300`
  - Border: `border-neutral-200 dark:border-neutral-800`, `border-neutral-300 dark:border-neutral-700`
  - Form input: `bg-neutral-100 dark:bg-neutral-800`, placeholder `placeholder-neutral-400 dark:placeholder-neutral-500`
  - Error box: `bg-red-50 dark:bg-red-900/30`, `text-red-700 dark:text-red-300`
  - Info box: `bg-orange-50 dark:bg-orange-900/20`, `text-orange-700 dark:text-orange-300`
  - Cart summary items: `bg-neutral-100 dark:bg-neutral-800`, `text-neutral-900 dark:text-white`
  - Cart total: `text-orange-600 dark:text-orange-400`
  - Empty cart: `text-neutral-500 dark:text-neutral-400`
- [x] `npm run build` — sukses (77KB CSS + 46KB JS)
