# 🔑 Key-Key Firebase yang Diperlukan

Untuk mengaktifkan sistem push notification, Anda perlu memberikan key-key berikut dari Firebase Console:

## 📋 Daftar Key yang Diperlukan

### 1. **API Key**
- **Lokasi**: Firebase Console > Project Settings > General > Web apps
- **Format**: String panjang (contoh: `AIzaSyB...`)
- **Digunakan di**: `public/js/firebase-messaging-sw.js` dan `resources/views/filament/components/fcm-scripts.blade.php`

### 2. **Project ID**
- **Lokasi**: Firebase Console > Project Settings > General
- **Format**: String (contoh: `mutamtour-12345`)
- **Digunakan di**: File `.env` dan konfigurasi JavaScript

### 3. **Messaging Sender ID**
- **Lokasi**: Firebase Console > Project Settings > Cloud Messaging
- **Format**: Angka (contoh: `123456789012`)
- **Digunakan di**: File `.env` dan konfigurasi JavaScript

### 4. **App ID**
- **Lokasi**: Firebase Console > Project Settings > General > Web apps
- **Format**: String (contoh: `1:123456789012:web:abcdef123456`)
- **Digunakan di**: File `.env` dan konfigurasi JavaScript

### 5. **VAPID Key**
- **Lokasi**: Firebase Console > Project Settings > Cloud Messaging > Web configuration
- **Format**: String panjang (contoh: `BEl62iUYgUivxIkv69yViEuiBIa40HI...`)
- **Digunakan di**: File `.env` dan konfigurasi JavaScript

### 6. **Service Account Key** (untuk backend)
- **Lokasi**: Firebase Console > Project Settings > Service Accounts
- **Format**: JSON file yang didownload
- **Digunakan di**: File `.env` (dikonversi ke environment variables)

## 🔧 Cara Mendapatkan Key-Key Tersebut

### Langkah 1: Buat Project Firebase
1. Buka [Firebase Console](https://console.firebase.google.com/)
2. Klik "Add project" atau "Tambah proyek"
3. Masukkan nama proyek: `mutamtour`
4. Pilih region yang sesuai
5. Klik "Create project"

### Langkah 2: Aktifkan Cloud Messaging
1. Di Firebase Console, pilih project yang baru dibuat
2. Di sidebar kiri, klik "Messaging"
3. Klik "Get started" untuk mengaktifkan Cloud Messaging

### Langkah 3: Dapatkan Web App Config
1. Di Firebase Console, klik ikon gear (Settings) > "Project settings"
2. Scroll ke bawah ke bagian "Your apps"
3. Klik ikon web (</>) untuk menambahkan web app
4. Masukkan nama app: `mutamtour-web`
5. Klik "Register app"
6. **COPY** konfigurasi Firebase yang muncul (firebaseConfig object)

### Langkah 4: Generate VAPID Key
1. Di Firebase Console, pilih project
2. Klik "Messaging" di sidebar
3. Pilih tab "Web configuration"
4. Klik "Generate key pair" di bagian "Web push certificates"
5. **COPY** VAPID key yang dihasilkan

### Langkah 5: Download Service Account Key
1. Di Firebase Console, klik ikon gear (Settings) > "Project settings"
2. Pilih tab "Service accounts"
3. Klik "Generate new private key"
4. **DOWNLOAD** file JSON yang berisi kredensial service account

## 📝 Template Konfigurasi

### File `.env`
```env
# Firebase Configuration
FIREBASE_TYPE=service_account
FIREBASE_PROJECT_ID=your-project-id-here
FIREBASE_PRIVATE_KEY_ID=your-private-key-id-here
FIREBASE_PRIVATE_KEY="-----BEGIN PRIVATE KEY-----\nyour-private-key-here\n-----END PRIVATE KEY-----\n"
FIREBASE_CLIENT_EMAIL=your-service-account@your-project-id.iam.gserviceaccount.com
FIREBASE_CLIENT_ID=your-client-id-here
FIREBASE_AUTH_URI=https://accounts.google.com/o/oauth2/auth
FIREBASE_TOKEN_URI=https://oauth2.googleapis.com/token
FIREBASE_AUTH_PROVIDER_X509_CERT_URL=https://www.googleapis.com/oauth2/v1/certs
FIREBASE_CLIENT_X509_CERT_URL=https://www.googleapis.com/robot/v1/metadata/x509/your-service-account%40your-project-id.iam.gserviceaccount.com
FIREBASE_VAPID_KEY=your-vapid-key-here
FIREBASE_MESSAGING_SENDER_ID=your-sender-id-here
FIREBASE_APP_ID=your-app-id-here
FIREBASE_MEASUREMENT_ID=your-measurement-id-here
```

### File `public/js/firebase-messaging-sw.js`
```javascript
const firebaseConfig = {
    apiKey: "YOUR_API_KEY_HERE",
    authDomain: "YOUR_PROJECT_ID_HERE.firebaseapp.com",
    projectId: "YOUR_PROJECT_ID_HERE",
    storageBucket: "YOUR_PROJECT_ID_HERE.appspot.com",
    messagingSenderId: "YOUR_SENDER_ID_HERE",
    appId: "YOUR_APP_ID_HERE",
    measurementId: "YOUR_MEASUREMENT_ID_HERE"
};
```

### File `resources/views/filament/components/fcm-scripts.blade.php`
```javascript
const firebaseConfig = {
    apiKey: "{{ config('firebase.service_account.apiKey', 'YOUR_API_KEY_HERE') }}",
    authDomain: "{{ config('firebase.service_account.project_id', 'YOUR_PROJECT_ID_HERE') }}.firebaseapp.com",
    projectId: "{{ config('firebase.service_account.project_id', 'YOUR_PROJECT_ID_HERE') }}",
    storageBucket: "{{ config('firebase.service_account.project_id', 'YOUR_PROJECT_ID_HERE') }}.appspot.com",
    messagingSenderId: "{{ config('firebase.messaging_sender_id', 'YOUR_SENDER_ID_HERE') }}",
    appId: "{{ config('firebase.app_id', 'YOUR_APP_ID_HERE') }}",
    measurementId: "{{ config('firebase.measurement_id', 'YOUR_MEASUREMENT_ID_HERE') }}"
};
```

## ⚠️ Catatan Penting

1. **Ganti semua placeholder** dengan nilai yang sebenarnya dari Firebase Console
2. **Jangan commit** file `.env` ke repository (sudah ada di `.gitignore`)
3. **Backup** service account key dengan aman
4. **Test** konfigurasi setelah selesai setup

## 🧪 Cara Test

1. Buka aplikasi di browser
2. Izinkan notifikasi ketika diminta
3. Tambahkan jamaah baru untuk test notifikasi otomatis
4. Atau gunakan API test: `POST /api/fcm/test`

## 📞 Bantuan

Jika mengalami kesulitan, periksa:
- Console browser untuk error JavaScript
- Log Laravel untuk error backend
- Network tab untuk request yang gagal
- Firebase Console untuk status project


