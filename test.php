<div id="map" style="height:500px;width:500px;"></div>

    <script>
      function myMap() {
        var mapCanvas = document.getElementById("map");
        var mapOptions = {
          center: new google.maps.LatLng(1, 1),
          zoom: 14
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
          map: map,
          position: new google.maps.LatLng(1, 1)
        });
        infowindow = new google.maps.InfoWindow({
          content: ""
        });
        google.maps.event.addListener(marker, "click", function () {
          infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>