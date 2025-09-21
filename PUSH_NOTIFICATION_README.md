# Push Notification System - Mutamtour

Sistem notifikasi push telah berhasil diintegrasikan ke aplikasi Mutamtour menggunakan Firebase Cloud Messaging (FCM).

## 🚀 Fitur yang Tersedia

### ✅ Notifikasi Otomatis
- **Jamaah Baru**: Notifikasi otomatis ketika ada jamaah baru ditambahkan ke group
- **Sisa Seat**: Menampilkan informasi sisa seat yang tersedia
- **Real-time**: Notifikasi dikirim secara real-time tanpa perlu refresh halaman

### ✅ Management Notifikasi
- **Admin Panel**: Kelola semua notifikasi di menu "Notifikasi"
- **Status Read/Unread**: Tandai notifikasi sebagai sudah dibaca
- **Filter & Search**: Filter berdasarkan tipe dan status notifikasi
- **Bulk Actions**: Tandai multiple notifikasi sekaligus

### ✅ Multi-Device Support
- **Browser Support**: Bekerja di semua browser modern
- **Background Notifications**: Notifikasi tetap muncul meski tab tidak aktif
- **Click Actions**: Klik notifikasi untuk navigasi langsung

## 📁 File yang Dibuat/Dimodifikasi

### Backend Files
```
app/
├── Events/JamaahAdded.php                    # Event ketika jamaah ditambahkan
├── Listeners/SendJamaahNotification.php      # Listener untuk kirim notifikasi
├── Models/Notification.php                   # Model untuk notifikasi
├── Models/FcmToken.php                       # Model untuk FCM tokens
├── Services/FirebaseService.php              # Service untuk Firebase FCM
├── Http/Controllers/Api/FcmController.php    # API controller untuk FCM
├── Filament/Resources/NotificationResource.php # Filament resource
└── Providers/EventServiceProvider.php        # Event service provider

database/migrations/
├── 2025_09_18_083027_create_notifications_table.php
└── 2025_09_18_083034_create_fcm_tokens_table.php

config/
└── firebase.php                              # Konfigurasi Firebase
```

### Frontend Files
```
public/js/
├── firebase-messaging-sw.js                  # Service worker untuk background
└── fcm.js                                    # JavaScript untuk FCM

resources/views/filament/components/
├── fcm-scripts.blade.php                     # Script FCM untuk Filament
└── notification-bell.blade.php               # Komponen bell notifikasi
```

### Documentation
```
FIREBASE_SETUP.md                             # Panduan setup Firebase
PUSH_NOTIFICATION_README.md                   # Dokumentasi lengkap
```

## 🔧 Konfigurasi yang Diperlukan

### 1. Environment Variables
Tambahkan ke file `.env`:

```env
# Firebase Configuration
FIREBASE_TYPE=service_account
FIREBASE_PROJECT_ID=your-project-id
FIREBASE_PRIVATE_KEY_ID=your-private-key-id
FIREBASE_PRIVATE_KEY="-----BEGIN PRIVATE KEY-----\nyour-private-key\n-----END PRIVATE KEY-----\n"
FIREBASE_CLIENT_EMAIL=your-service-account@your-project-id.iam.gserviceaccount.com
FIREBASE_CLIENT_ID=your-client-id
FIREBASE_AUTH_URI=https://accounts.google.com/o/oauth2/auth
FIREBASE_TOKEN_URI=https://oauth2.googleapis.com/token
FIREBASE_AUTH_PROVIDER_X509_CERT_URL=https://www.googleapis.com/oauth2/v1/certs
FIREBASE_CLIENT_X509_CERT_URL=https://www.googleapis.com/robot/v1/metadata/x509/your-service-account%40your-project-id.iam.gserviceaccount.com
FIREBASE_VAPID_KEY=your-vapid-key
FIREBASE_MESSAGING_SENDER_ID=your-sender-id
FIREBASE_APP_ID=your-app-id
FIREBASE_MEASUREMENT_ID=your-measurement-id
```

### 2. Update JavaScript Files
Edit file `public/js/firebase-messaging-sw.js` dan `resources/views/filament/components/fcm-scripts.blade.php`:

