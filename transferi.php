<?php 
	session_start();
	if(!isset($_SESSION['korisnik_id'])) {
		header("Location: login.php");
	}

	$xml=simplexml_load_file("https://www.eyefootball.com/rss_news_transfers.xml");

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
<body>
	<?php include "navbar.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Transferi</h1>
				<?php 
			foreach ($xml->channel->item as $i) {
				?>
					<div class="row">
						<div class="col-lg-12">
							<h1>
								<?php echo $i->title; ?>
							</h1>
							<p><?php echo $i->description; ?></p>
							<hr>
						</div>
					</div>
				<?php
			}
		 ?>
			</div>
		</div>
	</div>
	
	<script
	  src="https://code.jquery.com/jquery-3.4.1.js"
	  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	  crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>