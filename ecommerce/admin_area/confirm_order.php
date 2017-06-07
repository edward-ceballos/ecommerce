<?php 
include "../includes/db.php";
if (isset($_GET['confirm_order'])) {
	$get_id = $_GET['confirm_order'];

	$status = "Completed!";

	$update_order = "UPDATE `orders` SET `status` = '$status' WHERE `order_id` = '$get_id'";

	$run_update = mysqli_query($con, $update_order);

	if ($run_update) {
		echo "<script>alert('The order will be confirm');</script>";
		echo "<script>window.open('?view_orders', '_self');</script>";
	}else{
		echo "<script>alert('The confirm failed');</script>";
		echo "<script>window.open('?view_orders, '_self');</script>";
	}
}