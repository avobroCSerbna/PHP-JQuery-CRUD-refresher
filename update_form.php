<?php
	include 'config/database.php';

	// Get product id
	$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die('ERROR: Product ID not found');

	// PDO query to select single record based on ID
	$query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";

	// Prepare query
	$stmt = $con->prepare($query);

	// This is the first question mark on the query
	$stmt->bindParam(1, $product_id);

	// Execute our query
	if ($stmt->execute()) {
		// Store retrieved row to a variable
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Values to fill up our form
		$id = $row['id'];
		$name = $row['name'];
		$description = $row['description'];
		$price = $row['price'];
	} else {
		echo "Unable to read record";
	}
 ?>

 <!--we have our html form here where new product information will be entered-->
<form id='update-product-form' action='#' method='post' border='0'>
    <table class='table table-bordered table-hover'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value='<?php echo htmlspecialchars($name, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
            <textarea name='description' class='form-control' required><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='number' min='1' name='price' class='form-control' value='<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>' required /></td>
        </tr>
        <tr>
            <td>
                <!-- hidden ID field so that we could identify what record is to be updated -->
                <input type='hidden' name='id' value='<?php echo $id ?>' />
            </td>
            <td>
        <button type='submit' class='btn btn-primary'>
            <span class='glyphicon glyphicon-edit'></span> Save Changes
        </button>
            </td>
        </tr>
    </table>
</form>