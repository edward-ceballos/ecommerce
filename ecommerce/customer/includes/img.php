<?php
function imgMedium($filename){
	$ext = explode('.', $filename);
	$name = $ext[0];
	$ext = end($ext);
	$ext = strtolower($ext);

	$newfilename = $name . '-medium.' . $ext;
	if (file_exists($newfilename)) {
		return $newfilename;
	}else{
		$porcentaje = 0.5;

		list($width, $height) = getimagesize($filename);
		$new_width = $width * $porcentaje;
		$new_height = $height * $porcentaje;

		$path_parts = pathinfo($filename);
		if ($path_parts['extension'] == 'jpg') {
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagejpeg($image_p, $newfilename, 50);
		} 
		elseif ($path_parts['extension'] == 'gif') {
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromgif($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif($image_p, $newfilename);
		} 
		elseif ($path_parts['extension'] == 'png') {
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefrompng($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagepng($image_p, $newfilename, 8, PNG_ALL_FILTERS);
		} 
		else {
			echo "Source file is not a supported image file type.";
		}
	}
	return $newfilename;
}


function imgCrop($filename, $thumb_width = 150, $thumb_height = 150){
	$path_parts = pathinfo($filename);
	if ($path_parts['extension'] == 'jpg') {
		$image = imagecreatefromjpeg($filename);
	}
	elseif ($path_parts['extension'] == 'gif') {
		$image = imagecreatefromgif($filename);
	}
	elseif ($path_parts['extension'] == 'png') {
		$image = imagecreatefrompng($filename);
	}
	else{
		return 'imagen no soportada';
	}
	$width = imagesx($image);
	$height = imagesy($image);
	$name = $path_parts['dirname'].'/'.$path_parts['filename'];
	$newfilename = $name .'-'.$thumb_width.'x'.$thumb_height.'.'. $path_parts['extension'];

	if (file_exists($newfilename)) {
		return $newfilename;
	}
	else{
		$original_aspect = $width / $height;
		$thumb_aspect = $thumb_width / $thumb_height;

		if ( $original_aspect >= $thumb_aspect ){
	   		// Si la imagen es más ancha que la miniatura (en sentido de relación de aspecto)
			$new_height = $thumb_height;
			$new_width = $width / ($height / $thumb_height);
		}
		else{
	   		// Si la imagen en miniatura es más ancha que la imagen
			$new_width = $thumb_width;
			$new_height = $height / ($width / $thumb_width);
		}

		$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

		// Redimensionar y recortar
		imagecopyresampled($thumb,
			$image,
	                   0 - ($new_width - $thumb_width) / 2, // Centrar la imagen horizontalmente

	                   0 - ($new_height - $thumb_height) / 2, // Centrar la imagen verticalmente

	                   0, 0,
	                   $new_width, $new_height,
	                   $width, $height);

		if ($path_parts['extension'] == 'jpg') {
			imagejpeg($thumb, $newfilename, 50);
		}
		elseif ($path_parts['extension'] == 'gif') {
			imagegif($thumb, $newfilename);
		}
		elseif ($path_parts['extension'] == 'png') {
			imagepng($thumb, $newfilename, 8, PNG_ALL_FILTERS);
		}
		else{
			return 'imagen no soportada';
		}

		return $newfilename;
	}
}
