<!DOCTYPE html>
<html>


  <head>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>

    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      
      body {background-color: gray;}
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Set proportions of html*/
      html, body {
        height: 70%;
        width: 80%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>


  <body>
    <div id="map"></div>
    
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.


      var longitude;
      var latitude;
      
      function mapTutor(insertLong, insertLat,tutorName) {
        var newWindow = new google.maps.InfoWindow;
        var newguy = {
              lat:insertLat,
              lng:insertLong
        };
        
            newWindow.setPosition(newguy);
            newWindow.setContent(tutorName);
            newWindow.open(map);
        
        
      }


      var map, infoWindow, otherWindow;
      
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {

          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            

              longitude = pos.lng;
              latitude = pos.lat;



              console.log("longitudeGeocoded: " + longitude);
              console.log("latitudeGeocoded: " + latitude);

              // var user_lat = latitude;


               $.ajax({
                  url: "external.php",
                  method: "POST",
                  data: { "longitude": longitude, "latitude": latitude },
                  success: function (data) {
                    console.log(data);
                    }
              });




            infoWindow.setPosition(pos);
            infoWindow.setContent('You are here');
            infoWindow.open(map);
            
            
            mapTutor(-79.0533723-1,35.9102378-1,'tutor1');
             mapTutor(-79.0533723-2,35.9102378-2,'tutor2');
            
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }




      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }


    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6aQaHYbG5Bzu3lFUQMw3V-jeOEuyvP2U&callback=initMap">
    </script>
    
    
<?php

$con=mysqli_connect('classroom.cs.unc.edu','sgamage','finalproject','sgamagedb');


$sql="SELECT * FROM Users WHERE Privileges=1";
$result= $con->query($sql);
while($row = $result->fetch_assoc()) {
        //echo "Tutor: " . $row["Full_Name"] . "<br>";    
        echo "<p id='account".$row["UserID"]."'>Message Tutor: " . $row["Full_Name"] . "</p>";
        
        
        }


?>

  </body>
</html>













