<table align="center" width="795" bgcolor="pink">
	<tr align="center">
		<td colspan="6"><h2>Orders details.</h2></td>
	</tr>
	<tr bgcolor="skyblue">
		<th>S.N</th>
		<th>Customer</th>
		<th>Product (s)</th>
		<th>Quantity</th>
		<th>Invoice No</th>
		<th>Order Date</th>
		<th>Status</th>
		<th>Edit</th>
		<th>Del</th>
	</tr>
	<?php 
	include "../includes/db.php";
	include "../includes/img.php";
	$id = $_SESSION['id'];
	$get_orders = "SELECT * FROM `orders`";

	$run_orders = mysqli_query($con, $get_orders);
	if (mysqli_num_rows($run_orders) > 0) {
		$i = 1;
		while ($rows_orders = mysqli_fetch_array($run_orders)) {

			$order_id = $rows_orders['order_id'];
			$c_id = $rows_orders['c_id'];
			$p_id = $rows_orders['p_id'];
			$qty = $rows_orders['qty'];	
			$invoice_no = $rows_orders['invoice_no'];	
			$status = $rows_orders['status'];
			$order_date = $rows_orders['order_date'];

			$get_product = "SELECT * FROM `products` WHERE `product_id` = '$p_id'";

			$run_product = mysqli_query($con, $get_product);
			$rows_product = mysqli_fetch_array($run_product);
			$product_title = $rows_product['product_title'];
			$product_image = $rows_product['product_image'];
			$product_image = imgCrop('../admin_area/product_images/'.$product_image, 180, 180);

			$get_customer = "SELECT * FROM `customer` WHERE `customer_id` = '$c_id'";

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
				<td><?php echo $qty ?></td>
				<td><?php echo $customer_name ?></td>
				<td><?php echo $invoice_no ?></td>
				<td><?php echo $order_date ?></td>
				<td><?php echo $status ?></td>
				<?php if ($status != "Completed!"): ?>
					<td><a href="index.php?confirm_order=<?php echo $order_id ?>">Complete Order</a></td>
				<?php else: ?>
					<td>-</td>
				<?php endif ?>
				<td><a href="index.php?delete_order=<?php echo $order_id ?>">Del</a></td>
			</tr>
			<?php
			$i++;
		}
	}
	?>
	
</table>