# 🕌 Mutamtour - Sistem Manajemen Jamaah Umroh

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/Filament-3.x-blue.svg" alt="Filament Version">
  <img src="https://img.shields.io/badge/PHP-8.1+-green.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Firebase-FCM-orange.svg" alt="Firebase FCM">
</p>

## 📖 Tentang Aplikasi

**Mutamtour** adalah aplikasi web berbasis Laravel Filament untuk manajemen data jamaah umroh. Aplikasi ini dirancang khusus untuk membantu travel umroh Mutamtour dalam mengelola data jamaah, pembayaran, paket umroh, dan keberangkatan secara online dan real-time.

## ✨ Fitur Utama

### 🎯 **Manajemen Data Jamaah**
- Pencatatan data lengkap jamaah (nama, alamat, kontak, dll.)
- Status vaksin meningitis, polio, dan paspor
- Status pembayaran terintegrasi
- Import data jamaah via Excel

### 📦 **Manajemen Paket Umroh**
- Daftar paket umroh dengan durasi
- Tracking jumlah group dan jamaah per paket
- Detail paket dengan informasi lengkap

### 👥 **Manajemen Group Keberangkatan**
- Pengelompokan jamaah berdasarkan paket
- Tracking sisa seat otomatis
- Informasi tour leader dan vendor
- Tanggal keberangkatan terstruktur

### 🏢 **Manajemen Kantor Cabang**
- Data cabang Mutamtour
- Tracking jamaah per kantor
- Statistik per cabang

### 💰 **Sistem Pembayaran**
- Pencatatan pembayaran jamaah
- Jenis pembayaran (DP, Vaksin, Paspor, dll.)
- Status lunas otomatis
- Laporan keuangan terintegrasi

### 🔔 **Push Notification Real-time**
- Notifikasi otomatis ketika ada jamaah baru
- Informasi sisa seat real-time
- Firebase Cloud Messaging (FCM) integration
- Multi-device support

### 👤 **Sistem User & Role**
- Role-based access control
- Permission management
- User authentication

## 🚀 Teknologi yang Digunakan

- **Backend**: Laravel 11.x
- **Frontend**: Filament 3.x (Admin Panel)
- **Database**: SQLite (development) / MySQL (production)
- **Push Notification**: Firebase Cloud Messaging
- **Authentication**: Laravel Breeze + Filament Shield
- **Import/Export**: Laravel Excel (Maatwebsite)

## 📋 Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- Composer
- Node.js & NPM
- SQLite/MySQL
- Web server (Apache/Nginx)

## 🛠️ Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/your-username/mutamtour.git
cd mutamtour
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### 5. Build Assets
```bash
npm run build
```

### 6. Setup Firebase (untuk Push Notification)
1. Buat project di [Firebase Console](https://console.firebase.google.com/)
2. Aktifkan Cloud Messaging
3. Generate service account key
4. Update konfigurasi di `.env`:
```env
FIREBASE_PROJECT_ID=your-project-id
FIREBASE_PRIVATE_KEY="-----BEGIN PRIVATE KEY-----\n...\n-----END PRIVATE KEY-----\n"
FIREBASE_CLIENT_EMAIL=your-service-account@project.iam.gserviceaccount.com
FIREBASE_VAPID_KEY=your-vapid-key
# ... konfigurasi Firebase lainnya
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000/admin`

## 📱 Konfigurasi Push Notification

### 1. Dapatkan Key Firebase
- API Key dari Web App Config
- Project ID dari Project Settings
- VAPID Key dari Cloud Messaging
- Service Account Key dari Service Accounts

### 2. Update File JavaScript
Edit file `public/js/firebase-messaging-sw.js` dengan konfigurasi Firebase yang benar.

### 3. Test Notifikasi
```bash
# Test via command line
php artisan test:jamaah-notification {jamaah_id}

# Test via browser
http://localhost:8000/test-notification.html
```

## 📊 Struktur Database

### Tabel Utama
- **jamaah** - Data jamaah umroh
- **paket** - Paket umroh yang tersedia
- **groups** - Group keberangkatan
- **kantor** - Cabang Mutamtour
- **pembayaran** - Data pembayaran jamaah
- **notifications** - Notifikasi sistem
- **fcm_tokens** - Token device untuk FCM

## 🔧 Command yang Tersedia

```bash
# Test notifikasi jamaah
php artisan test:jamaah-notification {jamaah_id}

# Jalankan queue worker (untuk notifikasi)
php artisan queue:work

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📁 Struktur Project

```
mutamtour/
├── app/
│   ├── Filament/Resources/     # Filament resources
│   ├── Models/                 # Eloquent models
│   ├── Services/               # Business logic
│   ├── Events/                 # Event classes
│   └── Listeners/              # Event listeners
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── public/
│   ├── js/                     # JavaScript files
│   └── test-*.html             # Test files
├── resources/
│   └── views/filament/         # Blade templates
└── routes/
    └── web.php                 # Web routes
```

## 🎯 Fitur Push Notification

### Notifikasi Otomatis
- **Jamaah Baru**: Ketika ada jamaah baru ditambahkan ke group
- **Sisa Seat**: Menampilkan informasi sisa seat yang tersedia
- **Real-time**: Notifikasi dikirim secara real-time

### Management Notifikasi
- Admin panel untuk kelola notifikasi
- Status read/unread
- Filter dan search
- Bulk actions

## 🔒 Keamanan

- Role-based access control
- CSRF protection
- Input validation
- SQL injection protection
- XSS protection

## 📈 Monitoring & Logging

- Laravel logging system
- Firebase notification logs
- Error tracking
- Performance monitoring

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📞 Support

Untuk pertanyaan atau bantuan, silakan hubungi:
- Email: support@mutamtour.com
- Documentation: [Wiki](https://github.com/your-username/mutamtour/wiki)

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

<p align="center">Dibuat dengan ❤️ untuk Mutamtour</p>
