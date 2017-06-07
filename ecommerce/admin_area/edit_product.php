<?php  
@session_start();

if (!isset($_SESSION['user_email'])) {
	header("Location: login.php?no_admin=Your are not an Admin!");
}
?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1vxcorfxwa5rh9xzf2s0rw9y67ojibmchq9fs1xrvlfypjfz"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<?php 
include '../includes/db.php';
include '../includes/img.php';
$id = $_GET['edit_product'];
$get_product = "SELECT * FROM `products` WHERE `product_id` = '$id'";

$run_product = mysqli_query($con, $get_product);
if (mysqli_num_rows($run_product) > 0) {
	$row_product = mysqli_fetch_array($run_product);

	$product_id = $row_product['product_id'];
	$product_title = $row_product['product_title'];
	$product_cat = $row_product['product_cat'];
	$product_brand = $row_product['product_brand'];	
	$product_price = $row_product['product_price'];	
	$product_desc = $row_product['product_desc'];
	$product_keywords = $row_product['product_keywords'];
	$product_image = $row_product['product_image'];
	$image = $product_image;
	$product_image = imgCrop('product_images/'.$product_image, 180, 180);
	

}

?>

<form method="post" action="" enctype="multipart/form-data">
	<table align="center" width="795" border="2" bgcolor="white">
		<tr>
			<td colspan="8" align="center"><h2>Edit product</h2></td>
		</tr>

		<tr>
			<th align="right">Product title</th>
			<td>
				<input type="text" name="product_title" size="80" required value="<?php echo $product_title ?>">
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
						if ($cat_id == $product_cat) {
							printf('<option value="%s" selected>%s</option>', $cat_id, $cat_title);
						}else{
							printf('<option value="%s">%s</option>', $cat_id, $cat_title);
						}
						
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

						if ($brand_id == $product_brand) {
							printf('<option value="%s" selected>%s</option>', $brand_id, $brand_title);
						}else{
							printf('<option value="%s">%s</option>', $brand_id, $brand_title);
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th align="right">Product price</th>
			<td>
				<input type="text" name="product_price" required value="<?php echo $product_price ?>">
			</td>
		</tr>
		<tr>
			<th align="right">Product image</th>
			<td>
				<input type="file" accept="image/*" name="product_image" onchange="readURL(this);">
				<img id="img" src="<?php echo $product_image ?>" alt="<?php echo $product_title ?>" width="100">
			</td>
		</tr>
		<tr>
			<th align="right">Product description</th>
			<td>
				<textarea name="product_desc" id="" cols="40" rows="5" ><?php echo $product_desc ?></textarea>
			</td>
		</tr>
		<tr>
			<th align="right">Product keywords</th>
			<td>
				<input type="text" name="product_keywords" size="60" required value="<?php echo $product_keywords ?>">
			</td>
		</tr>
		<tr align="center">
			<td colspan="8">
				<input type="submit" name="update_product" value="Update Now">
			</td>
		</tr>
	</table>
</form>
<?php 


if (isset($_POST['update_product'])) {

	//data text
	$product_cat = $_POST['product_cat'];
	$product_brand = $_POST['product_brand'];
	$product_title = $_POST['product_title'];	
	$product_price = $_POST['product_price'];	
	$product_desc = $_POST['product_desc'];
	$product_keywords = $_POST['product_keywords'];

	//data image
	// $product_image = $_FILES['product_image']['name'];
	// $product_image_tmp = $_FILES['product_image']['tmp_name'];
	// $filename = "product_images/$product_image";
	// if (move_uploaded_file($product_image_tmp, $filename)) {
	// 	imgCrop($filename, 180, 180);
	// }

	if ($_FILES['product_image']['name'] != NULL) {
		$product_image_tmp =  $_FILES['product_image']['tmp_name'];
		$product_image = $_FILES['product_image']['name'];
		$filename = "product_images/$product_image";

		if (!file_exists($filename)) {
			if (move_uploaded_file($product_image_tmp, $filename)) {					
				imgCrop($filename, 100, 100);
			}
		}
	}else{
		$product_image = $image;
	}


	$edit_product = "UPDATE `products` SET `product_cat`= '$product_cat',`product_brand`= '$product_brand',`product_title`= '$product_title',`product_price`= '$product_price',`product_desc`= '$product_desc',`product_image`= '$product_image',`product_keywords`= '$product_keywords' WHERE `product_id` = '$id'";

	if (mysqli_query($con, $edit_product)) {
		echo "<script>alert('The product will be update');</script>";
		echo "<script>window.open('?view_products', '_self');</script>";
	}else{
		echo "<script>alert('The saved failed');</script>";
		echo "<script>window.open('?edit_product, '_self');</script>";
	}
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>