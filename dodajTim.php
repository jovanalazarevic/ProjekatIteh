<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id']) || $_SESSION['admin'] !=1) {
		header("Location: login.php");
	}
	include "konekcija.php";
	if(isset($_POST['submit'])) {
		if(!empty($_POST['naziv'])) {
			$naziv = $_POST['naziv'];
			$naziv = $mysqli->real_escape_string($naziv);
			$sql="INSERT INTO timovi (naziv_tima) VALUES ('".$naziv."')";
			if($q=$mysqli->query($sql)) {
				$msg = "Uspesno ubacen tim!";
			} else {
				$msg = "Greska, tim nije ubacen!";
			}
		} else {
			$msg = "Popunite sva  postojeca polja!";
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	
	
</head>
<body>
	<?php include "navbar.php"; ?>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="well">
					<h1 class="text-center">Login</h1>
					<form action="" method="POST">
						<?php if(!empty($msg)) echo $msg; ?>
						<p>Naziv:</p>
						<input type="text" class="form-control" name="naziv">
						<br>
						<input type="submit" name="submit" class="btn btn-primary btn-block" value="Dodaj">
					</form>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>