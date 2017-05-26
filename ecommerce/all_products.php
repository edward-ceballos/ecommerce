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
						<b style="color: yellow;">Shopping cart</b> - Total Items: <?php total_items() ?> - Total Price: $ <?php total_price() ?> <a href="cart.php" style="color: yellow;">Go to cart</a>

						<?php 
						if (!isset($_SESSION['customer_email'])) {
							echo "<a href='checkout.php' style='color: orange;'>Login</a>";
						}
						else{
							echo "<a href='logout.php' style='color: orange;'>Logout</a>";
						}
						?>
					</span>
				</div>

				<div class="products_box">
					<?php 
					if (isset($_GET['cat'])) {
						$cat = $_GET['cat'];
						$get_products = "SELECT * FROM `products` WHERE `product_cat` = $cat";
						$message = '<p>No product add white the cat</p>';
					}
					elseif(isset($_GET['brand'])){
						$brand = $_GET['brand'];
						$get_products = "SELECT * FROM `products` WHERE `product_brand` = $brand";
						$message = '<p>No product add wiht the brand</p>';
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
							$product_image = imgCrop('admin_area/product_images/'.$product_image, 180, 180);

							echo "
							<div class='single_product'>
								<h3>$product_title</h3>
								<a href='details.php?pro_id=$product_id'>
									<img src='$product_image' alt='' height='' width=''>
								</a>
								<p>US$. $product_price</p>
								<a href='details.php?pro_id=$product_id' style='float: left;'>Details</a>
								<a href='index.php?add_cart=$product_id' style='float: right;'><button>Add to Cart</button></a>
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