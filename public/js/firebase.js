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

// Get a reference to the database service
var database = firebase.database();

function drawChart(chart, fetchedData, firebaseCode, label) {
    data = [];
    time = [];
    dataLength = 1;            

    fetchedData.once('value', function(snapshot) {
        snapshot.forEach(function(childSnapshot) {
            value = childSnapshot.val().value;
            if (value != 0 || firebaseCode == 'Movement') {
                data.push(value); 
                dataLength++; 
            }
        });

        for (let i = 1; i <= dataLength; i++) 
            time.push(i*5);  

        new Chart(chart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{ 
                    data: data,
                    label: label,
                    borderColor: "#3e95cd",
                    fill: true
                }]
            }
        });
    });
}