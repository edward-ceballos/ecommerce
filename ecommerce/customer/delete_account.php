<h1>Do you really want DELETE your account?</h1>
<form action="" method="post" enctype="multipart/form-data">
	<input type="submit" name="yes" value="Yes I Want">
	<input type="submit" name="no" value="No i was joking">
</form>

<?php 
if (isset($_POST['yes'])) {

	$customer_id =  $row_customer['customer_id'];

	$customer_delete = "DELETE from `customer` WHERE `customer_id`='$customer_id'";

	$run_delete = mysqli_query($con, $customer_delete);

	if ($run_delete) {
		echo "<script>alert('Your account was delete, Thanks!');</script>";
		echo "<script>window.open('../logout.php', '_self');</script>";
	}else{
		echo $customer_delete;
	}

}

if (isset($_POST['no'])) {
	echo "<script>alert('Oh! do no joke again.');</script>";
	echo "<script>window.open('my_account.php', '_self');</script>";
}


?>