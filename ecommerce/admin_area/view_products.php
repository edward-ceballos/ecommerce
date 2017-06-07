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
		<th>Title</th>
		<th>Image</th>
		<th>Price</th>
		<th>Edit</th>
		<th>Del</th>
	</tr>
	<?php 
	include "../includes/db.php";
	include "../includes/img.php";
	$get_products = "SELECT * FROM `products`";

	$run_products = mysqli_query($con, $get_products);
	if (mysqli_num_rows($run_products) > 0) {
		$i = 1;
		while ($rows_products = mysqli_fetch_array($run_products)) {

			$product_id = $rows_products['product_id'];
			$product_title = $rows_products['product_title'];
			$product_cat = $rows_products['product_cat'];
			$product_brand = $rows_products['product_brand'];	
			$product_price = $rows_products['product_price'];	
			$product_desc = $rows_products['product_desc'];
			$product_keywords = $rows_products['product_keywords'];
			$product_image = $rows_products['product_image'];
			$product_image = imgCrop('product_images/'.$product_image, 180, 180);
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $product_title ?></td>
				<td><img src="<?php echo $product_image ?>" alt="<?php echo $product_title ?>" width="50"></td>
				<td>$<?php echo $product_price ?></td>
				<td><a href="index.php?edit_product=<?php echo $product_id ?>">Edit</a></td>
				<td><a href="index.php?delete_product=<?php echo $product_id ?>">Del</a></td>
			</tr>
			<?php
			$i++;
		}
	}

	?>
	
</table>