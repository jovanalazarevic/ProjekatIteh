<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id']) || $_SESSION['admin'] !=1) {
		header("Location: login.php");
	}
	include "konekcija.php";
	$sql="SELECT * FROM timovi";
	$q=$mysqli->query($sql);
	if(isset($_POST['submit'])) {
		if(!empty($_POST['tim1']) && !empty($_POST['tim2']) && !empty($_POST['kvota1']) && !empty($_POST['kvota2']) && !empty($_POST['kvotax'])) {
			if($_POST['tim1'] == $_POST['tim2']) {
				$msg = "Tim 1 i Tim 2 ne mogu biti isti!";
			} else {
				$tim1 = $_POST['tim1'];
				$tim2 = $_POST['tim2'];
				$kvota1 = $_POST['kvota1'];
				$kvota2 = $_POST['kvota2'];
				$kvotax = $_POST['kvotax'];

				$tim1 = $mysqli->real_escape_string($tim1);
				$tim2 = $mysqli->real_escape_string($tim2);
				$kvota1 = $mysqli->real_escape_string($kvota1);
				$kvota2 = $mysqli->real_escape_string($kvota2);
				$kvotax = $mysqli->real_escape_string($kvotax);

				$sql2="INSERT INTO utakmica (tim1, tim2, kvota1, kvota2, kvotax) VALUES ('".$tim1."', '".$tim2."', '".$kvota1."', '".$kvota2."', '".$kvotax."')";
				if($q2=$mysqli->query($sql2)) {
					$msg = "Uspesno ste ubacili utakmicu!";
				} else {
					$msg = "Greska!";
				}
			}
			
		} else {
			$msg = "Popunite sva polja!";
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<style>
		form p {
			margin-bottom: 0px;
			margin-top: 5px;
		}
	</style>
	
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
						<p>Prvi tim</p>
						<select name="tim1" id="tim1" class="form-control">
							<option value="">Izaberi tim 1...</option>
							<?php 
								while($red=$q->fetch_object()) {
									?>
										<option value="<?php echo $red->id; ?>"><?php echo $red->naziv_tima; ?></option>
									<?php
								}
							 ?>
						</select>
						<p>Drugi tim</p>
						<select name="tim2" id="tim2" class="form-control">
							<option value="">Izaberi tim 2...</option>
							<?php 
								mysqli_data_seek($q, 0);
								while($red=$q->fetch_object()) {
									?>
										<option value="<?php echo $red->id; ?>"><?php echo $red->naziv_tima; ?></option>
									<?php
								}
							 ?>
						</select>
						<p>Kvota za 1:</p>
						<input type="text" class="form-control" name="kvota1">
						<p>Kvota za 2:</p>
						<input type="text" class="form-control" name="kvota2">
						<p>Kvota za X:</p>
						<input type="text" class="form-control" name="kvotax">
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