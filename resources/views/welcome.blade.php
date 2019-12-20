<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>

        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
        {{-- <script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-analytics.js"></script> --}}

        <script>
            // Your web app's Firebase configuration
            var firebaseConfig = {
                apiKey: "AIzaSyBepTpXlfPbYV0LO9QjvLTjkE1nOMOuhp4",
                authDomain: "nodemcu-test-2161a.firebaseapp.com",
                databaseURL: "https://nodemcu-test-2161a.firebaseio.com",
                projectId: "nodemcu-test-2161a",
                storageBucket: "nodemcu-test-2161a.appspot.com",
                messagingSenderId: "547962417950",
                appId: "1:547962417950:web:db8c6d07ce6b0e20db8f0f",
                measurementId: "G-X8CC3EGR4F"
            };
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);
            // firebase.analytics();

            // Get a reference to the database service
            var database = firebase.database();

            // var starCountRef = firebase.database().ref('data');
            // starCountRef.on('value', function(snapshot) {
            //     console.log(snapshot.val());
            //     // updateStarCount(postElement, snapshot.val());
            // });

            // Get a key for a new Post.
            var newPostKey = firebase.database().ref().child('setters').push().key;

            // Write the new post's data simultaneously in the posts list and the user's post list.
            var updates = {};
            updates['/setters/status'] = 1;

            firebase.database().ref().update(updates);

            firebase.database().ref().child('data').remove();
        </script>

    </body>
</html>
