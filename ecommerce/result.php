<!DOCTYPE html>
<?php 
	include 'functions.php';
?>
<html>
<head>
	<title>Mi tienda online</title>
	<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
	<!-- main_wrapper start -->
	<div class="main_wrapper">
		<!-- header_wrapper start -->
		<div class="header_wrapper">
			<a href="index.php">
				<img src="images/logo.png" alt="LOGO" id="logo">
			</a>
			<img src="images/banner.gif" alt="BANNER" id="banner">
			
		</div>
		<!-- header_wrapper end -->

		<!-- menubar start -->
		<div class="menubar">
			<ul id="menu">
				<li><a href="index.php">HOME</a></li>
				<li><a href="all_products.php">All Products</a></li>
				<li><a href="my_account.php">My Account</a></li>
				<li><a href="login.php">Sign Up</a></li>
				<li><a href="cart.php">Shopping Cart</a></li>
				<li><a href="contact.php">Constacts Us</a></li>
			</ul>
			<div id="form">
				<form method="get" action="result.php" enctype="multipart/form-data">
					<input type="text" name="user_query">
					<input type="submit" name="search" value="Buscar">
				</form>
			</div>
		</div>
		<!-- menubar end -->

		<!-- content_wrapper start -->
		<div class="content_wrapper">
			<div id="sidebar">
				<div class="sidebar_title">Categories</div>
				<ul class="cats">
					<?php getCats() ?>
				</ul>
				<div class="sidebar_title">Brands</div>
				<ul class="cats">
					<?php getBrands() ?>
				</ul>
			</div>
			<div id="content_area">

				<div id="shopping_cart">
					<span>
						Welcome guest! <b style="color: yellow;">Shopping cart</b> - Total Items: - Total Price: <a href="cart.php">Go to cart</a>
					</span>
				</div>

				<div class="products_box">
					<?php 
						if(isset($_GET['user_query'])){
							$user_query = $_GET['user_query'];
							$get_products = "SELECT * FROM `products` WHERE `product_keywords` LIKE '%$user_query%'";
							$message = '<p>No product add with the user_query</p>';
						}
						else{
							$get_products = "SELECT * FROM `products`";
							$message = '<p>No product add</p>';
						}

						$run_products = mysqli_query($con, $get_products);

						if (mysqli_num_rows($run_products) > 0) {
							while ($rows_products = mysqli_fetch_array($run_products)) {

								$product_id = $rows_products['product_id'];
								$product_title = $rows_products['product_title'];
								$product_cat = $rows_products['product_cat'];
								$product_brand = $rows_products['product_brand'];	
								$product_price = $rows_products['product_price'];	
								$product_desc = $rows_products['product_desc'];
								$product_keywords = $rows_products['product_keywords'];
								$product_image = $rows_products['product_image'];
								
								echo "
								<div class='single_product'>
									<h3>$product_title</h3>
									<a href='details.php?pro_id=$product_id'>
										<img src='admin_area/product_images/$product_image' alt='' height='180' width='180'>
									</a>
									<p>US$. $product_price</p>
									<a href='details.php?pro_id=$product_id' style='float: left;'>Details</a>
									<a href='index.php?pro_id=$product_id' style='float: right;'><button>Add to Cart</button></a>
								</div>
								";

							}
						}else{
							echo($message);
						}

					?>
				</div>
			</div>
		</div>
		<!-- content_wrapper end -->

		<!-- footer start -->
		<div id="footer">
			<h1 style="text-align: center; padding-top: 30px;">&copy; <?php echo date('Y'); ?> by <a href="http://edwardceballos.com" target="_blank">edwardceballos.com</a></h1>
		</div>
		<!-- footer end -->
	</div>
	<!-- main_wrapper end -->
</body>
</html>