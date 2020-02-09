<?php
	session_start();
	if(isset($_SESSION['korisnik_id'])) {
		if($_SESSION['admin']==0) {
			header("Location: index.php");
		} else {
			header("Location: admin.php");
		}
	} 
	include "konekcija.php";
	if(isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$sql = "SELECT * FROM korisnici WHERE username ='$username' AND password = '$password'";
		$q=$mysqli->query($sql);
		if(mysqli_num_rows($q)>0) {
			$red=$q->fetch_object();
			$_SESSION['korisnik_id'] = $red->id;
			$_SESSION['admin'] = $red->admin;
			if($red->admin == 0) {
				header("Location: index.php");
			} else {
				header("Location: admin.php");
			}
			
		} else {
			$msg="Pogresan username i password!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<style>
		.well {
			margin-top: 100px;
		}
		.btn {
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="well">
					<h1 class="text-center">Login</h1>
					<?php if(!empty($msg)) echo $msg; ?>
					<form action="" method="POST">
						<p>Username:</p>
						<input type="text" class="form-control" name="username">
						<p>Password:</p>
						<input type="password" class="form-control" name="password">
						<input type="submit" name="submit" class="btn btn-primary btn-block" value="Login">
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