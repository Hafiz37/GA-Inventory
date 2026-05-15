# 📦 GA Inventory — Sistem Manajemen Inventaris Aset

Aplikasi web manajemen inventaris aset berbasis **Laravel 13** untuk kebutuhan General Affairs (GA). Dibangun untuk mempermudah pencatatan, pencarian, dan pengelolaan barang/aset kantor secara efisien.

🌐 **Live Demo:** [https://ga-inventory.rf.gd](https://ga-inventory.rf.gd)

---

## ✨ Fitur Utama

- **Manajemen Aset** — Tambah, edit, dan hapus data aset dengan mudah
- **Kategori Aset** — Pengelompokan aset berdasarkan kategori (Alat Jaringan, Laptop & PC, Alat Teknik, dll.)
- **Filter & Pencarian** — Cari aset berdasarkan nama / serial number, dan filter berdasarkan kategori
- **Alert Stok Menipis** — Notifikasi otomatis ketika stok aset ≤ 5 unit
- **Status Aset** — Lacak status barang: `Tersedia`, `Dipakai`, atau `Rusak`
- **REST API** — Endpoint JSON untuk mengakses data aset (`/api/assets`)
- **Konfirmasi Hapus** — Dialog konfirmasi berbasis SweetAlert2 sebelum menghapus data

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi | Keterangan |
|-----------|-------|------------|
| PHP | ^8.3 | Bahasa pemrograman utama |
| Laravel | ^13.7 | Framework backend |
| Laravel Sanctum | ^4.0 | Autentikasi API |
| SQLite | — | Database default |
| Bootstrap | 5.3 | UI framework (via CDN) |
| Font Awesome | 6.4 | Ikon (via CDN) |
| SweetAlert2 | 11 | Dialog konfirmasi (via CDN) |
| Tailwind CSS | ^4.0 | Utility CSS (build tool) |
| Vite | ^8.0 | Asset bundler |

---

## 🗂️ Struktur Database

### Tabel `categories`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | string | Nama kategori |
| type | string (nullable) | Tipe kategori |
| description | text (nullable) | Deskripsi kategori |
| timestamps | — | created_at, updated_at |

### Tabel `assets`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| category_id | foreignId | Relasi ke tabel categories |
| name | string | Nama aset |
| brand | string (nullable) | Merk/brand |
| serial_number | string (nullable, unique) | Nomor seri |
| status | enum | `Tersedia`, `Dipakai`, `Rusak` |
| held_by | string (nullable) | Pemegang/lokasi aset |
| stock | integer | Jumlah stok |
| notes | text (nullable) | Catatan tambahan |
| timestamps | — | created_at, updated_at |

---

## 🚀 Instalasi Lokal

### Prasyarat
- PHP >= 8.3
- Composer
- Node.js & NPM

### Langkah-langkah

```bash
# 1. Clone repositori
git clone https://github.com/username/ga-inventory.git
cd ga-inventory

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Jalankan migrasi dan seeder
php artisan migrate --seed

# 6. Install dependensi Node.js dan build asset
npm install
npm run build

# 7. Jalankan server lokal
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

> **Catatan:** Aplikasi menggunakan SQLite secara default. Pastikan file `database/database.sqlite` sudah ada, atau buat dengan perintah `touch database/database.sqlite` sebelum menjalankan migrasi.

---

## 🔌 API Endpoint

Base URL: `https://ga-inventory.rf.gd/api`

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/assets` | Mengambil semua data aset |

### Contoh Response
```json
{
  "data": [
    {
      "id": 1,
      "nama_barang": "Router MikroTik RB4011",
      "kategori": "Alat Jaringan",
      "merk": "MikroTik",
      "stok": 3,
      "status": "Tersedia",
      "dibuat_pada": "10-05-2026"
    }
  ]
}
```

---

## 📁 Struktur Direktori Penting

```
ga-inventory/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AssetController.php        # CRUD aset (web)
│   │   │   └── Api/AssetApiController.php # API endpoint
│   │   └── Resources/
│   │       └── AssetResource.php          # Transformasi response API
│   └── Models/
│       ├── Asset.php                      # Model aset + scope lowStock
│       └── Category.php                   # Model kategori
├── database/
│   ├── migrations/                        # Skema database
│   └── seeders/                           # Data awal (kategori & aset)
├── resources/views/
│   ├── layouts/app.blade.php              # Layout utama + sidebar
│   └── assets/                            # Halaman CRUD aset
└── routes/
    ├── web.php                            # Rute web
    └── api.php                            # Rute API
```

---

## 🌱 Data Awal (Seeder)

Seeder bawaan menyediakan:

**Kategori:**
- Alat Jaringan (Elektronik)
- Laptop & PC (Elektronik)
- Alat Teknik (Perkakas)

**Aset Contoh:**
- Router MikroTik RB4011
- Macbook Pro M2

Jalankan ulang seeder dengan:
```bash
php artisan migrate:fresh --seed
```

---

## 📄 Lisensi

Proyek ini dibuat untuk kebutuhan internal General Affairs. Silakan digunakan dan dikembangkan sesuai kebutuhan.

---

> Dibuat dengan ❤️ menggunakan [Laravel](https://laravel.com)
