# 🔧 Panduan Konfigurasi Firebase Lengkap

Berdasarkan service account key yang Anda miliki, berikut adalah konfigurasi yang diperlukan:

## 📋 Key-Key yang Sudah Diketahui

Dari file `mutamtour-firebase-adminsdk-fbsvc-699ea8e946.json`:

- **Project ID**: `mutamtour`
- **Client ID**: `115440076259309720625`
- **Client Email**: `firebase-adminsdk-fbsvc@mutamtour.iam.gserviceaccount.com`
- **Private Key ID**: `699ea8e9468d9221f53c3c810d7f06aaab8e7ea1`

## 🔑 Key-Key yang Masih Perlu Diambil dari Firebase Console

### 1. **API Key** (Web App Config)
- Buka [Firebase Console](https://console.firebase.google.com/)
- Pilih project `mutamtour`
- Klik ikon gear (Settings) > "Project settings"
- Scroll ke bawah ke bagian "Your apps"
- Jika belum ada web app, klik ikon web (</>) untuk menambahkan
- **COPY** `apiKey` dari konfigurasi yang muncul

### 2. **App ID** (Web App Config)
- Dari halaman yang sama di atas
- **COPY** `appId` dari konfigurasi yang muncul

### 3. **VAPID Key** (Cloud Messaging)
- Di Firebase Console, klik "Messaging" di sidebar
- Pilih tab "Web configuration"
- Klik "Generate key pair" di bagian "Web push certificates"
- **COPY** VAPID key yang dihasilkan

### 4. **Measurement ID** (Google Analytics)
- Di Firebase Console, klik "Analytics" di sidebar
- Klik "Web" untuk menambahkan web app
- **COPY** `measurementId` dari konfigurasi yang muncul

## 📝 Konfigurasi File .env

Tambahkan ke file `.env`:

```env
# Firebase Configuration
FIREBASE_TYPE=service_account
FIREBASE_PROJECT_ID=mutamtour
FIREBASE_PRIVATE_KEY_ID=699ea8e9468d9221f53c3c810d7f06aaab8e7ea1
FIREBASE_PRIVATE_KEY="-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDpbiOGdnfI6WVd\nI4VPMJyQ5bAJ+IMpmggw5dxLW7ahQBAFIFtu/DgtN68SCY+mYISNGYfwFLndZ94i\nLlNeBkPT/IbpArAADq15+HVCyx0XfF3UvRHnNDFjLtaSPVg3AhDH4y0YT4XyrRmJ\nVlDPjtHIZpVh+9AGTQPkqxJHyjVAulo7qitw+iGfN45jRPynIRfxduDEoEfT3wEI\njFIGTYi4uG31OwH8lI7rrSdmxdu4h/E4PRKoPgOODfZFQvQEnUI+r7whmHFCqBgr\nEQQe9cW8JmsfbPSwO+PgYTaTpXU5DDy+n/619/TH5DLNuPUXmvFUsS3Zz6T02LLT\nqIfjkplBAgMBAAECggEAFCSzV1k+AzYDz56e9HtUCWturl+V9vcyLYEKamzYxM+1\nyjF1fm1wrhM77e0qCqAR1Ci/uquZMeZSjIXNnyOggwirviwDks+xb+DtQoUrRqFu\naesiYj6WY/IQ5Vf6lq2ck9kyZSKIoy1FkrzCdrTC/N2AVs8fb4nCFB+gkVYdVA9O\nfj8Qq0RC/1Qx+nvwp/vDMgvI3JHuK/XpL7H4nW/obmv6hlZMufZI2br79EVp2LW5\nALjsizsdJjsAxzYLrOxYB3oHjVhWOXMj5PeEYYoC+4aDvxvp3Gn2ce4EL+HtVpGc\nwZ19SvEfDFUm/GfFUelKwc4+2IX/8LlW3moWGoGoqQKBgQD9W6VVQ9eDV9X49OFD\nLC8yhnDcMuSMpzoRt3qxCngpKbtcC6ClXScSA467HIjazm3L2irb3/1dnDPZfUAR\nN4LH8XFit26DpMzc2gNJX3HEyf4Ef46XOzsThyqhT81yTHk5I3e+XMzH/xdBvIB5\nnBHzW3E0wF7eTKWd/CBCR/h1CQKBgQDr3Utqtxaq0EgRVEwISwFqHs0NzfnH41Bu\nqfuB+AkkRFS23fASRY/AgCBLEGNIVBAH0ndlRQ6SXNU3sxmzJ11CcfPBEGeuGxe+\nSnc2n5uEzOdKGGDTMTC8Khekx3Ig+FWj8Q/vnkoB9WKCzm3qRSi8d+UFEN6WxB3N\nR+LfUWMIeQKBgQD2egr9SVPHXlM2sJzZKYn9AFeZkRVRVHqks7fztjix6vxwDovJ\ndDdHShi4JYlqPHsKX4NkhqNJR2YVxsjmNvfPJi9llwg3n8MBdELQRb87cDrkC2gf\n7iqJ0+yAJE+9S3J/SOb8VfGO+7aXaBggttmrw6D9bcydPTm92YNUmAm5aQKBgQCl\n/pE0InSOdJUztPrpnzf4ooK3o22WEtGpgHHkL1bnsjtYk2uAwHoCBWo0yezFm3vI\ntYOXvvkZYsIgOCjvH9YPjDj7d/sv2htkre2mgL+nv7lLOUrzdxwQYSNQsZkNwRgs\nj9wiTGlTZYoV+wf6JwAbW9nPLecpfg5nSZ9OgW3MKQKBgDLT8tyrxAT0MWZcrN0G\nBHw7Os5l0nGWNMxyj7a0HVnbU6QMIfaNxttk2EoKn341WmwCxCsl1pQB6bQAt+xL\nr9SH+c2BEAGWncDDeQI2L2Utzzqf2eATSaMfwTRikvWllrBu3Fzc52LSRE5ces7K\nXWbIJJj29GkxJLTRpnKSiCno\n-----END PRIVATE KEY-----\n"
FIREBASE_CLIENT_EMAIL=firebase-adminsdk-fbsvc@mutamtour.iam.gserviceaccount.com
FIREBASE_CLIENT_ID=115440076259309720625
FIREBASE_AUTH_URI=https://accounts.google.com/o/oauth2/auth
FIREBASE_TOKEN_URI=https://oauth2.googleapis.com/token
FIREBASE_AUTH_PROVIDER_X509_CERT_URL=https://www.googleapis.com/oauth2/v1/certs
FIREBASE_CLIENT_X509_CERT_URL=https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40mutamtour.iam.gserviceaccount.com

# Key-key yang perlu diambil dari Firebase Console
FIREBASE_API_KEY=YOUR_API_KEY_FROM_FIREBASE_CONSOLE
FIREBASE_MESSAGING_SENDER_ID=115440076259309720625
FIREBASE_APP_ID=YOUR_APP_ID_FROM_FIREBASE_CONSOLE
FIREBASE_VAPID_KEY=YOUR_VAPID_KEY_FROM_FIREBASE_CONSOLE
FIREBASE_MEASUREMENT_ID=YOUR_MEASUREMENT_ID_FROM_FIREBASE_CONSOLE
```

## 🔧 Update File JavaScript

### 1. File `public/js/firebase-messaging-sw.js`
Ganti konfigurasi dengan nilai yang sebenarnya:

```javascript
const firebaseConfig = {
    apiKey: "YOUR_API_KEY_FROM_FIREBASE_CONSOLE",
    authDomain: "mutamtour.firebaseapp.com",
    projectId: "mutamtour",
    storageBucket: "mutamtour.appspot.com",
    messagingSenderId: "115440076259309720625",
    appId: "YOUR_APP_ID_FROM_FIREBASE_CONSOLE",
    measurementId: "YOUR_MEASUREMENT_ID_FROM_FIREBASE_CONSOLE"
};
```

### 2. File `resources/views/filament/components/fcm-scripts.blade.php`
File ini sudah dikonfigurasi untuk membaca dari environment variables, jadi tidak perlu diubah.

## ✅ Langkah Selanjutnya

1. **Ambil key-key yang belum ada** dari Firebase Console sesuai panduan di atas
2. **Update file `.env`** dengan semua key yang diperlukan
3. **Update file `public/js/firebase-messaging-sw.js`** dengan konfigurasi yang benar
4. **Test sistem** dengan menambahkan jamaah baru

## 🧪 Test Konfigurasi

Setelah semua key diisi, test dengan:

1. Buka aplikasi di browser
2. Izinkan notifikasi ketika diminta
3. Tambahkan jamaah baru untuk test notifikasi otomatis
4. Cek console browser untuk error

## ❗ Catatan Penting

- **Jangan commit** file `.env` ke repository
- **Backup** service account key dengan aman
- **Test** di browser yang berbeda untuk memastikan berfungsi

