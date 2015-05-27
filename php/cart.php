 <?php
session_start();
if(empty($_SESSION["user_id"])) {
header("Location:use.php");
}
include("conx.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
}
else{
	$id=0;
	}

if(isset($_GET["action"]))
{
	$m=$_GET["action"];

	
	switch($m)
	{
		case "empty":
		unset($_SESSION["cart"]);
		$_SESSION["i"]=0;
				
		header("location:use.php");
		break;
		
		
		case "add":
		$_SESSION["cart"][$id]=0;
		if(isset($_SESSION["cart"][$id]))
		$_SESSION["cart"][$id]=$_SESSION["cart"][$id]+$_GET["qty"];
		
			$_SESSION["i"]=$_SESSION["i"]+1;
		break;
		
		case "remove":
		if(isset($_SESSION["cart"][$id]))
			if(isset($_GET["qty"])){
			$_SESSION["cart"][$id]=$_SESSION["cart"][$id]-$_GET["qty"];
			}
			else
			$_SESSION["cart"][$id]--;
		else
		{
			if($_SESSION["cart"][$id]==0)
			{
				$_SESSION["cart"][$id]=1;
			}
			else
			{
				unset($_SESSION["cart"][$id]);
			}
		}
		break;
	
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<link rel="stylesheet" type="text/css" href="../css/stock.css" />
<script src="../include/jquery.min.js"></script>
<link rel="stylesheet" href="../include/bootstrap.min.css">
<script src="../include/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="../css/nav.css" />
<link rel="stylesheet" href="../include/bootstrap-theme.min.css">

</head>

<body>

<div class="popgrey"></div>
<nav>
<ul class="navigation">
<li class="tag title" ><a href="#">Company</a></li>
<a href="use.php"><li class="tag">Use</li></a>
<a href="logout.php"><li class="tag last">Logout</li></a>
</ul>
</nav>
<style>
.container-cart{
	margin-top:10px;
	margin-left:10%;
	margin-right:10%;
	width:80%;
	height:100%;
	position:absolute;
	padding:0;
	box-shadow:6px 1px 20px #999999;
	}
</style>
<div class="container-cart">
<div class="page-header"  style="background-color:#FFF !important; margin-top:0 !important;margin-bottom:0 !important; border-radius:5px; padding-top:20px">

<h1 class="headw" style="margin-top:0">Company Name.co </h1></div>
<h3 style="padding-left:30px;" class="page-header">172/2 Dubai kuruku sandhuu<br/>Dubai Main Road<br/>Dubai</h3><h3 style="
  position:absolute !important;float:right !important; right:80px; top:100px; ">Ph-0454454584</h3>


<div class="row" style="background-color:#CCC !important; margin-top:0 !important" >
<div class="col-md-2 col"><h3>S.No</h3></div>
<div class="col-md-1 col"></div>
<div class="col-md-5 col itm"><h3>Items</h3></div>
<div class="col-md-2 col"><h3>Qty</h3></div>
<div class="col-md-2 col"><h3>Price</h3></div>
</div>
<?php 
if(isset($_SESSION["cart"]))
{	$i=1;
	$total=0;
	include("conx.php");
	foreach($_SESSION["cart"] as $id =>$x)
	{
		
	$sql= "SELECT * FROM items WHERE item='$id'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$line=$row["price"]*$x;
	$img=$row["img"];	
	echo '
	<div class="row" >
	<div class="col-md-2 col"><h3>'.$i.'</h3></div>
	<div class="col-md-1  img col"></div>
	<div class="col-md-1 img col"><img src="'.$img.'"></img></div>
	<div class="col-md-4  cols col"><h3>'.$row["item"].'</h3></div>
	<div class="col-md-2 col"><h3>'.$x.'</h3></div>
	<div class="col-md-2 col"><h3>'.$line.'</h3></div></div>';		
	$i++;
	$total=$line+$total;
		}
		echo'<div class="row" class="into">
	<div class="col-md-2 col"><h3></div>
	<div class="col-md-6 col col6"></div>
	<div class="col-md-2 col"><h3>Total</h3></div>
	<div class="col-md-2 col" ><h3>'.$total.'</h3></div></div>';
		
		
}
$_SESSION["total"]=$total;
if($_SESSION["i"]==-1)
$_SESSION["i"]=0;
else if($_SESSION["i"]==0)
{}else
$_SESSION["i"]=$i-1;
if(isset($_GET["action"]))
{
header("location:use.php");	
	}

?>
</div>
<a href="use.php"><button style="left:-50px;" class="btn img  btn-danger bt"><h3><  continue shopping</h3></button></a>
<button style="right:50px;" class=" img btn btn-primary bt bt1"><h3>Buy Now > </h3></button>
	<div class="lap img">
    <form action="customer.php" method="post" enctype="multipart/form-data">
	<h3 class="monkeyjump">Customer Details</h3> 
	<div class="cross btn-danger btn">
	<span class="left-bar bar"></span>
	<span class="right-bar bar"></span>
	</div>
      <div class="form-group img">
   <label for="cname">Customer name </label>
	<input type="text"  class="form-control" name="cname"  name="cname" placeholder="customer name" >
    <div class="form-group">
   <label for="cnum">phone no.</label>
   <input type="number" class="form-control" id="cnum" name="cnum"   placeholder="Phone no" min="1000000000">
   </div>
  <button type="submit" class=" popaddbt btn btn-success bt2" name="submit"  value="Submit">Submit</button>
  </div>

<script>
$(document).ready(function() {
    
$(".cross").on("click",function(){
$(".lap").css("display","none");

});
$(".bt1").on("click",function(){
$(".lap").css("display","block");

});
$(".bt2").on("click",function(){
	$("nav").css("display","none");
	$(".col").css("float","left");
	$(".col").css("padding-right","60px");
	$(".cols").removeClass("col-md-4");
	$(".cols").css("margin-right","70px");
	$(".cols").css("margin-left","90px");
	$(".itm").css("margin-left","-20px");
	$(".img").css("display","none");
	
	$(".container-cart").css("margin","0");
	$(".container-cart").css("width","100%");
	 
	 		$("*").css("position","static");

    window.print();
	$(location).attr('href',"buynow.php");

	});
	});

</script>


</body>
</html>