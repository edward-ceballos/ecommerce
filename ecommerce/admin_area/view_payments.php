<table align="center" width="795" bgcolor="pink">
	<tr align="center">
		<td colspan="6"><h2>Payments details.</h2></td>
	</tr>
	<tr bgcolor="skyblue">
		<th>S.N</th>
		<th>Customer</th>
		<th>Product (s)</th>
		<th>Paid Amount</th>
		<th>Transaction ID</th>
		<th>Payment Date</th>
	</tr>
	<?php 
	include "../includes/db.php";
	include "../includes/img.php";
	$id = $_SESSION['id'];
	$get_payments = "SELECT * FROM `payments`";

	$run_payments = mysqli_query($con, $get_payments);
	if (mysqli_num_rows($run_payments) > 0) {
		$i = 1;
		while ($rows_payments = mysqli_fetch_array($run_payments)) {

			$payment_id = $rows_payments['payment_id'];
			$amount = $rows_payments['amount'];
			$customer_id = $rows_payments['customer_id'];
			$product_id = $rows_payments['product_id'];	
			$trx_id = $rows_payments['trx_id'];	
			$currency = $rows_payments['currency'];
			$payment_date = $rows_payments['payment_date'];

			$get_product = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";

			$run_product = mysqli_query($con, $get_product);
			$rows_product = mysqli_fetch_array($run_product);
			$product_title = $rows_product['product_title'];
			$product_image = $rows_product['product_image'];
			$product_image = imgCrop('../admin_area/product_images/'.$product_image, 180, 180);

			$get_customer = "SELECT * FROM `customer` WHERE `customer_id` = '$customer_id'";

			$run_customer = mysqli_query($con, $get_customer);
			$rows_customer = mysqli_fetch_array($run_customer);
			$customer_name = $rows_customer['customer_name'];

			?>
			<tr>
				<td><?php echo $i ?></td>
				<td>
					<?php echo $product_title ?>
					<br>
					<img src="<?php echo $product_image ?>" alt="<?php echo $product_title ?>" width="50" >
				</td>
				<td><?php echo $customer_name ?></td>
				<td><?php echo $amount ?></td>
				<td><?php echo $trx_id ?></td>
				<td><?php echo $payment_date ?></td>
			</tr>
			<?php
			$i++;
		}
	}
	?>
	
</table>