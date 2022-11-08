importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyD1Wt493BiW49sF5vmQ4NJMjvp4RpVWL10",
    authDomain: "choice-app-cc51f.firebaseapp.com",
    projectId: "choice-app-cc51f",
    storageBucket: "choice-app-cc51f.appspot.com",
    messagingSenderId: "999397640871",
    appId: "1:999397640871:web:57551c65ecfe4d675ea982",
    measurementId: "G-NXTK6N3V1Q"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});

