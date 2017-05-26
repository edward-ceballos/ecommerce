<!DOCTYPE html>
<?php 
include 'functions/functions.php';
?>
<html>
<head>
	<title>Mi tienda online</title>
	<!-- <link href="http://mercasid.com.do/wp-content/themes/mercasid//css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
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
						<b style="color: yellow;">Shopping cart</b> - Total Items: <?php total_items() ?> - Total Price: $ <?php total_price() ?> <a href="all_products.php" style="color: yellow;">Back to shop</a>
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
					<br>
					<form action="" method="post">
						<table class="table" id="table" width="700" bgcolor="skyblue">
							<thead>
								<tr>
									<th>Remove</th>
									<th>product (s)</th>
									<th>Quantity</th>
									<th>Total Price</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$ip = getIP();

								$sel_price = "SELECT * FROM `cart` join `products` on `cart`.`p_id` = `products`.`product_id`  WHERE `ip_add` = '$ip'";

								$run_price = mysqli_query($con, $sel_price);
								$total = 0;
								if (mysqli_num_rows($run_price)) {
									while ($rows_products = mysqli_fetch_array($run_price)) {
										
										$product_title = $rows_products['product_title'];
										$product_price = $rows_products['product_price'];	
										$product_image = $rows_products['product_image'];
										$product_id = $rows_products['product_id'];
										$qty = $rows_products['qty'];
										$p_id = $rows_products['p_id'];
										$product_image = imgCrop('admin_area/product_images/'.$product_image, 180, 180);

										$total += ($product_price * $qty);
										?>
										<tr align='center'>
											<td><input type='checkbox' name='remove[]' value="<?php echo $product_id; ?>"></td>
											<td>
												<?php echo $product_title; ?><br>
												<img src='<?php echo $product_image; ?>' alt='<?php echo $product_title; ?>' width='60'>
											</td>
											<td><input type="number" name="qty[]" size="4" min="1" value="<?php echo $qty; ?>"> <input type='hidden' name='p_id[]' value="<?php echo $product_id; ?>"></td>

											<td>$<?php echo number_format($product_price * $qty) ?></td>
										</tr>
										<?php
									}
								}
								?> 
								<tr align="right">
									<td colspan="4"><b>Sub Total:</b> $<?php echo number_format($total) ?></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
									<td>
										<button><a href="index.php">Continue Shopping</a></button>
										<!-- <input type="submit" name="continue" value="Continue Shopping"> -->
									</td>
									<td>
										<button><a href="checkout.php">Checkout</a></button>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
					<?php 
					if (isset($_POST['update_cart'])) {
						$count = $_POST['qty'];

						$i = 0;
						foreach ($count as $value) {
							$pro_id = $_POST['p_id'][$i];
							$update_qty = "UPDATE `cart` SET `qty` = '$value' WHERE `p_id` = '$pro_id'";

							$run_qyt = mysqli_query($con, $update_qty);
							$i++;
							if ($run_qyt) {
										// header("Location: cart.php");
										// exit;
								echo "<script>window.open('cart.php','_self')</script>";
							}
						}

						// $_SESSION['qty'] = $qty;
						// $total =  $total * $qty;
					}

					?>
					<?php 
					$ip = getIP();
					if (isset($_POST['update_cart'])) {
						if (isset($_POST['remove'])) {
							foreach ($_POST['remove'] as $remove_id) {
								$delete_product = "DELETE from `cart` WHERE `p_id` = '$remove_id' AND `ip_add` = '$ip'";

								$run_delete = mysqli_query($con, $delete_product);
								if ($run_delete) {
										// header("Location: cart.php");
										// exit;
									echo "<script>window.open('index.php','_self')</script>";
								}
							}
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