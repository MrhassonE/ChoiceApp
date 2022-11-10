window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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

firebase.initializeApp(firebaseConfig);

// const messaging = firebase.messaging();
//
// function initFirebaseMessagingRegistration() {
//     messaging.requestPermission().then(function () {
//         return messaging.getToken()
//     }).then(function(token) {
//         axios.post("/fcmToken",{
//             _method:"POST",
//             token
//         }).then(({data})=>{
//             console.log(data)
//         }).catch(({response:{data}})=>{
//             console.error(data)
//         })
//
//     }).catch(function (err) {
//         console.log(`Token Error :: ${err}`);
//     });
// }
//
// initFirebaseMessagingRegistration();
//
// messaging.onMessage(function({data:{body,title}}){
//     new Notification(title, {body});
// });
