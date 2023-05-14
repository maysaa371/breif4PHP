<?php
	$conn = new mysqli("localhost","root","","jewelry_db2");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>