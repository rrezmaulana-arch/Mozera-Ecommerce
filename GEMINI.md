# 🧠 MEMORI & ATURAN PROYEK ITSFRIDAY (PROJECT MEMORY)

> **Catatan untuk Agen AI (Gemini, Claude, atau akun lainnya):**  
> Berkas ini adalah **Memori Permanen Proyek**. Setiap kali Anda membuka percakapan baru di proyek ini, baca berkas ini terlebih dahulu agar Anda langsung memahami seluruh konteks, aturan, kredensial, dan progres terakhir tanpa perlu bertanya ulang kepada pemilik proyek (User).

---

## 1. Identitas & Karakter Brand
* **Nama Brand**: **ITSFRIDAY** (*"Everyday is Friday"* — `#everydayitsfriday`).
* **Kategori**: Modest Fashion Wanita Indonesia (Outerwear & Kimono, Scarf Voal Ultrafine 120x120, Tiered Midi Dress).
* **Gaya Visual**: Feminin, santun, elegan, *casual-chic*, palet warna *earth-tone* (Krem `#FAF9F6` & `#F5EFEB`, Hitam Netral `#0a0a0a`, Aksen Terakota `#BA805E` / `#A66747`).
* **Dokumen Panduan Utama (PRD)**: `C:\Users\Reza_Moetia\Downloads\PRD-ITSFRIDAY-Panduan-Lengkap.txt`

---

## 2. Standar Teknologi & Larangan Mutlak
* **Framework**: Laravel 11 (PHP 8.2+), Arsitektur Modular (`app/Modules/{Admin,Core,Crm,Shared,Store,Wms}`).
* **Database**: SQLite di `database/database.sqlite`.
* **CSS & Aset Frontend**: **HANYA Tailwind CSS v4** yang dikompilasi via Vite (`@vite(['resources/css/app.css', 'resources/js/app.js'])`).
* ⛔ **LARANGAN KERAS**:
  * DILARANG menggunakan Bootstrap atau framework CSS lain.
  * DILARANG menyuntikkan Tailwind via CDN (`<script src="https://cdn.tailwindcss.com">`). Wajib menggunakan Vite build (`npm run build`).
  * DILARANG menggunakan foto model berpakaian terbuka/crop-top. Gunakan foto model berbusana modest, berhijab, tertutup, atau outer layering rapi.

---

## 3. Matriks Peran Akun & Kredensial Admin (RBAC)
* **URL Login**: `http://127.0.0.1:8000/admin/login` (atau buka `/admin`, otomatis dialihkan ke login).
* **Password Default Semua Akun**: `password123`
* **Tersedia Tombol Quick-Login 1-Klik** di halaman login untuk mempermudah demonstrasi.
* **Pembagian Peran & Hak Akses (Dilindungi Middleware `EnsureRole`)**:
  1. **Owner (`owner@itsfriday.id`)**:
     * Akses penuh ke seluruh sistem + Command Center (Daily Decisions).
  2. **Admin Toko E-commerce (`store@itsfriday.id`)**:
     * Akses terbatas HANYA ke menu Toko (`/admin/store/*`): Produk, Pesanan, Retur, Voucher, Drops.
     * Otomatis diblokir (403 Forbidden) jika membuka Gudang atau CRM.
  3. **Staf Gudang & WMS (`warehouse@itsfriday.id`)**:
     * Akses terbatas HANYA ke WMS (`/admin/wms/*`): Stok Gudang, Inbound, Barcode Picking Scan, Stocktake, Impor Marketplace.
     * Otomatis diblokir jika membuka Toko atau CRM.
  4. **CRM & Marketer (`crm@itsfriday.id`)**:
     * Akses terbatas HANYA ke CRM (`/admin/crm/*`): Customer 360, RFM Segments, Approval Email Flows, Loyalty Points, DSR (UU PDP).
     * Otomatis diblokir jika membuka Toko atau WMS.

---

## 4. Status Progres yang Sudah Selesai (Completed State)
Semua poin di bawah ini telah diuji dan memiliki **16 Automated Tests Lolos 100% (96 Assertions)** via `php artisan test`:

1. **Keamanan Rute (RBAC Route Middleware)**:
   * Middleware `App\Http\Middleware\EnsureRole` terpasang di `routes/admin.php`.
   * Rate limiting `throttle:5,1` aktif di rute login admin.
   * Halaman error kustom mewah: 403 Forbidden, 404 Not Found, 500 Server Error di `resources/views/errors/`.

2. **Kelengkapan CMS Produk**:
   * Rute `admin.store.products.edit` dan `admin.store.products.update` aktif.
   * Controller `AdminProductController@edit` & `update` memungkinkan pengeditan spesifikasi produk, foto, harga SKU, modal HPP, panjang baju Fit Helper, dan status aktif.

3. **Revisi Total Landing Page Storefront (Mobile & Desktop)**:
   * **Hero**: Split layout dengan foto modest fashion tertutup, headline anggun, CTA terakota `#BA805E`, sub-teks 2 baris.
   * **Navbar**: Ringkas 4 menu (Koleksi, Seri, Panduan Ukuran, Bantuan), header sticky 64px bebas lompat, topbar promo 1 baris. Menu staf/retur/tracking dipindahkan ke footer & drawer mobile.
   * **Ukuran Gambar**: Semua gambar kartu memakai rasio aspek eksplisit (`aspect-[4/5]`, `aspect-[3/4]`, `aspect-square`), tinggi maksimal terkontrol, tidak ada gambar raksasa.
   * **Kartu Seri**: 3 kolom di desktop, carousel horizontal scroll-snap (78vw) di mobile.
   * **Kartu Produk**: Grid responsif 4 kolom (desktop), 3 kolom (tablet), 2 kolom (mobile), dilengkapi swatch warna, rating bintang, quick add cart, badge Pre-Order terpisah dari kategori.
   * **Seksi Baru**: *Shop the Look* (set busana diskon 10%), *Fit Concierge* (pilihan tinggi badan 150-166+ cm dengan rekomendasi panjang outer), dan *Belanja per Momen* (Kondangan, Wisuda, Kajian, Hangout).
   * **Komunitas**: Grid 6 foto UGC modest pelanggan (1/1) berukuran proporsional.
   * **Footer**: Bersih dari istilah teknis internal (llms.txt dan teks backend telah dihapus dari tampilan publik).

---

## 5. Cara Menjalankan & Memverifikasi Proyek
* **Menjalankan Server**: `php artisan serve --port=8000`
* **Kompilasi CSS**: `npm run build`
* **Menjalankan Tes**: `php artisan test`
* **Tautan Utama**:
  * Storefront: `http://127.0.0.1:8000`
  * Admin Portal: `http://127.0.0.1:8000/admin`
