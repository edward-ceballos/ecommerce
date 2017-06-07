<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include "../includes/db.php";
if (isset($_GET['delete_product'])) {

	$product_id =  $_GET['delete_product'];

	$product_delete = "DELETE from `products` WHERE `product_id`= '$product_id'";

	$run_delete = mysqli_query($con, $product_delete);

	if ($run_delete) {
		echo "<script>alert('The product was delete, Thanks!');</script>";
		echo "<script>window.open('?view_products', '_self');</script>";
		// header('Location: index.php?view_products');
		// exit();
	}else{
		echo $product_delete;
	}

}
?>