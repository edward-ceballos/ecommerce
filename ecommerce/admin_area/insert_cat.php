<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<form action="" method="post" style="padding: 80px">
<h1>Insert new ctegory</h1>
	<input type="text" name="cat_title">
	<input type="submit" name="add_cat" value="Add Category">
</form>
<?php 
include '../includes/db.php';
if (isset($_POST['add_cat'])) {

	$cat_title = $_POST['cat_title'];

	$insert_category = "INSERT INTO `categories`( `cat_title`) VALUES ('$cat_title')";

	if (mysqli_query($con, $insert_category)) {
		echo "<script>alert('The category will be created');</script>";
		echo "<script>window.open('?view_cats', '_self');</script>";
	}else{
		echo "<script>alert('The saved failed');</script>";
		echo "<script>window.open('?insert_cat, '_self');</script>";
	}
}
?>