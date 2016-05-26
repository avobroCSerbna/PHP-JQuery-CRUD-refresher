<?php
	include 'config/database.php';

	// PDO select all query
	$query = "SELECT id, name, description, price, created FROM products ORDER BY id DESC";
	$stmt = $con->prepare($query);
	$stmt->execute();

	// This is how to get number of rows returned
	$num = $stmt->rowCount();

	// Check if more than 0 record found
	if($num > 0) {
		// Start table
		echo "<table class='table table-bordered table-hover'>";
			// Creating our table heading
			echo "<tr>";
				echo "<th class='width-30-pct'>Name</th>";
				echo "<th class='width-30-pct'>Description</th>";
				echo "<th>Price</th>";
				echo "<th>Created</th>";
				echo "<th style='text-align:center;'>Action</th>";
			echo "<tr>";

			// Retrieve our table contents
			// fetch() is faster than fetchAll()
			// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				// Extract row
				// This will make $row['name'] to
				// just $name only
				extract($row);

				// Creating new table row per record
				echo "<tr>";
					echo "<td>{$name}</td>";
					echo "<td>{$description}</td>";
					echo "<td>{$price}</td>";
					echo "<td>{$created}</td>";
					echo "<td style='text-align:center;'>";
						// Add the record id here, it is used for editing and deleting products
						echo "<div class='product-id display-none'>{$id}</div>";
						// Edit button
						echo "<div class='btn btn-info edit-btn margin-right-1em'>";
							echo "<span class='glyphicon glyphicon-edit'></span> Edit";
						echo "</div>";
						// Delete button
						echo "<div class='btn btn-danger delete-btn'>";
							echo "<span class='glyphicon glyphicon-remove'></span> Delete";
						echo "</div>";
					echo "</td>";
				echo "</tr>";
			}
		// End table
		echo "</table>";
	} else {
		echo "<div class='noneFound'>No records found.</div>";
	}
?>