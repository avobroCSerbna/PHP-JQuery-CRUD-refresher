<?php
	include_once 'config/database.php';

	try {
		// PDO delete query
		$query = "DELETE FROM products WHERE id = ?";
		$stmt = $con->prepare($query);

		// Substitute for the question mark on the query
		$stmt->bindParam(1, $_POST['id']);

		// Execute the query
		if ($stmt->execute()) {
			echo "Product was deleted.";
		} else {
			echo "Unable to delete product.";
		}
	} catch (PDOException $exception) {

	}
?>