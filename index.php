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
		<img src="bird.jpg" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="150" height="150">
		<h3>I'm an adventurer</h3>
	</div>

	<!-- Second Container -->
	<div class="container-fluid bg-2 text-center">
		<form>
			<div class="form-group">
				<label for="address">Address:</label>
				<input id="address" class="form-control" type="text" placeholder="Enter an address eg 124 La Trobe St, Melbourne VIC 3000">
			</div>
		</form>

		<a id="submit" class="btn btn-default btn-lg">
			<span class="glyphicon glyphicon-search" ></span> Geocode
		</a>

	</div>

	<!-- Third Container (Grid) -->
	<div id="results" class="container-fluid bg-3 text-center"></div>

	<script type="text/javascript">
		$('#results').hide();

		$('#submit').click(function(e) {
			e.preventDefault();

			if ($('#address').val() != "") {			
				var value = $('#address').val();

				$.ajax({
					type: "GET",
					url: 'process.php',
					data: {address: value},
					success: function (data) {
						$("#results").html(data);
						$('#results').show();
						$('html, body').animate({
							scrollTop: $('#results').offset().top
						}, 'slow');
					}
				});
			}
		});
	</script>

	<!-- Footer -->
	<footer class="container-fluid bg-4 text-center">
		<p>Geocoder by Teddy</p>
	</footer>

</body>
</html>

