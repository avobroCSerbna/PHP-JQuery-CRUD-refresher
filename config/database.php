<?php 
	// Used to connect to the database
	$host = "localhost";
	$db_name = "phpajaxcrudlevel1";
	$username = "root";
	$password = "hesoy@m08";

	try {
		$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
	} catch(PDOException $exception) { // Handle connection error
		echo "Connection error: " . $exception->getMessage();
	}
 ?>