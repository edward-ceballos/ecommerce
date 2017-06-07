
<form action="" method="post" enctype="multipart/form-data">

	<table  width="750" align="center" bgcolor="">

		<tr>
			<td align="center" colspan="2"><h1 style="padding: 10px">Change pass</h1></td>
		</tr>
		<tr>
			<td align="right">Enter your current pass: </td>
			<td align="left"><input type="password" name="current_pass" value=""></td>
		</tr>
		<tr>
			<td align="right">New pass: </td>
			<td align="left"><input type="password" name="new_pass" value=""></td>
		</tr>
		<tr>
			<td align="right">Repeat pass: </td>
			<td align="left"><input type="password" name="new_pass_again" value=""></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="change_pass" value="Change Pass"></td>
		</tr>

	</table>
</form>

<?php 
if (isset($_POST['change_pass'])) {

	$customer_id =  $row_customer['customer_id'];
	$current_pass =  $_POST['current_pass'];
	$new_pass =  $_POST['new_pass'];
	$new_pass_again =  $_POST['new_pass_again'];

	$sel_pass =  "SELECT * FROM `customer` WHERE `customer_id` = '$customer_id' AND `customer_pass` = '$current_pass'";

	$run_pass = mysqli_query($con, $sel_pass);

	$check_pass = mysqli_num_rows($run_pass);

	if ($check_pass == 0) {
		echo "<script>alert('The current password is incorrect');</script>";
		exit();
	}

	if ($new_pass != $new_pass_again) {
		echo "<script>alert('New password do no match');</script>";
		exit();
	}
	else{
		$update_pass = "UPDATE `customer` SET `customer_pass`='$new_pass' WHERE `customer_id`='$customer_id'";

		$run_update = mysqli_query($con, $update_pass);

		if ($run_update) {
			
			echo "<script>alert('Account has been modified pass successfully, Thanks!');</script>";
			echo "<script>window.open('my_account.php', '_self');</script>";
		}else{
			echo $update_pass;
		}

	}
	


	
}

?>