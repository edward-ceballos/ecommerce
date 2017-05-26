<?php
session_start();
include 'includes/db.php';
include 'includes/img.php';


//get ip address

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

//craeting shopping cart 

function cart(){

	if (isset($_GET['add_cart'])) {

		global $con;

		$ip = getIP();

		$pro_id = $_GET['add_cart'];

		$check_pro = "SELECT * FROM `cart` WHERE `ip_add` = '$ip' AND `p_id` = '$pro_id'";

		$run_check = mysqli_query($con, $check_pro);
		if (mysqli_num_rows($run_check) > 0) {
			$insert_pro = "UPDATE  `cart` SET  `qty` = `qty` + 1  WHERE `p_id` =  '$pro_id'";

			if (mysqli_query($con, $insert_pro)) {
				// echo "<script>alert('Producto Insertado')</script>";
				header('Location: index.php'); exit;

			}
			else{
				echo "<script>alert('Algo fallo')</script>";
			}
		}
		else{
			$insert_pro = "INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES ('$pro_id', '$ip', 1)";

			if (mysqli_query($con, $insert_pro)) {
				// echo "<script>alert('Producto Insertado')</script>";
				header('Location: index.php'); exit;

			}
			else{
				echo "<script>alert('Algo fallo')</script>";
			}

		}
	}
}


// get total items
function total_items(){
	global $con;
	$count_items = 0;
	// if (isset($_GET['add_cart'])) {

	// 	$ip = getIP();

	// 	$pro_id = $_GET['add_cart'];

	// 	$get_items = "SELECT * FROM `cart` WHERE `ip_add` = '$ip'";

	// 	$run_items = mysqli_query($con, $get_items);

	// 	$count_items = mysqli_num_rows($run_items);

	// }
	// else{
		$ip = getIP();

		$get_items = "SELECT * FROM `cart` WHERE `ip_add` = '$ip'";

		$run_items = mysqli_query($con, $get_items);

		
		if (mysqli_num_rows($run_items)) {
			while ($rows_items = mysqli_fetch_array($run_items)) {
				$count_items += $rows_items['qty'];
			}
		}
	// }
	echo $count_items;
}

// get total price
function total_price(){
	global $con;

	$ip = getIP();

	$sel_price = "SELECT * FROM `cart` join `products` on `cart`.`p_id` = `products`.`product_id`  WHERE `ip_add` = '$ip'";

	$run_price = mysqli_query($con, $sel_price);
	$total = 0;
	if (mysqli_num_rows($run_price)) {
		while ($rows_cats = mysqli_fetch_array($run_price)) {
			// $total += $rows_cats['product_price'];
			$product_price = $rows_cats['product_price'];	
			$qty = $rows_cats['qty'];

			$total += ($product_price * $qty);
		}
	}
	echo number_format($total);
}



// get categories

function getCats(){
	global $con;

	$get_cats = "SELECT * FROM `categories`";

	$run_cats = mysqli_query($con, $get_cats);

	while ($rows_cats = mysqli_fetch_array($run_cats)) {

		$cat_id = $rows_cats['cat_id'];
		$cat_title = $rows_cats['cat_title'];

		printf('<li><a href="index.php?cat=%s">%s</a></li>', $cat_id, $cat_title);
	}
}

// get brands

function getBrands(){
	global $con;

	$get_brands = "SELECT * FROM `brands`";

	$run_brands = mysqli_query($con, $get_brands);

	while ($rows_brands = mysqli_fetch_array($run_brands)) {

		$brand_id = $rows_brands['brand_id'];
		$brand_title = $rows_brands['brand_title'];

		printf('<li><a href="index.php?brand=%s">%s</a></li>', $brand_id, $brand_title);
	}
}

// get products

function getproducts(){
	global $con;

	if (isset($_GET['cat'])) {
		$cat = $_GET['cat'];
		$get_products = "SELECT * FROM `products` WHERE `product_cat` = $cat order by RAND() limit 0, 6";
		$message = '<p>No product add white the cat</p>';
	}
	elseif(isset($_GET['brand'])){
		$brand = $_GET['brand'];
		$get_products = "SELECT * FROM `products` WHERE `product_brand` = $brand order by RAND() limit 0, 6";
		$message = '<p>No product add wiht the brand</p>';
	}
	else{
		$get_products = "SELECT * FROM `products` order by RAND() limit 0, 6";
		$message = '<p>No product add</p>';
	}

	$run_products = mysqli_query($con, $get_products);
	if (mysqli_num_rows($run_products) > 0) {
		while ($rows_products = mysqli_fetch_array($run_products)) {

			$product_id = $rows_products['product_id'];
			$product_title = $rows_products['product_title'];
			$product_cat = $rows_products['product_cat'];
			$product_brand = $rows_products['product_brand'];	
			$product_price = $rows_products['product_price'];	
			$product_desc = $rows_products['product_desc'];
			$product_keywords = $rows_products['product_keywords'];
			$product_image = $rows_products['product_image'];
			$product_image = imgCrop('admin_area/product_images/'.$product_image, 180, 180);
			
			
			echo "
			<div class='single_product'>
				<h3>$product_title</h3>
				<a href='details.php?pro_id=$product_id'>
					<img src='$product_image' alt='' height='180' width='180'>
				</a>
				<p>US$. $product_price</p>
				<a href='details.php?pro_id=$product_id' style='float: left;'>Details</a>
				<a href='index.php?add_cart=$product_id' style='float: right;'><button>Add to Cart</button></a>
			</div>
			";

		}
	}else{
		echo($message);
	}
}