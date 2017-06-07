<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include "../includes/db.php";
if (isset($_GET['delete_order'])) {

	$order_id =  $_GET['delete_order'];

	$order_delete = "DELETE from `orders` WHERE `order_id`= '$order_id'";

	$run_delete = mysqli_query($con, $order_delete);

	if ($run_delete) {
		echo "<script>alert('The order was delete, Thanks!');</script>";
		echo "<script>window.open('?view_orders', '_self');</script>";
		// header('Location: index.php?view_orders');
		// exit();
	}else{
		echo $order_delete;
	}

}
?>