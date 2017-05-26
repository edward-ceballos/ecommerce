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
				<?php cart() ?>
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
					if (!isset($_SESSION['customer_email'])) {
						include 'customer_login.php';
					}
					else{
						include 'payment.php';
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
