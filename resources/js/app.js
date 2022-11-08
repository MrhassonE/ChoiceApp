import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";

const firebaseConfig = {
    apiKey: "AIzaSyD1Wt493BiW49sF5vmQ4NJMjvp4RpVWL10",
    authDomain: "choice-app-cc51f.firebaseapp.com",
    projectId: "choice-app-cc51f",
    storageBucket: "choice-app-cc51f.appspot.com",
    messagingSenderId: "999397640871",
    appId: "1:999397640871:web:57551c65ecfe4d675ea982",
    measurementId: "G-NXTK6N3V1Q"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);



// import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";

// const firebaseConfig = {
//     apiKey: "AIzaSyDuJpiuFYbC_f1_9VkiA5ZDRy61C7HVdNU",
//     authDomain: "choiceapp-8e83d.firebaseapp.com",
//     projectId: "choiceapp-8e83d",
//     storageBucket: "choiceapp-8e83d.appspot.com",
//     messagingSenderId: "273457438729",
//     appId: "1:273457438729:web:4bdc9ed1552dc21e8658d8",
//     measurementId: "G-1EN5BX387Q"
// };
//
// // Initialize Firebase
// const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
