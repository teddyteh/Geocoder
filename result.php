<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Theme Made By www.w3schools.com - No Copyright -->
	<title>Geocoder</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Geocoder</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
				</ul>
			</div>
		</div>
	</nav>

	<!-- First Container -->
	<div class="container-fluid bg-1 text-center">
		<h3 class="margin">Who Am I?</h3>
		<img src="bird.jpg" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
		<h3>I'm an adventurer</h3>
	</div>

	<?php

	include("geocode.php");

	if (!empty($_GET['address'])) {

    // information received from the client
		$address = $_GET['address'];

    // do something with this information
		$info = geocode($address);

    // Show detailed information if address is valid
		echo '<div id="results" class="container-fluid bg-3 text-center">';
		
		if (empty($info)) {
			echo "<p>Please enter a more specific address</p>";
		} else {
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
		<?php


		echo '</div>';

		echo '<div id="results" class="bg-4 text-center">';
		echo '<p><a href=".">Go back</a></p></br>';
		echo '</div>';
	} // Close if (!empty($_GET['address'])) tag
	?>
</body>
<script>
	$(document).ready(function () {
	    // Scroll to the results div
	    $('html, body').animate({
	    	scrollTop: $('#results').offset().top
	    }, 'slow');
	});
</script>