var firebaseConfig = {
  apiKey: "AIzaSyChBiRb-muGHgmq1-tT4UffmjcjvRk6IUs",
  authDomain: "erba-quest.firebaseapp.com",
  projectId: "erba-quest",
  storageBucket: "erba-quest.appspot.com",
  messagingSenderId: "364135749212",
  appId: "1:364135749212:web:a2885f5a12e0a497b33899",
  measurementId: "G-Y2C4SP9G3W"
};


firebase.initializeApp(firebaseConfig);
firebase.analytics();
const messaging = firebase.messaging();

messaging.getToken({ vapidKey: 'BDzBOuNcaScRhWa2dBfCS_7mQoNaKRs1nx2NpyUu7TE9RXo1unhMygz3IrPI4FpAgEnnFAUxPoFtgv9XRxHuoxo' }).then((currentToken) => {
    if (currentToken) {
            xhr = $.ajax({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: $('meta[name="firebase_ip"]').attr('content'), 
                 type: 'post',
                 data: {'currentToken': currentToken},
                 dataType: 'json',
                 success: function (response) {

                 },
                 error: function (){
                 }
            });
    } else {
        console.log('No registration token available. Request permission to generate one.');
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
});


