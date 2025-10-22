# Aplikasi Peminjaman Ruangan

Aplikasi web untuk mengelola peminjaman ruangan sekolah secara digital, menggantikan sistem manual menggunakan Excel.

## 🎯 Fitur Utama

-   **Peminjam**: Cari ketersediaan ruangan, ajukan peminjaman, cek status, ajukan perubahan password dengan persetujuan admin
-   **Admin**: Kelola pengajuan peminjaman, persetujuan perubahan password, data ruangan, dan pengguna
-   **Kepala Sekolah**: Lihat laporan dan statistik penggunaan ruangan (PDF & Excel)

## 🛠️ Teknologi

-   **Backend**: Laravel 12
-   **Frontend**: Blade Template + Tailwind CSS
-   **Database**: SQLite (development) / MySQL (production)
-   **Email**: EmailJS untuk notifikasi
-   **Export**: Maatwebsite/Excel & DomPDF

## 📋 Prasyarat

Pastikan sistem Anda sudah menginstall:

-   **PHP** >= 8.2
-   **Composer** (untuk dependency management)
-   **SQLite** (sudah include di PHP) atau **MySQL/MariaDB**
-   **Git** (untuk clone repository)
-   **VS Code** (editor yang direkomendasikan)

## 🚀 Cara Install dan Menjalankan di VS Code

### 1. Clone Repository

Buka terminal di VS Code (`Ctrl + ~` atau `View > Terminal`) dan jalankan:

```bash
git clone https://github.com/1oneGod1/AplikasiPeminjamanRuangan.git
cd AplikasiPeminjamanRuangan
```

### 2. Install Dependencies PHP

Install semua package Laravel yang dibutuhkan:

```bash
composer install
```

### 3. Setup Environment

Salin file konfigurasi environment dan generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

**Untuk SQLite (default, lebih mudah untuk development):**

```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD bisa di-comment
```

