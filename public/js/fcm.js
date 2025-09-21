// Firebase Configuration
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_PROJECT_ID.appspot.com",
    messagingSenderId: "YOUR_SENDER_ID",
    appId: "YOUR_APP_ID",
    measurementId: "YOUR_MEASUREMENT_ID"
};

// Initialize Firebase
import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js';
import { getMessaging, getToken, onMessage } from 'https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging.js';

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

class FCMService {
    constructor() {
        this.isSupported = 'Notification' in window;
        this.permission = Notification.permission;
    }

    async requestPermission() {
        if (!this.isSupported) {
            console.log('Browser tidak mendukung notifikasi');
            return false;
        }

        if (this.permission === 'granted') {
            return true;
        }

        if (this.permission === 'denied') {
            console.log('Notifikasi diblokir oleh user');
            return false;
        }

        const permission = await Notification.requestPermission();
        this.permission = permission;
        
        return permission === 'granted';
    }

    async getToken() {
        try {
            const token = await getToken(messaging, {
                vapidKey: 'YOUR_VAPID_KEY'
            });
            
            if (token) {
                console.log('FCM Token:', token);
                await this.registerToken(token);
                return token;
            } else {
                console.log('Tidak ada token yang tersedia');
                return null;
            }
        } catch (error) {
            console.error('Error mendapatkan FCM token:', error);
            return null;
        }
    }

    async registerToken(token) {
        try {
            const response = await fetch('/api/fcm/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ token })
            });

            const result = await response.json();
            
            if (result.success) {
                console.log('Token berhasil didaftarkan');
                localStorage.setItem('fcm_token', token);
            } else {
                console.error('Gagal mendaftarkan token:', result.message);
            }
        } catch (error) {
            console.error('Error mendaftarkan token:', error);
        }
    }

    async unregisterToken() {
        const token = localStorage.getItem('fcm_token');
        if (!token) return;

        try {
            const response = await fetch('/api/fcm/unregister', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ token })
            });

            const result = await response.json();
            
            if (result.success) {
                console.log('Token berhasil dihapus');
                localStorage.removeItem('fcm_token');
            } else {
                console.error('Gagal menghapus token:', result.message);
            }
        } catch (error) {
            console.error('Error menghapus token:', error);
        }
    }

    setupMessageListener() {
        onMessage(messaging, (payload) => {
            console.log('Message received:', payload);
            
            // Show notification
            if (payload.notification) {
                this.showNotification(
                    payload.notification.title,
                    payload.notification.body,
                    payload.data
                );
            }
        });
    }

    showNotification(title, body, data = {}) {
        if (this.permission === 'granted') {
            const notification = new Notification(title, {
                body: body,
                icon: '/favicon.ico',
                badge: '/favicon.ico',
                data: data
            });

            notification.onclick = function() {
                window.focus();
                notification.close();
                
                // Handle click action
                if (data.url) {
                    window.location.href = data.url;
                }
            };
        }
    }

    async initialize() {
        const hasPermission = await this.requestPermission();
        
        if (hasPermission) {
            await this.getToken();
            this.setupMessageListener();
            console.log('FCM berhasil diinisialisasi');
        } else {
            console.log('FCM tidak dapat diinisialisasi - tidak ada izin notifikasi');
        }
    }
}

// Initialize FCM when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const fcm = new FCMService();
    fcm.initialize();
});

// Export for global use
window.FCMService = FCMService;


