<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Read Products</title>

	<link rel="stylesheet" type="text/css" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="libs/css/custom.css">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<div class='margin-bottom-1em overflow-hidden'>
			    <!-- when clicked, it will show the product's list -->
			    <div id='read-products' class='btn btn-primary pull-right display-none'>
			        <span class='glyphicon glyphicon-list'></span> Read Products
			    </div>

			    <!-- when clicked, it will load the create product form -->
			    <div id='create-product' class='btn btn-primary pull-right'>
			        <span class='glyphicon glyphicon-plus'></span> Create Product
			    </div>

			    <!-- this is the loader image, hidden at first -->
			    <div id='loader-image' class="display-none"><img src='images/ajax-loader.gif' /></div>
			</div>
			<h1 id="page-title">Read Products</h1>
		</div>


		<!-- This is where the contents will be shown -->
		<div id="page-content">
			
		</div>
	</div>

	<script type="text/javascript" src="libs/js/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="libs/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="libs/js/holder.js"></script>

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript">
		function changePageTitle(page_title) {
			// Change page title
			$('#page-title').text(page_title);

			// Change the title tag
			document.title = page_title;
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			// View products on load of the page
			$('#loader-image').show();
			showProducts();

			// Clicking the 'read products' button
			$('#read-products').click(function() {
				// Show a loader image
				$('#loader-image').show();
				// Show create product butotnA
				$('#create-product').show();
				// Hide read products button
				$('#read-products').hide();
				// Show products
				showProducts();
			});

			// Read products
			function showProducts() {
				// Change page title
				changePageTitle('Read Products');

				// Fade out effect first
				$('#page-content').fadeOut('slow', function() {
					$('#page-content').load('read.php', function() {
						// Hide loader image
						$('#loader-image').hide();
						// Fade in effect
						$('#page-content').fadeIn('slow');
					});
				});
			}

			// Will show the create product form
			$('#create-product').click(function() {
				$('#create-product').hide();

				// Change page title
				changePageTitle('Create Product');

				// Show create product form, show a loader image
				$('#loader-image').show();

				// Fade out effect first
				$('#page-content').fadeOut('slow', function() {
					$('#page-content').load('create_form.php', function() {
						$('#read-products').show();
						// Hide loader image
						$('#loader-image').hide();

						// Fade in effect
						$('#page-content').fadeIn('slow');
					});
				});
			});

			$(document).on('submit', '#create-product-form', function() {
				// Show a loader img
				$('#loader-image').show();

				// Post the data from the form
				$.post("create.php", $(this).serialize())
				.done(function(data) {
					alert('Created!');
					// Show create product button
					$('#create-product').show();

					// Hide read products button
					$('#read-products').hide();

					// 'data' is the text returned, you can do any conditions based on that
					showProducts();
				});

				return false;
			});

			// Clicking the edit button
			$(document).on('click', '.edit-btn', function() {
				// Change page title
				changePageTitle('Update product');

				var product_id = $(this).closest('td').find('.product-id').text();
				console.log(product_id);
				alert(product_id);

				// Show a loader image
				$('#loader-image').show();

				// Hide create product button
				$('#read-products').show();

				// Fade out effect first
				$('#page-content').fadeOut('slow', function() {
					$('#page-content').load('update_form.php?product_id=' + product_id, function() {
						// Hide loader image
						$('#loader-image').hide();

						// Fade in effect
						$('#page-content').fadeIn('slow');
					});
				});
			});


			// Will run if update product form was submitted
			$(document).on('submit', '#update-product-form', function() {
				// Show a loader img
				$('#loader-img').show();

				// Post the data from the form
				$.post("update.php", $(this).serialize())
				 .done(function(data) {
				 	// Show create product form
				 	$('#create-product').show();

				 	// Hide read products button
				 	$('#read-products').hide();

				 	// 'data is the text returned,  you can do any conditions based on that
				 	showProducts();
				 });

				 return false;
			});

			// Will run if the delete button was clicked
			$(document).on('click', '.delete-btn', function() {
				if (confirm('Are you sure?')) {
					// Get the id
					var product_id = $(this).closest('td').find('.product-id').text();

					// Trigger the delete file
					$.post("delete.php", { id: product_id })
					 .done(function(data) {
					 	console.log(data);

					 	// Show loader image
					 	$('#loader-image').show();

					 	// Reload the product list
					 	showProducts();
					 });
				} else {

				}
			});
		});
	</script>
</body>
</html>