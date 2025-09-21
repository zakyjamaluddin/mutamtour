// Import Firebase scripts
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js');

// Initialize Firebase
const firebaseConfig = {
    apiKey: "AIzaSyC2wjgVWKXkGB8xFmfaDumyWStL_QIFrGI", 
    authDomain: "mutamtour.firebaseapp.com",
    projectId: "mutamtour",
    storageBucket: "mutamtour.appspot.com",
    messagingSenderId: "1068486202316", 
    appId: "1:1068486202316:web:ab59b6de9f2c5ea6dc0369",
    measurementId: "G-6EZ2QTLCH4" // Ganti dengan Measurement ID dari Firebase Console
};

firebase.initializeApp(firebaseConfig);

// Initialize Firebase Messaging
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage(function(payload) {
    console.log('Received background message ', payload);
    
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/favicon.ico',
        badge: '/favicon.ico',
        data: payload.data
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});

// Handle notification click
self.addEventListener('notificationclick', function(event) {
    console.log('Notification click received.');
    
    event.notification.close();
    
    // Handle click action
    if (event.notification.data && event.notification.data.url) {
        event.waitUntil(
            clients.openWindow(event.notification.data.url)
        );
    }
});
