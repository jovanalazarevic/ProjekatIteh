<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id'])) {
		header("Location: login.php");
	}
	include "konekcija.php";
	$sql="SELECT u.id as utakmica_id, t1.naziv_tima as tim1, u.kvota1, u.kvota2, u.kvotax, t2.naziv_tima as tim2 FROM utakmica as u JOIN timovi as t1 ON t1.id=u.tim1 JOIN timovi as t2 ON t2.id=u.tim2 WHERE u.rezultat is NULL";
	$q=$mysqli->query($sql);
	$sve_aktivne_utakmice = array();
	while($red=$q->fetch_array()) {
		$sve_aktivne_utakmice[$red['utakmica_id']] = $red;
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
			<div class="col-lg-12">
				<h2>Tiket</h2>
				<button class="btn btn-primary" onclick="otvoriModal();">Uplati</button>
				<table class="table">
					<thead>
						<th>Tim 1</th>
						<th>Tim 2</th>
						<th>Igra</th>
						<th>Kvota</th>
					</thead>
					<tbody>
						<?php 
							if(isset($_SESSION['tiket'])) {
								$ukupna_kvota = 1;
							foreach ($_SESSION['tiket'] as $key => $value) {

								switch ($value) {
									case 1:
										$igra = 1;
										$kvota = $sve_aktivne_utakmice[$key]['kvota1'];
										break;
									case 2:
										$igra = 2;
										$kvota = $sve_aktivne_utakmice[$key]['kvota2'];
										break;
									case 3:
										$igra = 'X';
										$kvota = $sve_aktivne_utakmice[$key]['kvotax'];
										break;
									
									default:
										$igra = 'X';
										$kvota = $sve_aktivne_utakmice[$key]['kvotax'];
										break;
								}
								$ukupna_kvota*=$kvota;
								?>
									<tr>
										<td><?php echo $sve_aktivne_utakmice[$key]['tim1']; ?></td>
										<td><?php echo $sve_aktivne_utakmice[$key]['tim2']; ?></td>
										<td><?php echo $igra; ?></td>
										<td><?php echo $kvota; ?></td>
									</tr>
								<?php
							}
						} else {
							$ukupna_kvota = 0;
								?>
									<tr>
										<td colspan="4">Nema utakmica</td>
									</tr>
								<?php
								}
						 ?>
						
					</tbody>
				</table>
				<p>Ukupna kvota: <?php echo $ukupna_kvota; ?></p>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Uplata</h4>
	      </div>
	      <div class="modal-body">
	        <p>Iznos za uplatu:</p>
	        <input onkeyup="racunaj_dobitak(this.value);" type="text" class="form-control" id="uplata">
	        <br>
	        <p><b>Kvota: </b><?php echo $ukupna_kvota; ?></p>
	        <p><b>Ocekivani dobitak: </b><span id="dobitak">0</span> RSD</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
	        <button type="button" class="btn btn-primary" onclick="uplata();">Uplati</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
		<script
	  src="https://code.jquery.com/jquery-3.4.1.js"
	  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	  crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script>


		var ukupna_kvota = "<?php echo $ukupna_kvota; ?>";

		function racunaj_dobitak(uplata) {
			$("#dobitak").html(uplata*ukupna_kvota);
		}

		function Uplata(uplata) {
			this.uplata = uplata;
		}

		function otvoriModal() {
			$('.modal').modal("show");
		}

		function uplata() {
			var uplata = $("#uplata").val();
			if(uplata.length ==0 || !$.isNumeric(uplata)) {
				alert("Unesti broj!")
			} else {
				var uplata = new Uplata(uplata);
				var json_uplata = JSON.stringify(uplata);
				$.post( "api/dodajUplatu", json_uplata, function( data ) {
				  alert(data.poruka);
				  header("Location: tiket.php");
				});
			}
		}
	</script>
</body>
</html>