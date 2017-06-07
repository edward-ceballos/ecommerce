<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<table align="center" width="795" bgcolor="pink">
	<tr align="center">
		<td colspan="6"><h2>View All Products here</h2></td>
	</tr>
	<tr bgcolor="skyblue">
		<th>S.N</th>
		<th>Category</th>
		<th>Edit</th>
		<th>Del</th>
	</tr>
	<?php 
	include '../includes/db.php';
	$get_brands = "SELECT * FROM `brands`";

	$run_brands = mysqli_query($con, $get_brands);
	$i = 1;
	while ($rows_brands = mysqli_fetch_array($run_brands)) {

		$brand_id = $rows_brands['brand_id'];
		$brand_title = $rows_brands['brand_title'];

		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $brand_title ?></td>
			<td><a href="index.php?edit_brand=<?php echo $brand_id ?>">Edit</a></td>
			<td><a href="index.php?delete_brand=<?php echo $brand_id ?>">Del</a></td>
		</tr>
		<?php
		$i++;
	}
	?>
</table>