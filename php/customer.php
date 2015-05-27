<?php
session_start();
if(empty($_SESSION["user_id"])) {
header("Location:../");
}
if($_SESSION["admin"]==true){
	header("Location:use.php");
	}
include("conx.php");
if(isset($_POST['submit'])){
if(isset($_POST["cname"])){
	
	$_SESSION["cname"]=$_POST["cname"];
	$_SESSION["cnum"]=$_POST["cnum"];
	
	
	
	}
}
header("location:buynow.php");
?>