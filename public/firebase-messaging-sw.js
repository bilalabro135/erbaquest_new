importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
  apiKey: "AIzaSyChBiRb-muGHgmq1-tT4UffmjcjvRk6IUs",
  authDomain: "erba-quest.firebaseapp.com",
  databaseURL: 'https://project-id.firebaseio.com',
  projectId: "erba-quest",
  storageBucket: "erba-quest.appspot.com",
  messagingSenderId: "364135749212",
  appId: "1:364135749212:web:a2885f5a12e0a497b33899",
  measurementId: "G-Y2C4SP9G3W"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

/*messaging.onBackgroundMessage((payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    //icon: '/firebase-logo.png'
  };

  self.registration.showNotification(notificationTitle,
      notificationOptions);
});*/

self.addEventListener('push', function (event) {
  var data = event.data.json().data;

  const title = data.title;
  //data.Data.actions = data.Actions;
  const options = {
    body: data.body,
    icon: data.icon,
    image: data.image,
    data:data.action
  };
  event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', function (event) {
  console.log(event.notification);
  //var data = event.data.json().data;
  event.notification.close();
  event.waitUntil(
      clients.openWindow(event.notification.data)
  );
});

self.addEventListener('notificationclose', function (event) {});