<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include "../includes/db.php";
if (isset($_GET['delete_customer'])) {

	$customer_id =  $_GET['delete_customer'];

	$customer_delete = "DELETE from `customer` WHERE `customer_id`= '$customer_id'";

	$run_delete = mysqli_query($con, $customer_delete);

	if ($run_delete) {
		echo "<script>alert('The customer was delete, Thanks!');</script>";
		echo "<script>window.open('?view_customers', '_self');</script>";
		// header('Location: index.php?view_customers');
		// exit();
	}else{
		echo $customer_delete;
	}

}
?>