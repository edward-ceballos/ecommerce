<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Area</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<div class="main_wrapper">
		<div id="header"></div>
		<div id="right">
			<h2>Maname Content:</h2>
			<ul>
				<a href="index.php?insert_product">Insert Product</a>
				<a href="index.php?view_products">View All Products</a>
				<a href="index.php?insert_cat">Insert New Category</a>
				<a href="index.php?view_cats">View All Category</a>
				<a href="index.php?insert_brand">Insert New Brand</a>
				<a href="index.php?view_brands">View All Brands</a>
				<a href="index.php?view_customers">View Customers</a>
				<a href="index.php?view_orders">View Orders</a>
				<a href="index.php?view_payments">View payments</a>
				<a href="logout.php">Admin Logout</a></li>
			</ul>
		</div>
		<div id="left">
			<?php 
			if (isset($_GET['insert_product'])){
				include 'insert_product.php';
			}
			if (isset($_GET['view_products'])){
				include 'view_products.php';
			}
			if (isset($_GET['edit_product'])){
				include 'edit_product.php';
			}
			if (isset($_GET['delete_product'])){
				include 'delete_product.php';
			}
			if (isset($_GET['insert_cat'])){
				include 'insert_cat.php';
			}
			if (isset($_GET['view_cats'])){
				include 'view_cats.php';
			}
			if (isset($_GET['edit_cat'])){
				include 'edit_cat.php';
			}
			if (isset($_GET['delete_cat'])){
				include 'delete_cat.php';
			}
			if (isset($_GET['insert_brand'])){
				include 'insert_brand.php';
			}
			if (isset($_GET['view_brands'])){
				include 'view_brands.php';
			}
			if (isset($_GET['edit_brand'])){
				include 'edit_brand.php';
			}
			if (isset($_GET['delete_brand'])){
				include 'delete_brand.php';
			}
			if (isset($_GET['view_customers'])){
				include 'view_customers.php';
			}
			if (isset($_GET['delete_customer'])){
				include 'delete_customer.php';
			}

			if (isset($_GET['view_orders'])){
				include 'view_orders.php';
			}
			if (isset($_GET['confirm_order'])){
				include 'confirm_order.php';
			}
			if (isset($_GET['delete_order'])){
				include 'delete_order.php';
			}
			if (isset($_GET['view_payments'])){
				include 'view_payments.php';
			}
			?>
		</div>
	</div>
</body>
</html>