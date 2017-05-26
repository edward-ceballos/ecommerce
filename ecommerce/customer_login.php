
<div>
	<form action="" method="post">
		<table width="700" align="center" bgcolor="skyblue">
			<thead>
				<tr>
					<th colspan="2">
						<h1>Login or register to buy</h1>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td align="right">Email:</td>
					<td align="left"><input type="email" name="email" placeholder="Enter a email"></td>
				</tr>
				<tr>
					<td align="right">Pass:</td>
					<td align="left"><input type="password" name="pass" placeholder="Enter a pass"></td>
				</tr>
				<tr align="center">
					<td colspan="2"><a href="checkout.php?forgot_pass=">Forgot Password</a></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="login" value="Login"></td>
				</tr>
			</tbody>
		</table>
		<h2 style="float: right; padding: 20px;"><a href="customer_register.php" style="text-decoration: none;">New? Register Here</a></h2>
	</form>
</div>

<?php 
if (isset($_POST['login'])) {
	$customer_email = $_POST['email'];
	$customer_pass = $_POST['pass'];

	$sel_c = "SELECT * FROM `customer` WHERE `customer_pass` = '$customer_pass' AND `customer_email` = '$customer_email'";

	$run_c = mysqli_query($con, $sel_c);

	$check_cutomer = mysqli_num_rows($run_c);

	if ($check_cutomer == 0) {
		echo "<script>alert('The email or password is incorrect, please try again!');</script>";
		exit();
	}

	$ip = getIp();

	$sel_cart = "SELECT * FROM `cart` WHERE `ip_add` = '$ip'";

	$run_cart = mysqli_query($con, $sel_cart);
	
	$row_customer = mysqli_fetch_array($run_c);

	$check_cart = mysqli_num_rows($run_cart);

	if ($check_cart == 0 AND $check_cutomer > 0) {

		$_SESSION['customer_email'] = $customer_email;
		$_SESSION['name'] = $row_customer['customer_name'];
		echo "<script>alert('You logged in successfully, Thanks!');</script>";
		echo "<script>window.open('customer/my_account.php', '_self');</script>";
	}
	else{
		$_SESSION['customer_email'] = $customer_email;
		$_SESSION['name'] = $row_customer['customer_name'];
		echo "<script>alert('You logged in successfully, Thanks!, Thanks!');</script>";
		echo "<script>window.open('checkout.php', '_self');</script>";
	}

}
?>







