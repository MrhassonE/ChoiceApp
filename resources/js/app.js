import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyD1Wt493BiW49sF5vmQ4NJMjvp4RpVWL10",
    authDomain: "choice-app-cc51f.firebaseapp.com",
    projectId: "choice-app-cc51f",
    storageBucket: "choice-app-cc51f.appspot.com",
    messagingSenderId: "999397640871",
    appId: "1:999397640871:web:57551c65ecfe4d675ea982",
    measurementId: "G-NXTK6N3V1Q"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
