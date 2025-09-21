# 🔑 Cara Mendapatkan VAPID Key dari Firebase Console

## Langkah-langkah:

1. **Buka Firebase Console**
   - Kunjungi: https://console.firebase.google.com/
   - Pilih project `mutamtour`

2. **Masuk ke Cloud Messaging**
   - Di sidebar kiri, klik "Messaging"
   - Pilih tab "Web configuration"

3. **Generate VAPID Key**
   - Scroll ke bawah ke bagian "Web push certificates"
   - Klik "Generate key pair"
   - **COPY** VAPID key yang dihasilkan

4. **Update File**
   - Ganti `YOUR_VAPID_KEY` di file `resources/views/filament/components/fcm-scripts.blade.php` dengan VAPID key yang benar

## Contoh VAPID Key:
```
BEl62iUYgUivxIkv69yViEuiBIa40HI...
```

## File yang Perlu Diupdate:
- `resources/views/filament/components/fcm-scripts.blade.php` (baris 51)
- `public/test-notification.html` (baris 45)

## Test Setelah Update:
1. Buka `http://localhost/mutamtour/public/test-notification.html`
2. Klik "Request Permission"
3. Klik "Get Token" - seharusnya berhasil mendapatkan token
4. Klik "Test Notification" - seharusnya muncul notifikasi
