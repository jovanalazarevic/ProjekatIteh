<?php
	$db_server = "localhost";
	$db_db= "kladionica";
	$db_user = "root";
	$db_pass = "";
	$mysqli = new mysqli($db_server, $db_user, $db_pass, $db_db);


	if ($mysqli->connect_errno) {
	    printf("Konekcija neuspešna: %s\n", $mysqli->connect_error);
	    exit();
	}
	$mysqli->set_charset("utf8");



?>
