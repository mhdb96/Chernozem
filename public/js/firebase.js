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
    timeArray = [];
    dataLength = 1;            

    fetchedData.once('value', function(snapshot) {
        snapshot.forEach(function(childSnapshot) {
            value = childSnapshot.val().value;
            time = childSnapshot.val().time;

            if (value != 0 || firebaseCode == 'Movement') {
                if (firebaseCode == 'SoilHumidity' || firebaseCode == 'Gas') {
                    var newValue = ((value*100)/1023).toFixed(2);
                    data.push(newValue);
                } else {
                    data.push(value);                     
                }

                timeArray.push(time); 
                dataLength++;                 
            }          
        });  

        if (timeArray.length > 15) {
            data = data.slice(Math.max(data.length - 15, 1));
            timeArray = timeArray.slice(Math.max(timeArray.length - 15, 1));
        }

        new Chart(chart, {
            type: 'line',
            data: {
                labels: timeArray,
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

function onOffSetters(mac_adress, input) {
    var updates = {};
    updates[`${mac_adress}/Setters/${input.value}`] = getSettersValue(input.checked);
    firebase.database().ref().update(updates);
}

function onOffAutomation(mac_adress, automationInput) {
    var updates = {};    

    $('.setters').each( function( index, setter ) {
        if (setter.value == automationInput.value && automationInput.checked == false) {
            setter.checked = false;                        
            setter.disabled = false;    
            updates[`${mac_adress}/Setters/${automationInput.value}`] = 1;                    
        }
        else if (setter.value == automationInput.value && automationInput.checked == true) {
            setter.checked = false;                        
            setter.disabled = true;          
            updates[`${mac_adress}/Setters/${automationInput.value}`] = 3;              
        }
    });

    firebase.database().ref().update(updates);
}

function getSettersValue(data) {
    if(data == true) 
        return 2;
    else if(data == false) 
        return 1;
}

function getSetters(mac_adress, setters, automaticSetters) {
    fetchedSetters = firebase.database().ref(`${mac_adress}/Setters`);

    fetchedSetters.once('value', function(snapshot) {
        for (var i = 0; i < setters.length; i++) {
            setterValue = snapshot.val()[setters[i].value];
            if(setterValue == 1) {
                setters[i].checked = false;
            }
            else if (setterValue == 2) {
                setters[i].checked = true;
            }
            else {
                setters[i].disabled = true;
                automaticSetters[i].checked = true;                
            }            
        }
    });
}