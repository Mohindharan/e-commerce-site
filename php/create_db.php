<?php
include "conx.php";

$sql="CREATE TABLE users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		username VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		password VARCHAR(100)
		)";
if(mysqli_query($con,$sql)){
	echo "db users created success ";
	} 
else{
	echo "connection error".$con->error ;
	}
$items="CREATE TABLE items(
		id INT(50 ) UNSIGNED AUTO_INCREAMENT PRIMARY KEY,		
		)";	
	
	
?>