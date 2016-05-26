<?php
	// Include to get database connection
	include_once 'config/database.php';

	try {
		// Set your default time-zone
		date_default_timezone_set('Asia/Manila');
		$created = date('Y-m-d H:i:s');

		// Write query
		$query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";

		// Prepare query for execution
		$stmt = $con->prepare($query);

		// Posted values
		$name = htmlspecialchars(strip_tags($_POST['name']));
		$description = htmlspecialchars(strip_tags($_POST['description']));
		$price = htmlspecialchars(strip_tags($_POST['price']));

		// Bind the parameters
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':created', $created);
		// Execute the query
		if ($stmt->execute()) {
			echo "Product was created.";
		} else {
			echo "Unable to create product";
		}
	} catch(PDOException $exception) {
		echo "Error: " . $exception->getMessage();
	}
 ?>