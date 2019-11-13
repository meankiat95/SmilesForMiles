<!doctype html>
<html>
<style>
.container {
position: relative;
width: 100%;
padding-top: 0%; /* 1:1 Aspect Ratio */
}

.map-canvas {
position:  absolute;
top: 0;
left: 0;
bottom: 0;
right: 0;
}

/* Full-width input fields */
input[type=text], input[type=password] {
width: 100%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
}

/* Set a style for all buttons */
button {
background-color: #4CAF50;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
cursor: pointer;
width: 100%;
}

button:hover {
opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
width: auto;
padding: 10px 18px;
background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
text-align: center;
margin: 24px 0 12px 0;
position: relative;
}

img.avatar {
width: 10%;
border-radius: 50%;
}

#feedbackcontainer {
padding: 5%;
width: 90%;
}

span.psw {
float: right;
padding-top: 16px;
}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
background-color: #fefefe;
margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
border: 1px solid #888;
width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
position: absolute;
right: 25px;
top: 0;
color: #000;
font-size: 35px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: red;
cursor: pointer;
}

/* Add Zoom Animation */
.animate {
-webkit-animation: animatezoom 0.6s;
animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
from {-webkit-transform: scale(0)} 
to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
from {transform: scale(0)} 
to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
span.psw {
display: block;
float: none;
}
.cancelbtn {
width: 100%;
}
}
</style>
<head>
<title>Google Maps Example</title>
<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.19.0.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  <body>

    <div class="container"> 
      <div id="map-canvas" style="width:100%;height:500px"></div>
      </div>
      <script>
        window.lat = 0;
        window.lng = 0;
        counter = 0;
        var endLat=1.3950;
        var endLng=103.8992;
        var patharr = [];

        function getLocation() {
	        if (navigator.geolocation) {
	        	navigator.geolocation.getCurrentPosition(updatePosition);
	        }

	        return null;
        };

        function updatePosition(position) {
	        if (position) {
		        window.lat = position.coords.latitude;
		        window.lng = position.coords.longitude;
		        var newlat = parseFloat(lat).toFixed(4);
		        var newlng = parseFloat(lng).toFixed(4);
		        counter++;
		        var coor = newlat+newlng ;
		        console.log("Lat: " + newlat + ",Lng: " + newlng + ",Counter: " + counter);
            if (!(patharr.includes(coor))) {
              patharr.push(coor);
            }

            if (newlat == endLat && newlng == endLng) {
              var path = patharr.toString();
              alert("Route Completed!" + path);
            }

	        }
        }

        setInterval(function(){updatePosition(getLocation());}, 5000);

        function currentLocation() {
        	return {lat:window.lat, lng:window.lng};
        };

        var map;
        var mark;

        var initialize = function() {
        	map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:20});
        	mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map});
        };

        window.initialize = initialize;

        var redraw = function(payload) {
	        lat = payload.message.lat;
	        lng = payload.message.lng;

	        map.setCenter({lat:lat, lng:lng, alt:0});
	        mark.setPosition({lat:lat, lng:lng, alt:0});
        };

        var pnChannel = "map2-channel";

        var pubnub = new PubNub({
        	publishKey:   'pub-c-3baabed4-600d-4ef1-a814-7b37f613108c',
        	subscribeKey: 'sub-c-3118ff16-f54c-11e9-9d2a-9abbdb5d0da2'
        });;

        pubnub.subscribe({channels: [pnChannel]});
        pubnub.addListener({message:redraw});

        setInterval(function() {
        pubnub.publish({channel:pnChannel, message:currentLocation()});
      }, 5000);
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBCMM3HSFgOH9c6c46fIaXsJybNY6vCrHU&callback=initialize"></script>

      <center>
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Feedback
        </button>
      </center>
      <center>
        <button onclick="alert('Instagram not installed')" style="width:auto;">Instagram
        </button>
      </center>
      <center>
        <button onclick="alert('Quit')" style="width:auto;">End Route
        </button>
      </center>

      <div id="id01" class="modal">

      <form class="modal-content animate" action="/feedback.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container" id="feedbackcontainer">
          <center><label for="uname"><b>Feedback</b></label></center>
          <input type="text" placeholder="Enter Feedback" name="feedback" required>

          <button type="submit">Submit Feedback</button>
        </div>
      </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
	    if (event.target == modal) {
	    modal.style.display = "none";
	    }
    }
    </script>
  </body>
</html>

var http = new XMLHttpRequest();
var url = 'get_data.php';
var params = 'orem=ipsum&name=binny';
http.open('POST', url, true);

//Send the proper header information along with the request
http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        alert(http.responseText);
    }
}
http.send(params);