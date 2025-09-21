# Konfigurasi Firebase FCM untuk Mutamtour

## Langkah-langkah Setup Firebase

### 1. Buat Project Firebase
1. Buka [Firebase Console](https://console.firebase.google.com/)
2. Klik "Add project" atau "Tambah proyek"
3. Masukkan nama proyek: `mutamtour` (atau nama yang diinginkan)
4. Pilih region yang sesuai
5. Klik "Create project"

### 2. Aktifkan Cloud Messaging
1. Di Firebase Console, pilih project yang baru dibuat
2. Di sidebar kiri, klik "Messaging"
3. Klik "Get started" untuk mengaktifkan Cloud Messaging

### 3. Generate Service Account Key
1. Di Firebase Console, klik ikon gear (Settings) > "Project settings"
2. Pilih tab "Service accounts"
3. Klik "Generate new private key"
4. Download file JSON yang berisi kredensial service account

### 4. Dapatkan Web App Config
1. Di Firebase Console, klik ikon gear (Settings) > "Project settings"
2. Scroll ke bawah ke bagian "Your apps"
3. Klik ikon web (</>) untuk menambahkan web app
4. Masukkan nama app: `mutamtour-web`
5. Centang "Also set up Firebase Hosting" jika diperlukan
6. Klik "Register app"
7. Copy konfigurasi Firebase (firebaseConfig object)

### 5. Generate VAPID Key
1. Di Firebase Console, pilih project
2. Klik "Messaging" di sidebar
3. Pilih tab "Web configuration"
4. Klik "Generate key pair" di bagian "Web push certificates"
5. Copy VAPID key yang dihasilkan

### 6. Konfigurasi Environment Variables

Tambahkan konfigurasi berikut ke file `.env`:

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

### 7. Update File JavaScript

Edit file `public/js/firebase-messaging-sw.js` dan `public/js/fcm.js`:

1. Ganti `YOUR_API_KEY` dengan apiKey dari firebaseConfig
2. Ganti `YOUR_PROJECT_ID` dengan projectId dari firebaseConfig
3. Ganti `YOUR_SENDER_ID` dengan messagingSenderId dari firebaseConfig
4. Ganti `YOUR_APP_ID` dengan appId dari firebaseConfig
5. Ganti `YOUR_MEASUREMENT_ID` dengan measurementId dari firebaseConfig
6. Ganti `YOUR_VAPID_KEY` dengan VAPID key yang dihasilkan

### 8. Jalankan Migration

```bash
php artisan migrate
```

### 9. Test Notifikasi

1. Buka aplikasi di browser
2. Izinkan notifikasi ketika diminta
3. Tambahkan jamaah baru untuk test notifikasi otomatis
4. Atau gunakan API test: `POST /api/fcm/test`

## Fitur yang Tersedia

- ✅ Notifikasi otomatis ketika ada jamaah baru ditambahkan
- ✅ Menampilkan sisa seat dalam notifikasi
- ✅ Management notifikasi di admin panel
- ✅ Support untuk multiple device/browser
- ✅ Background notification support
- ✅ Click action untuk notifikasi

## Troubleshooting

### Notifikasi tidak muncul
1. Pastikan browser mendukung notifikasi
2. Cek permission notifikasi di browser
3. Pastikan service worker terdaftar dengan benar
4. Cek console browser untuk error

### Token tidak terdaftar
1. Pastikan konfigurasi Firebase benar
2. Cek network request ke `/api/fcm/register`
3. Pastikan CSRF token valid

### Service worker error
1. Pastikan file `firebase-messaging-sw.js` ada di `public/js/`
2. Cek konfigurasi Firebase di service worker
3. Pastikan browser support service worker


