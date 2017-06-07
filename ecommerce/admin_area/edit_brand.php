<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<?php 
include '../includes/db.php';
$id = $_GET['edit_brand'];
$get_brand = "SELECT * FROM `brands` WHERE `brand_id` = '$id'";

$run_brand = mysqli_query($con, $get_brand);
if (mysqli_num_rows($run_brand) > 0) {
	$row_brand = mysqli_fetch_array($run_brand);
	$brand_title = $row_brand['brand_title'];
}

?>

<form method="post" action="" enctype="multipart/form-data">
	<table align="center" width="795" border="2" bgcolor="white">
		<tr>
			<td colspan="8" align="center"><h2>Edit brand</h2></td>
		</tr>

		<tr>
			<th align="right">Brand title</th>
			<td>
				<input type="text" name="brand_title" size="80" required value="<?php echo $brand_title ?>">
			</td>
		</tr>
		<tr align="center">
			<td colspan="8">
				<input type="submit" name="update_brand" value="Update Now">
			</td>
		</tr>
	</table>
</form>
<?php 


if (isset($_POST['update_brand'])) {

	//data text
	$brand_title = $_POST['brand_title'];

	$edit_brand = "UPDATE `brands` SET `brand_title`= '$brand_title' WHERE `brand_id` = '$id'";

	if (mysqli_query($con, $edit_brand)) {
		echo "<script>alert('The brand will be update');</script>";
		echo "<script>window.open('?view_brands', '_self');</script>";
	}else{
		echo "<script>alert('The saved failed');</script>";
		echo "<script>window.open('?edit_brand, '_self');</script>";
	}
}

?>