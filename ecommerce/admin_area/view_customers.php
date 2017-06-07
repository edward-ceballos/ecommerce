<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<table align="center" width="795" bgcolor="pink">
	<tr align="center">
		<td colspan="6"><h2>View All customers here</h2></td>
	</tr>
	<tr bgcolor="skyblue">
		<th>S.N</th>
		<th>Name</th>
		<th>Email</th>
		<th>Image</th>
		<th>Del</th>
	</tr>
	<?php 
	include "../includes/db.php";
	include "../includes/img.php";
	$get_customers = "SELECT * FROM `customer`";

	$run_customers = mysqli_query($con, $get_customers);
	if (mysqli_num_rows($run_customers) > 0) {
		$i = 1;
		while ($rows_customers = mysqli_fetch_array($run_customers)) {

			$customer_id = $rows_customers['customer_id'];
			$customer_name = $rows_customers['customer_name'];
			$customer_email = $rows_customers['customer_email'];
			$customer_image = $rows_customers['customer_image'];
			$customer_image = imgCrop('../customer/customer_images/'.$customer_image, 180, 180);
			?>
			<tr align="center">
				<td><?php echo $i ?></td>
				<td><?php echo $customer_name ?></td>
				<td><?php echo $customer_email ?></td>
				<td><img src="<?php echo $customer_image ?>" alt="<?php echo $customer_title ?>" width="50"></td>
				<td><a href="index.php?delete_customer=<?php echo $customer_id ?>">Del</a></td>
			</tr>
			<?php
			$i++;
		}
	}

	?>
	
</table>