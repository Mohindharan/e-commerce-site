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
if(isset($_POST["add-qty"]))
{
	
	$pa1=$_POST["add-qty"];
	$na=$_POST["add-name"];
	$sql= "SELECT quantity FROM items WHERE item='$na' ";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$pa2=$row["quantity"];
	$pa=$pa2-$pa1;

	$sqlq = "UPDATE items SET quantity='$pa' WHERE item='$na'";

mysqli_query($con,$sqlq);
	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>
<link rel="stylesheet" type="text/css" href="../css/stock.css" />
<script src="../include/jquery.min.js"></script>
<link rel="stylesheet" href="../include/bootstrap.min.css">
<script src="../include/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="../css/nav.css" />
<link rel="stylesheet" href="../include/bootstrap-theme.min.css">

</head>

<body>
<div class="popgrey"></div>
<div class="add-pop">	
	<form action="cart.php" method="get" enctype="multipart/form-data">
	<h3 class="monkeyjump"></h3> 
	<div class="cross btn-danger btn">
	<span class="left-bar bar"></span>
	<span class="right-bar bar"></span>
	</div>
<input type="text" class="formname" name="id" id="dummy"  name="add-item" >
	<input type="text" class="formname" name="action" value="add" >
    <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="qty"   id="mike"   placeholder="Quantity" min="1">
   </div>
  <button type="submit" class=" popaddbt btn btn-success" >AddToCart</button>
  
</form>
</div>
<nav>
<ul class="navigation">
<li class="tag title" ><a href="#">Company</a></li>
<a href="use.php"><li class="tag">Use</li></a>
<a href="logout.php"><li class="tag last">Logout</li></a>
<a href="cart.php"><li class="tag last">Cart (<?php $mo=$_SESSION["i"];echo $mo;  ?>)</li></a>


</ul>

</nav>

<div class="newitem">
	

</div>
<div class="container">
<div class="row">
<b><h1>All Products</h1></b>
<?php 
include("sub_query.php");
 echo $data;
?>  
<div class="col-md-3 box btn-primary loadmore ">  
<h2>Load more >>></h2></div>
</div>

<b><h1>Fruits</h1></b>
<div class="row">
<?php 

$data=$obj->prequery("0","7","Fruits");
echo $data;
?>  
</div>

<b><h1>Pastry</h1></b>
<div class="row">
<?php 

$data=$obj->prequery("0","7","Pastry");
echo $data;
?>  
</div>

<b><h1>Meals</h1></b>
<div class="row">
<?php 

$data=$obj->prequery("0","7","Meal");
echo $data;
?>  
</div>
<b><h1>Milk-products</h1></b>
<div class="row">
<?php 

$data=$obj->prequery("0","7","Milk");
echo $data;
?>  
</div>
<b><h1>Others</h1></b>
<div class="row">
<?php 

$data=$obj->prequery("0","7","Others");
echo $data;
?>  
</div>
</div>
<div class="cart"></div>
<script>
$(document).ready(function(){
	$(".cross").on("click",function(){
	
	$(".add-pop").hide("slow");
	$(".popgrey").css("display","none"); 
	
	});	

});




function addpop(data,mac,peak){
	 $(".add-pop").addClass(data);
	$(".popgrey").css("display","block"); 
	$("."+data).show("slow");
	$(".monkeyjump").html(mac);
	$("#dummy").attr("value",mac);
	$("#mike").attr("max",peak);
	}
		

		
		
$(function(){
				$('.loadmore').click(function(){
					var val = $('.final').attr('val');
					$.post('sub_query.php',{'from':val},function(data){
						if(!isFinite(data))
						{
							$('.final').remove();
							$(data).insertBefore('.loadmore');
						}
						else
						{
							
							$('.loadmore').remove();
						}	
							
					});
				});
		});	
</script>
</body>
</html>