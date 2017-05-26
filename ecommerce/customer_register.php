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
					</span>
				</div>
				
				<form action="customer_register.php" method="post" enctype="multipart/form-data">

					<table  width="750" align="center" bgcolor="">

						<tr>
							<td align="center" colspan="2"><h1>Create Account</h1></td>
						</tr>
						<tr>
							<td align="right">Customer name: </td>
							<td align="left"><input type="text" name="customer_name"></td>
						</tr>
						<tr>
							<td align="right">Customer email: </td>
							<td align="left"><input type="email" name="customer_email"></td>
						</tr>
						<tr>
							<td align="right">Customer pass: </td>
							<td align="left"><input type="password" name="customer_pass"></td>
						</tr>
						<tr>
							<td align="right">Customer image: </td>
							<td align="left"><input type="file" name="customer_image" accept="image/jpeg, image/gif, image/png"></td>
						</tr>
						<tr>
							<td align="right">Customer country: </td>
							<td align="left">
								<select name="customer_country" id="">
									<option>Select Country</option>
									<option>USA</option>
									<option>Rep. Dom.</option>
									<option>Bazil</option>
									<option>Francia</option>
									<option>España</option>
									<option>Mexico</option>
									<option>Perto Rico</option>
									<option>Cuba</option>
								</select>
							</td>

						</tr>
						<tr>
							<td align="right">Customer city: </td>
							<td align="left"><input type="text" name="customer_city"></td>
						</tr>
						<tr>
							<td align="right">Customer contact: </td>
							<td align="left"><input type="text" name="customer_contact"></td>
						</tr>
						<tr>
							<td align="right">Customer address: </td>
							<td align="left"><input type="text" name="customer_address"></td>
						</tr>
						<tr>
							<td align="center" colspan="2"><input type="submit" name="register" value="Create Account"></td>
						</tr>
						
					</table>
				</form>
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


<?php 
if (isset($_POST['register'])) {

	$customer_ip = getIp();
	$customer_name =  $_POST['customer_name'];
	$customer_email =  $_POST['customer_email'];
	$customer_pass =  $_POST['customer_pass'];
	$customer_country =  $_POST['customer_country'];
	$customer_city =  $_POST['customer_city'];
	$customer_contact =  $_POST['customer_contact'];
	$customer_address =  $_POST['customer_address'];
	$customer_image_tmp =  $_FILES['customer_image']['tmp_name'];
	$customer_image = $_FILES['customer_image']['name'];
	;
	$filename = "customer/customer_images/$customer_image";

	if (!file_exists($filename)) {
		if (move_uploaded_file($customer_image_tmp, $filename)) {					
			imgCrop($filename, 100, 100);
		}
	}

	$insert_customer = "INSERT INTO `customer`(`customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES ('$customer_ip', '$customer_name', '$customer_email', '$customer_pass', '$customer_country', '$customer_city', '$customer_contact', '$customer_address', '$customer_image')";


	mysqli_query($con, $insert_customer);

	$sel_cart = "SELECT * FROM `cart` WHERE `ip_add` = '$customer_ip'";

	$run_cart = mysqli_query($con, $sel_cart);
	$check_cart = mysqli_num_rows($run_cart);

	if ($check_cart == 0) {
		$_SESSION['customer_email'] = $customer_email;
		echo "<script>alert('Account has been created successfully, Thanks!');</script>";
		echo "<script>window.open('customer/my_account.php', '_self');</script>";
	}
	else{
		$_SESSION['customer_email'] = $customer_email;
		echo "<script>alert('Account has been created successfully, Thanks!');</script>";
		echo "<script>window.open('checkout.php', '_self');</script>";
	}

}

?>