<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include '../includes/db.php';
$id = $_GET['edit_cat'];
$get_cat = "SELECT * FROM `categories` WHERE `cat_id` = '$id'";

$run_cat = mysqli_query($con, $get_cat);
if (mysqli_num_rows($run_cat) > 0) {
	$row_cat = mysqli_fetch_array($run_cat);
	$cat_title = $row_cat['cat_title'];
}

?>

<form method="post" action="" enctype="multipart/form-data">
	<table align="center" width="795" border="2" bgcolor="white">
		<tr>
			<td colspan="8" align="center"><h2>Edit Category</h2></td>
		</tr>

		<tr>
			<th align="right">Category title</th>
			<td>
				<input type="text" name="cat_title" size="80" required value="<?php echo $cat_title ?>">
			</td>
		</tr>
		<tr align="center">
			<td colspan="8">
				<input type="submit" name="update_cat" value="Update Now">
			</td>
		</tr>
	</table>
</form>
<?php 


if (isset($_POST['update_cat'])) {

	//data text
	$cat_title = $_POST['cat_title'];

	$edit_cat = "UPDATE `categories` SET `cat_title`= '$cat_title' WHERE `cat_id` = '$id'";

	if (mysqli_query($con, $edit_cat)) {
		echo "<script>alert('The category will be update');</script>";
		echo "<script>window.open('?view_cats', '_self');</script>";
	}else{
		echo "<script>alert('The saved failed');</script>";
		echo "<script>window.open('?edit_cat, '_self');</script>";
	}
}

?>