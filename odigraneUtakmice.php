<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id']) || $_SESSION['admin'] !=1) {
		// header("Location: login.php");
	}
	include "konekcija.php";
	$sql="SELECT u.rezultat as rezultat, u.id as utakmica_id, t1.naziv_tima as tim1, u.kvota1, u.kvota2, u.kvotax, t2.naziv_tima as tim2 FROM utakmica as u JOIN timovi as t1 ON t1.id=u.tim1 JOIN timovi as t2 ON t2.id=u.tim2 WHERE u.rezultat is NOT NULL";
	$q=$mysqli->query($sql);
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	
	<style>
		th {
			text-align: center;
		}
		td {
			text-align: center;
		}
	</style>
	
</head>
<body >
	<?php include "navbar.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>Odigrane utakmice</h2>
				<table class="table">
					<thead>
						<th>Tim 1</th>
						<th>Tim 2</th>
						<th>Kvota 1</th>
						<th>Kvota 2</th>
						<th>Kvota X</th>
						<th>Rezultat</th>
					</thead>
					<tbody>
						<?php 
							while($red=$q->fetch_object()) {
								switch ($red->rezultat) {
									case 3:
										$rezultat = "X";
										break;
									
									default:
										$rezultat=$red->rezultat;
										break;
								}
								?>
									<tr>
										<td><?php echo $red->tim1; ?></td>
										<td><?php echo $red->tim2; ?></td>
										<td><?php echo $red->kvota1; ?></td>
										<td><?php echo $red->kvota2; ?></td>
										<td><?php echo $red->kvotax; ?></td>
										<td><?php echo $rezultat; ?></td>
									</tr>
								<?php
							}
						 ?>
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
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		
		$(document).ready( function () {
		    $('table').DataTable();
		} );
	</script>
</body>
</html>