- Ganti `YOUR_API_KEY` dengan API key dari Firebase
- Ganti `YOUR_PROJECT_ID` dengan Project ID dari Firebase
- Ganti `YOUR_SENDER_ID` dengan Sender ID dari Firebase
- Ganti `YOUR_APP_ID` dengan App ID dari Firebase
- Ganti `YOUR_VAPID_KEY` dengan VAPID key dari Firebase

## 🚀 Cara Menggunakan

### 1. Setup Firebase
1. Ikuti panduan di `FIREBASE_SETUP.md`
2. Dapatkan kredensial Firebase
3. Update environment variables
4. Update konfigurasi JavaScript

### 2. Jalankan Migration
```bash
php artisan migrate
```

### 3. Seed Data Notifikasi
```bash
php artisan db:seed --class=NotificationSeeder
```

### 4. Test Notifikasi
1. Buka aplikasi di browser
2. Izinkan notifikasi ketika diminta
3. Tambahkan jamaah baru untuk test notifikasi otomatis
4. Atau gunakan API test: `POST /api/fcm/test`

## 📱 API Endpoints

### Register FCM Token
```
POST /api/fcm/register
Content-Type: application/json

{
    "token": "fcm-token-here"
}
```

### Unregister FCM Token
```
POST /api/fcm/unregister
Content-Type: application/json

{
    "token": "fcm-token-here"
}
```

### Send Test Notification
```
POST /api/fcm/test
Content-Type: application/json

{
    "title": "Test Notification",
    "body": "This is a test notification"
}
```

## 🔄 Flow Notifikasi

1. **Jamaah Ditambahkan**: User menambahkan jamaah baru melalui Filament
2. **Event Triggered**: Event `JamaahAdded` dipicu otomatis
3. **Listener Executed**: `SendJamaahNotification` listener dijalankan
4. **FCM Service**: `FirebaseService` mengirim notifikasi ke semua device
5. **Database Save**: Notifikasi disimpan ke database
6. **Browser Receive**: Browser menerima notifikasi dan menampilkannya

## 🛠️ Troubleshooting

### Notifikasi tidak muncul
1. ✅ Pastikan browser mendukung notifikasi
2. ✅ Cek permission notifikasi di browser
3. ✅ Pastikan konfigurasi Firebase benar
4. ✅ Cek console browser untuk error

### Token tidak terdaftar
1. ✅ Pastikan konfigurasi Firebase benar
2. ✅ Cek network request ke `/api/fcm/register`
3. ✅ Pastikan CSRF token valid

### Service worker error
1. ✅ Pastikan file `firebase-messaging-sw.js` ada di `public/js/`
2. ✅ Cek konfigurasi Firebase di service worker
3. ✅ Pastikan browser support service worker

## 📊 Database Schema

### Tabel `notifications`
```sql
- id (bigint, primary key)
- title (varchar)
- body (text)
- type (varchar, default: 'info')
- data (json, nullable)
- is_read (boolean, default: false)
- read_at (timestamp, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Tabel `fcm_tokens`
```sql
- id (bigint, primary key)
- token (varchar, unique)
- user_agent (varchar, nullable)
- ip_address (varchar, nullable)
- last_used_at (timestamp, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

## 🎯 Key Firebase yang Diperlukan

Untuk mengaktifkan sistem notifikasi, Anda perlu memberikan key-key berikut dari Firebase Console:

1. **API Key** - Dari Web App Config
2. **Project ID** - Dari Project Settings
3. **Messaging Sender ID** - Dari Project Settings
4. **App ID** - Dari Web App Config
5. **VAPID Key** - Dari Cloud Messaging settings
6. **Service Account Key** - Download dari Service Accounts

Semua key ini harus diisi di file `.env` dan konfigurasi JavaScript sesuai dengan format yang telah disediakan.

## ✨ Keunggulan Sistem

- **Real-time**: Notifikasi langsung tanpa delay
- **Scalable**: Mendukung multiple device dan user
- **Reliable**: Menggunakan Firebase FCM yang terpercaya
- **User-friendly**: Interface yang mudah digunakan
- **Maintainable**: Code yang terstruktur dan mudah dipelihara


