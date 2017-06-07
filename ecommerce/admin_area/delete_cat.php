<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include "../includes/db.php";
if (isset($_GET['delete_cat'])) {

	$cat_id =  $_GET['delete_cat'];

	$cat_delete = "DELETE from `categories` WHERE `cat_id`= '$cat_id'";

	$run_delete = mysqli_query($con, $cat_delete);

	if ($run_delete) {
		echo "<script>alert('The cat was delete, Thanks!');</script>";
		echo "<script>window.open('?view_cats', '_self');</script>";
		// header('Location: index.php?view_cats');
		// exit();
	}else{
		echo $cat_delete;
	}

}
?>