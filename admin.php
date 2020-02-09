<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id']) || $_SESSION['admin'] !=1) {
		header("Location: login.php");
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	
	<style>
		th {
			text-align: center;
		}
		td {
			text-align: center;
		}
		#uplata, #isplata, #dobit {
			font-size: 200%;
			font-weight: bold;
		}
		.well {
			min-height: 250px;
		}
		.col-lg-3 .well, .col-lg-2 .well {
			padding-top: 50px;
		}
	</style>
	
</head>
<body onload="vratiAktivneUtakmice(); statistika();">
	<?php include "navbar.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2">
				<div class="well text-center">
					<h1>Uplata</h1>
					<div id="uplata"></div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="well text-center">
					<h1>Isplata</h1>
					<div id="isplata"></div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="well text-center">
					<div id="piechart"></div>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="well text-center">
					<h1>Dobit</h1>
					<div id="dobit"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>Dostupne utakmice - <small>Unesite rezultate</small></h2>
				<table class="table">
					<thead>
						<th>Tim 1</th>
						<th>Tim 2</th>
						<th>Rezultat</th>

					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	

	<script
	  src="https://code.jquery.com/jquery-3.4.1.js"
	  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	  crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script>
		google.charts.load('current', {'packages':['corechart']});
		function vratiAktivneUtakmice() {
			$.getJSON( "api/vratiAktivneUtakmice", function( data ) {
			$('table tbody').empty();
			  $.each(data, function(key, value){
			  	$('table tbody').append("<tr><td>"+value.tim1+"</td><td>"+value.tim2+"</td><td><select onchange='unesiRezultat("+value.utakmica_id+", this.value)' class='form-control'><option value=''>Izaberi rezultat</option><option value='1'>1</option><option value='2'>2</option><option value='3'>X</option></select></td></tr>");
			  }); 
			 });
		}

		function unesiRezultat(utakmica_id, rezultat) {
			$.getJSON( "api/unesiRezultat/"+utakmica_id+"/"+rezultat, function( data ) {
			 	alert(data.poruka)
			 	vratiAktivneUtakmice();
			 	statistika();
			 });
		}

		function apiPoziv() {
			$.getJSON( "https://freegeoip.app/json", function( data ) {
			 	console.log(data);
			 });
		}

		function statistika() {
			$.getJSON( "api/statistika", function( data ) {
			 	$("#uplata").html(data.uplata+" RSD");
			 	$("#isplata").html(data.isplata+" RSD");
			 	$("#dobit").html(data.dobit+" RSD");
			 	var data = google.visualization.arrayToDataTable([
		          ['Vrsta', 'Vrednost'],
		          ['Uplata',     data.uplata],
		          ['Isplata',      data.isplata]
		        ]);
		        var options = {
		          title: 'Uplata/Isplata'
		        };
		        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        		chart.draw(data, options);

			 });
		}
		
	</script>
</body>
</html>