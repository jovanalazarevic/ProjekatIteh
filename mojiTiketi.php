<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id'])) {
		header("Location: login.php");
	}
	include "konekcija.php";
	$userid=$_SESSION['korisnik_id'];
	$sql="SELECT * FROM tiket WHERE user_id='$userid' ORDER BY id desc";
	$q=$mysqli->query($sql);
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
				<h2>Moji tiketi</h2>
				<?php 
					while($red=$q->fetch_object()) {
						$sql2="SELECT tl.kvota as igra, u.rezultat as rezultat, u.id as utakmica_id, t1.naziv_tima as tim1, u.kvota1, u.kvota2, u.kvotax, t2.naziv_tima as tim2 FROM utakmica as u JOIN timovi as t1 ON t1.id=u.tim1 JOIN timovi as t2 ON t2.id=u.tim2 JOIN tiket_list as tl ON tl.utakmica_id = u.id  WHERE tl.tiket_id='$red->id'";
						$q2=$mysqli->query($sql2);
						?>
							<div class="well">
								<div class="row">
									<div class="col-lg-6">
										<h3 class="text-center">Utakmice</h3>
										<table class="table">
											<thead>
												<th>Tim 1</th>
												<th>Tim 2</th>
												<th>Igra</th>
												<th>Kvota</th>
											</thead>
											<tbody>
												<?php 
													$ukupna_kvota = 1;
													$nije_odigrana=0;
													$promasaj=0;
													$pogodak=0;
													while($red2=$q2->fetch_object()) {

														if($red2->rezultat == null) {
															$nije_odigrana++;
														} else if($red2->rezultat != $red2->igra) {
															$promasaj++;
														} else {
															$pogodak++;
														}
														
														switch ($red2->igra) {
															case 1:
																$igra = 1;
																$kvota = $red2->kvota1;
																break;
															case 2:
																$igra = 2;
																$kvota = $red2->kvota2;
																break;
															case 3:
																$igra = 'X';
																$kvota = $red2->kvotax;
																break;
															
															default:
																$igra = 'X';
																$kvota = $red2->kvotax;
																break;
														}
														$ukupna_kvota*=$kvota;
													?>
														<tr>
															<td><?php echo $red2->tim1; ?></td>
															<td><?php echo $red2->tim2; ?></td>
															<td><?php echo $igra; ?></td>
															<td><?php echo $kvota; ?></td>
														</tr>
													<?php
													}
												 ?>
											</tbody>
										</table>
										<p>Ukupna kvota: <b><?php echo $ukupna_kvota; ?></b></p>
									</div>
									<div class="col-lg-6 text-center">
										<h1>
											TIKET ID: <b><?php echo $red->id; ?></b>
										</h1>
										<h3>Uplata:  <b><?php echo $red->uplata; ?> RSD</b></h3>
										<h3>Vreme:  <b><?php echo $red->datum_vreme; ?></b></h3>
										<h3>Ukupna isplata: <b><?php echo $red->uplata*$ukupna_kvota; ?> RSD</b></h3>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<h2 class="text-center">Status tiketa</h2>
										<?php 
											if($nije_odigrana>0) {
												?>
													<div class="alert alert-info text-center">Utakmice se i dalje igraju</div>
												<?php
											} else {
												if($promasaj>0) {
													?>
														<div class="alert alert-danger text-center">Tiket nije dobitan. Promasili ste <?php echo $promasaj; ?> utakmica</div>
													<?php
												} else {
													?>
														<div class="alert alert-success text-center">Tiket je dobitan. Isplata: <?php echo $red->uplata*$ukupna_kvota; ?> RSD</div>
													<?php
												}
											}
										 ?>
									</div>
								</div>
							</div>
						<?php
					}
				 ?>
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
				  $(".modal").modal("hide");
				  $("#uplata").val("");
				});
			}
		}
	</script>
</body>
</html>