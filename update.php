<?php
	include_once 'config/database.php';

	try {
		// PDO update query
		$query = "UPDATE products SET name=:name, description=:description, price=:price WHERE id=:id";

		// Prepare query for execution
		$stmt = $con->prepare($query);

		// Posted values
		$name = htmlspecialchars(strip_tags($_POST['name']));
		$description = htmlspecialchars(strip_tags($_POST['description']));
		$price = htmlspecialchars(strip_tags($_POST['price']));
		$id = htmlspecialchars(strip_tags($_POST['id']));

		// Bind the parameters
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':id', $id);

		// Execute the query
		if ($stmt->execute()) {
			echo "Product was updated.";
		} else {
			echo "Unable to update product";
		}

	} catch (PDOException $exception) { // Handle if there is any error
		echo "Error: " . $exception->getMessage();
	}
 ?>