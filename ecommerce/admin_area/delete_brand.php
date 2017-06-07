<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include "../includes/db.php";
if (isset($_GET['delete_brand'])) {

	$brand_id =  $_GET['delete_brand'];

	$brand_delete = "DELETE from `brands` WHERE `brand_id`= '$brand_id'";

	$run_delete = mysqli_query($con, $brand_delete);

	if ($run_delete) {
		echo "<script>alert('The brand was delete, Thanks!');</script>";
		echo "<script>window.open('?view_brands', '_self');</script>";
		// header('Location: index.php?view_brands');
		// exit();
	}else{
		echo $brand_delete;
	}

}
?>