**Untuk MySQL/MariaDB:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking_ruangan
DB_USERNAME=root
DB_PASSWORD=
```

Jika pakai MySQL, buat database terlebih dahulu:

```bash
mysql -u root -p
CREATE DATABASE booking_ruangan;
EXIT;
```

### 5. Konfigurasi Email (EmailJS)

Untuk fitur notifikasi email, tambahkan konfigurasi EmailJS di `.env`:

```env
EMAILJS_SERVICE_ID=your_service_id
EMAILJS_PUBLIC_KEY=your_public_key
EMAILJS_APPROVED_TEMPLATE_ID=your_approved_template_id
EMAILJS_REJECTED_TEMPLATE_ID=your_rejected_template_id
```

### 6. Jalankan Migrasi Database

Buat semua tabel yang dibutuhkan:

```bash
php artisan migrate
```

### 7. Isi Data Awal (Seeder)

Isi database dengan data contoh (user, ruangan, dll):

```bash
php artisan db:seed
```

### 8. Jalankan Development Server

Jalankan aplikasi Laravel:

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

### 9. (Opsional) Compile Frontend Assets

Jika ada perubahan pada CSS/JS:

```bash
npm install
npm run dev
```

## � Login ke Aplikasi

Setelah seeder dijalankan, Anda bisa login dengan akun berikut:

**Admin**

-   Email: `admin@example.com` atau cek di database
-   Password: sesuai yang di-seed (biasanya `password` atau `Password123!`)

**Kepala Sekolah**

-   Email: cek di database tabel `users` dengan role `kepala_sekolah`
-   Password: sesuai yang di-seed

**Peminjam**

-   Email: cek di database tabel `users` dengan role `peminjam`
-   Password: sesuai yang di-seed

> **Tip**: Buka file `database/seeders/DatabaseSeeder.php` untuk melihat akun yang dibuat oleh seeder.

## 📖 Cara Menggunakan Fitur Lupa Password

1. Buka halaman login
2. Klik link "Lupa kata sandi?"
3. Masukkan **email** dan **kata sandi baru** yang diinginkan
4. Klik "Ajukan Perubahan"
5. Anda akan diarahkan kembali ke halaman login dengan pesan bahwa pengajuan telah dikirim
6. **Admin** akan menerima permintaan dan menyetujui/menolak perubahan password
7. Setelah disetujui admin, password baru akan aktif dan bisa digunakan untuk login

## 📁 Struktur Folder Penting

```
app/
├── Http/
│   ├── Controllers/        # Logic controller untuk routing
│   │   ├── Auth/          # Authentication controllers
│   │   ├── AdminController.php
│   │   ├── AdminPasswordChangeController.php  # Approval password changes
│   │   └── ...
│   ├── Middleware/        # Custom middleware
│   └── Requests/          # Form request validation
├── Models/                # Eloquent models (User, Booking, Room, dll)
├── Services/              # Business logic services
│   ├── BookingService.php
│   ├── NotificationService.php
│   └── EmailJsService.php
├── Exports/               # Excel export classes
└── Notifications/         # Email notification classes
database/
├── migrations/            # Database schema definitions
├── seeders/              # Sample data seeders
└── factories/            # Model factories untuk testing
resources/
├── views/                # Blade templates
│   ├── auth/            # Login, register, password reset
│   ├── admin/           # Admin dashboard dan management
│   ├── headmaster/      # Laporan kepala sekolah
│   └── layouts/         # Layout templates
routes/
├── web.php              # Web routes
└── api.php              # API routes (jika ada)
tests/
├── Feature/             # Feature tests
└── Unit/                # Unit tests
```

## 📚 Dokumentasi Lengkap

Lihat folder `docs/` untuk dokumentasi detail:

-   Models Documentation
-   Middleware Documentation
-   Request Classes Documentation
-   Database Schema (SQL)

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000] [1049] Unknown database"

Buat database terlebih dahulu:

```bash
mysql -u root -p
CREATE DATABASE booking_ruangan;
EXIT;
```

### Error: "no such table: password_change_requests"

Jalankan migrasi database:

```bash
php artisan migrate
```

### Error: "Class 'XXX' not found"

Rebuild autoload dan clear cache:

```bash
composer dump-autoload
php artisan optimize:clear
```

### Port 8000 sudah digunakan

Gunakan port lain:

```bash
php artisan serve --port=8001
```

### Error saat push ke Git: "Updates were rejected"

Jika branch sudah diverged, reset atau buat repo baru:

```bash
# Opsi 1: Force push (hati-hati!)
git push -u origin main --force

# Opsi 2: Pull dulu, lalu push
git pull origin main --rebase
git push origin main
```

### Halaman blank atau error 500

Cek log error Laravel:

```bash
tail -f storage/logs/laravel.log
```

Pastikan permission storage dan cache sudah benar:

```bash
chmod -R 775 storage bootstrap/cache
```

### Email notifikasi tidak terkirim

-   Pastikan konfigurasi EmailJS sudah benar di `.env`
-   Cek log di `storage/logs/laravel.log`
-   Verifikasi service ID dan template ID di EmailJS dashboard

## 🧪 Testing

Jalankan automated tests:

```bash
# Semua tests
php artisan test

# Test spesifik
php artisan test --filter=PasswordResetTest
```

## 👥 Tim Pengembang

-   Andi Pandapotan Purba
-   Refaliano Juan
-   Titi Dwiayu Yasminingrum

## 🌟 Fitur Terbaru

-   ✅ Admin approval untuk perubahan password
-   ✅ Forgot password dengan persetujuan admin
-   ✅ Export laporan ke PDF dan Excel
-   ✅ Notifikasi email via EmailJS
-   ✅ Dashboard interaktif untuk semua role
-   ✅ Validasi konflik booking otomatis

## 📄 Lisensi

Dokumen ini dibuat untuk keperluan akademis - Sekolah Palembang Harapan.

---

**Repository**: https://github.com/1oneGod1/AplikasiPeminjamanRuangan

**Dibuat dengan** ❤️ **menggunakan Laravel 12**
