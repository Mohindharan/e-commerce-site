<?php
session_start();
include("conx.php");
if(isset($_SESSION["cart"]))
{
	foreach($_SESSION["cart"] as $id =>$x)
	{
	$sql= "SELECT quantity FROM items WHERE id='$id' ";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$pa2=$row["quantity"];
	$pa=$pa2-$x;
	$sqlq = "UPDATE items SET quantity='$pa' WHERE id='$id'";
	mysqli_query($con,$sqlq);
	}
	if(isset($_SESSION["cname"])){
	$name=$_SESSION["cname"];
	$num=$_SESSION["cnum"];
	$total=$_SESSION["total"];	
	$query="INSERT INTO bill (name,phone,total,date) VALUES ('$name','$num','$total',now())";
	mysqli_query($con,$query);
	
	}
	if($total=="")
	$total=0;
	$sqlo= "SELECT * FROM total ";
	$result=mysqli_query($con,$sqlo);
	$row=mysqli_fetch_assoc($result);
	$pa2=$row["money"];
	$pa=$pa2+$total;
	$sqlqo = "UPDATE total SET money='$pa' WHERE date=NOW()";
	mysqli_query($con,$sqlqo);
	
	header("location:cart.php?action=empty");
}
	
?>