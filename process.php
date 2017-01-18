<?php 

include("geocode.php");

// Get address from the GET request
$address = $_GET['address'];

// Geocode the address
$info = geocode($address);

// Show detailed information if address is valid
if (!empty($info)) {
  echo 'Street number: ' . $info['street_number'] . "<br/>";
  echo 'Street name: ' . $info['route'] . "<br/>";
  echo 'City: ' . $info['locality political'] . "<br/>";
  echo 'State: ' . $info['administrative_area_level_1 political'] . "<br/>";
  echo 'Post Code: ' . $info['postal_code'] . "<br/>";
  echo 'Country: ' . $info['country political'] . "<br/>";
  echo 'Latitude: ' . $info['lat'] . "<br/>"; 
  echo 'Longitude: ' . $info['lng'] . "<br/>";    
}

?>

<div id="map"></div>

<script>
  function myMap() {
    var mapCanvas = document.getElementById("map");
    var mapOptions = {
      center: new google.maps.LatLng(<?php echo $info['lat']; ?>, <?php echo $info['lng']; ?>),
      zoom: 14
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(<?php echo $info['lat']; ?>, <?php echo $info['lng']; ?>)
    });
    infowindow = new google.maps.InfoWindow({
      content: "<?php echo $info['formatted_address']; ?>"
    });
    google.maps.event.addListener(marker, "click", function () {
      infowindow.open(map, marker);
    });
    infowindow.open(map, marker);
  }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDc7nYr0sRaq6BR2Ui_R4bR3x53Gaw9Q&callback=myMap" type="text/javascript"></script>