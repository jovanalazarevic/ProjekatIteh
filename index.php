<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id'])) {
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
	</style>
	
</head>
<body onload="vratiAktivneUtakmice();">
	<?php include "navbar.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>Dostupne utakmice</h2>
				<table class="table">
					<thead>
						<th>Tim 1</th>
						<th>Tim 2</th>
						<th>Kvota 1</th>
						<th>Kvota 2</th>
						<th>Kvota X</th>
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
	<script>
		function vratiAktivneUtakmice() {
			$.getJSON( "api/vratiAktivneUtakmice", function( data ) {
			$('table tbody').empty();
			  $.each(data, function(key, value){
			  	$('table tbody').append("<tr><td>"+value.tim1+"</td><td>"+value.tim2+"</td><td>"+value.kvota1+"<br><button class='btn btn-xs btn-primary' onclick='dodajUtakmicuUTiket("+value.utakmica_id+", 1)'>Dodaj</button></td><td>"+value.kvota2+"<br><button class='btn btn-xs btn-primary' onclick='dodajUtakmicuUTiket("+value.utakmica_id+", 2)'>Dodaj</button></td><td>"+value.kvotax+"<br><button class='btn btn-xs btn-primary' onclick='dodajUtakmicuUTiket("+value.utakmica_id+", 3)'>Dodaj</button></td></tr>");
			  }); 
			 });
		}

		function Utakmica(utakmica_id, kvota) {
			this.utakmica_id = utakmica_id;
			this.kvota = kvota;
		}

		function dodajUtakmicuUTiket(utakmica_id, kvota) {
			var utakmica = new Utakmica(utakmica_id, kvota);
			var json_utakmica = JSON.stringify(utakmica);
			$.post( "api/dodajUtakmicuUTiket", json_utakmica, function( data ) {
			  alert(data.poruka);
			});
		}
	</script>
</body>
</html>