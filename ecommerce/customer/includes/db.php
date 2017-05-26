<?php
	$con = @mysqli_connect('localhost', 'root', '', 'ecommerce');
	
	if (mysqli_connect_errno()) {
		echo "Error en la conexiona la base de datos ".mysqli_connect_error();
	}