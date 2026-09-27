<?php

	$con=mysqli_connect("localhost", "root", "");
	mysqli_select_db($con,"u418500350_sensor_data");
	if (!$con) {
		echo "Connection failed: " . mysqli_connect_error();
	}else{
		echo "koneksi berhasil";
	}
	
?>