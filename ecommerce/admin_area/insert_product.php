<!DOCTYPE html>
<?php 
	include '../includes/db.php';
	include '../includes/img.php';
	if (isset($_POST['insert_post'])) {

		//data text
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_title = $_POST['product_title'];	
		$product_price = $_POST['product_price'];	
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];

		//data image
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		$filename = "product_images/$product_image";
		if (move_uploaded_file($product_image_tmp, $filename)) {
			imgCrop($filename, 180, 180);
		}

		$insert_product = "INSERT INTO `products`( `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES ('$product_cat', '$product_brand', '$product_title', '$product_price', '$product_desc', '$product_image', '$product_keywords')";

		if (mysqli_query($con, $insert_product)) {
			echo "Producto Insertado";
		}else{
			echo "algo fallo";
		}
	}
?>
<html>
<head>
	<title>Insert Product</title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1vxcorfxwa5rh9xzf2s0rw9y67ojibmchq9fs1xrvlfypjfz"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="skyblue">
	<form method="post" action="insert_product.php" enctype="multipart/form-data">
		<table align="center" width="1000" border="2" bgcolor="orange">
			<tr>
				<td colspan="8" align="center"><h2>Insert a new product</h2></td>
			</tr>

			<tr>
				<th align="right">Product title</th>
				<td>
					<input type="text" name="product_title" size="80" required>
				</td>
			</tr>
			<tr>
				<th align="right">Product cat</th>
				<td>
					<select name="product_cat" id="">
						<?php 
						$get_cats = "SELECT * FROM `categories` order by cat_title";

						$run_cats = mysqli_query($con, $get_cats);

						while ($rows_cats = mysqli_fetch_array($run_cats)) {

							$cat_id = $rows_cats['cat_id'];
							$cat_title = $rows_cats['cat_title'];

							printf('<option value="%s">%s</option>', $cat_id, $cat_title);
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th align="right">Product brand</th>
				<td>
					<select name="product_brand" id="">
						<?php 
						$get_brands = "SELECT * FROM `brands` order by brand_title";

						$run_brands = mysqli_query($con, $get_brands);

						while ($rows_brands = mysqli_fetch_array($run_brands)) {

							$brand_id = $rows_brands['brand_id'];
							$brand_title = $rows_brands['brand_title'];

							printf('<option value="%s">%s</option>', $brand_id, $brand_title);
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th align="right">Product price</th>
				<td>
					<input type="text" name="product_price" required>
				</td>
			</tr>
			<tr>
				<th align="right">Product description</th>
				<td>
					<textarea name="product_desc" id="" cols="40" rows="5" ></textarea>
				</td>
			</tr>
			<tr>
				<th align="right">Product image</th>
				<td>
					<input type="file" accept="image/*" name="product_image" required>
				</td>
			</tr>
			<tr>
				<th align="right">Product keywords</th>
				<td>
					<input type="text" name="product_keywords" size="60" required>
				</td>
			</tr>
			<tr align="center">
				<td colspan="8">
					<input type="submit" name="insert_post" value="Insert Now">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>