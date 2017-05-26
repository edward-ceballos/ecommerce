<!DOCTYPE html>
<?php 
include 'functions/functions.php';
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
			<img src="images/logo.png" alt="LOGO" id="logo">
			<img src="images/banner.gif" alt="BANNER" id="banner">
			
		</div>
		<!-- header_wrapper end -->

		<!-- menubar start -->
		<div class="menubar">
			<ul id="menu">
				<li><a href="index.php">HOME</a></li>
				<li><a href="all_products.php">All Products</a></li>
				<li><a href="customer/my_account.php">My Account</a></li>
				<?php if (!isset($_SESSION['customer_email'])): ?>
					<li><a href="checkout.php">Sign Up</a></li>
				<?php endif ?>
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
						<?php if (isset($_SESSION['customer_email'])): ?>
							Welcome <?php echo @$_SESSION['name'] ?>!
						<?php endif ?>
						<b style="color: yellow;">Shopping cart</b> - Total Items: - Total Price: <a href="cart.php">Go to cart</a>
					</span>
				</div>

				<div class="products_box">
					<?php 
					if (isset($_GET['pro_id'])) {
						$product_id = $_GET['pro_id'];
						$get_products = "SELECT * FROM `products` WHERE `product_id` = $product_id";

						$run_products = mysqli_query($con, $get_products);

						while ($rows_products = mysqli_fetch_array($run_products)) {

							$product_id = $rows_products['product_id'];
							$product_title = $rows_products['product_title'];
							$product_cat = $rows_products['product_cat'];
							$product_brand = $rows_products['product_brand'];	
							$product_price = $rows_products['product_price'];	
							$product_desc = $rows_products['product_desc'];
							$product_keywords = $rows_products['product_keywords'];
							$product_image = $rows_products['product_image'];
							$product_image = imgMedium('admin_area/product_images/'.$product_image);
							
							echo "
							<div class='single_product'>
								<h3>$product_title</h3>
								<img src='$product_image' alt='' height='' width=''>
								<p>US$. $product_price</p>
								<div>$product_desc</div>
								<a href='index.php?pro_id=$product_id' style='float: right;'><button>Add to Cart</button></a>
							</div>
							";
						}
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