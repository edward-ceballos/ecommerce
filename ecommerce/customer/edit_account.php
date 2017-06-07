
<form action="" method="post" enctype="multipart/form-data">

	<table  width="750" align="center" bgcolor="">

		<tr>
			<td align="center" colspan="2"><h1 style="padding: 10px">Edit Account</h1></td>
		</tr>
		<tr>
			<td align="right">Customer name: </td>
			<td align="left"><input type="text" name="customer_name" value="<?php echo @$row_customer['customer_name'] ?>"></td>
		</tr>
		<tr>
			<td align="right">Customer email: </td>
			<td align="left"><input type="email" name="customer_email" value="<?php echo @$row_customer['customer_email'] ?>"></td>
		</tr>
		<tr>
			<td align="right">Customer image: </td>
			<td align="left"><input type="file" name="customer_image" accept="image/jpeg, image/gif, image/png"> <img src="<?php echo imgMedium('customer_images/'.$row_customer['customer_image']) ?>" alt="<?php echo @$row_customer['customer_name'] ?>" width='100' ></td>
		</tr>
		<tr>
			<td align="right">Customer country: </td>
			<td align="left">
				<select name="customer_country" id="">
					<option><?php echo @$row_customer['customer_country'] ?></option>
				</select>
			</td>

		</tr>
		<tr>
			<td align="right">Customer city: </td>
			<td align="left"><input type="text" name="customer_city" value="<?php echo @$row_customer['customer_city'] ?>"></td>
		</tr>
		<tr>
			<td align="right">Customer contact: </td>
			<td align="left"><input type="text" name="customer_contact" value="<?php echo @$row_customer['customer_contact'] ?>"></td>
		</tr>
		<tr>
			<td align="right">Customer address: </td>
			<td align="left"><input type="text" name="customer_address" value="<?php echo @$row_customer['customer_address'] ?>"></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="update" value="Update Account"></td>
		</tr>

	</table>
</form>

<?php 
if (isset($_POST['update'])) {

	$customer_ip = getIp();
	$customer_id =  $row_customer['customer_id'];
	$customer_name =  $_POST['customer_name'];
	$customer_email =  $_POST['customer_email'];
	$customer_pass =  $row_customer['customer_pass'];
	$customer_country =  $_POST['customer_country'];
	$customer_city =  $_POST['customer_city'];
	$customer_contact =  $_POST['customer_contact'];
	$customer_address =  $_POST['customer_address'];
	
	if ($_FILES['customer_image']['name'] != NULL) {
		$customer_image_tmp =  $_FILES['customer_image']['tmp_name'];
		$customer_image = $_FILES['customer_image']['name'];
		$filename = "customer_images/$customer_image";

		if (!file_exists($filename)) {
			if (move_uploaded_file($customer_image_tmp, $filename)) {					
				imgCrop($filename, 100, 100);
			}
		}
	}else{
		$customer_image = $row_customer['customer_image'];
	}
	
	

	$update_customer = "UPDATE `customer` SET `customer_ip`='$customer_ip',`customer_name`='$customer_name',`customer_email`='$customer_email',`customer_pass`='$customer_pass',`customer_country`='$customer_country',`customer_city`='$customer_city',`customer_contact`='$customer_contact',`customer_address`='$customer_address',`customer_image`='$customer_image' WHERE `customer_id`='$customer_id'";


	$run_update = mysqli_query($con, $update_customer);

	if ($run_update) {
		
		echo "<script>alert('Account has been modified successfully, Thanks!');</script>";
		echo "<script>window.open('my_account.php', '_self');</script>";
	}else{
		echo $update_customer;
	}

}

?>