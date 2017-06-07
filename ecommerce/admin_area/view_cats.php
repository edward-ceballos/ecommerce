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
	$get_cats = "SELECT * FROM `categories`";

	$run_cats = mysqli_query($con, $get_cats);
	$i = 1;
	while ($rows_cats = mysqli_fetch_array($run_cats)) {

		$cat_id = $rows_cats['cat_id'];
		$cat_title = $rows_cats['cat_title'];

		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $cat_title ?></td>
			<td><a href="index.php?edit_cat=<?php echo $cat_id ?>">Edit</a></td>
			<td><a href="index.php?delete_cat=<?php echo $cat_id ?>">Del</a></td>
		</tr>
		<?php
		$i++;
	}
	?>
</table>