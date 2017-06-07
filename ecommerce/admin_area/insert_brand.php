<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<form action="" method="post" style="padding: 80px">
<h1>Insert new ctegory</h1>
	<input type="text" name="brand_title">
	<input type="submit" name="add_brand" value="Add brand">
</form>
<?php 
include '../includes/db.php';
if (isset($_POST['add_brand'])) {

	$brand_title = $_POST['brand_title'];

	$insert_brandegory = "INSERT INTO `brands`( `brand_title`) VALUES ('$brand_title')";

	if (mysqli_query($con, $insert_brandegory)) {
		echo "<script>alert('The brand will be created');</script>";
		echo "<script>window.open('?view_brands', '_self');</script>";
	}else{
		echo "<script>alert('The saved failed');</script>";
		echo "<script>window.open('?insert_brand, '_self');</script>";
	}
}
?>