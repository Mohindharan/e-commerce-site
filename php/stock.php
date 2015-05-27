<?php
session_start();

if(empty($_SESSION["user_id"])) {
header("Location:../");
}
if($_SESSION["admin"]==false){
	header("Location:stock.php");
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
	$pa=$pa1+$pa2;
	$sqlq = "UPDATE items SET quantity='$pa' WHERE item='$na'";

mysqli_query($con,$sqlq);
	}
	
}


if(isset($_POST['submit'])){
if(isset($_POST["item"],$_POST["quantity"])){
$name=$_POST["item"];
$qt=$_POST["quantity"];
$category=$_POST["category"];
$sql= "SELECT quantity FROM items WHERE item='$name' ";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
$price=$_POST["price"];
if($_FILES["pic"]["name"]==''){
	
$imgrc ="dummy.jpg";
}
else
$imgrc =$_FILES["pic"]["name"];

$imgstr="../img/uploads/". basename($imgrc);
move_uploaded_file($_FILES["pic"]["tmp_name"],$imgstr);

if($count==1){
	$pa1=$row["quantity"];
	$pa=$pa1+$qt;
	$sqlq = "UPDATE items SET quantity='$pa' WHERE item='$name'";
	mysqli_query($con,$sqlq);
	}
else{
$sqlq = "INSERT INTO items (item,quantity,img,category,price) VALUES('$name','$qt','$imgstr','$category','$price')";
mysqli_query($con,$sqlq);
}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock your Inventory</title>
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
	<form action="stock.php" method="post" enctype="multipart/form-data">
	<h3 class="monkeyjump"></h3> 
	<div class="cross btn-danger btn">
	<span class="left-bar bar"></span>
	<span class="right-bar bar"></span>
	</div>
	<input type="text" class="formname" name="add-name" id="dummy" name="add-item" >
    <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="add-qty"   placeholder="Quantity" min="1">
	</div>
	<button type="submit" class=" popaddbt btn btn-success" name="submit"  value="Submit">Submit</button>
  
	</form>
</div>
<nav>
<ul class="navigation">
<li class="tag title" ><a href="#">Company</a></li>
<a href="stock.php"><li class="tag bin">Stocking</li></a>
<a href="stats.php"><li class="tag bin">Stats</li></a>
<a href="logout.php"><li class="tag last">Logout</li></a>
</ul>

</nav>

<div class="newitem">
	
 <form action="stock.php" method="post" enctype="multipart/form-data">
	 <h1 style="text-align:center">New item </h1>
      
      <div class="cross btn-danger  x btn">
	<span class="left-bar bar"></span>
	<span class="right-bar bar"></span>
	</div>
        <div class="form-group">
            <label for="item">Name of the item</label>
            <input type="text"  name="item"class="form-control"  required="required" id="item" placeholder="Item Name ">
        </div>
      <div class="form-group">
            <label for="pic">Thumbnail</label>
            <input type="file" id="pic" name="pic" value="upload image" />
            </div> 
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" min="0" class="form-control"  value="0" name="quantity" id="quantity"  placeholder="Quantity">
        </div>
        <div class="form-group">
          <label for="category">Category</label>
           <select id="category"  name="category" class="form-control">
              <option  value="Milk">Milk-products</option>
              <option value="Fruits">Fruits</option>
              <option value="Pastry">Pastry</option>
              <option value="Meal">Meal</option>
              <option value="Snacks">Snacks</option>
               <option selected="selected" value="Others">Others</option>
            </select>
        </div>
         <div class="form-group">
            <label for="price">Price Per Unit</label>
            <input type="number" min="0" class="form-control"   name="price" id="price"  placeholder="price per unit">
        </div>
       
        <button type="submit" class="btn btn-success" name="submit"  value="Submit">Submit</button>
    </form>
</div>
<?php 
include("sql_query.php");
?>
<div class="container">
<b><h1>All Stocking</h1></b>
<div class="row">
<?php
echo $data;
if($data!=""){
echo'<div class="col-md-3 box btn-primary loadmore ">  
<h2>Load more >>></h2></div>';}
?>  
</div>
<b><h1>Stock at minimum </h1></b>
<div class="row">
<?php
		$query = "select * from items WHERE quantity<6";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		$data = '';
		if($count>0)
		{
			while($row =mysqli_fetch_array($result))
			{
				$id = $row['id'];
				$feed = $row['item'];
				$qty=$row['quantity'];
				$data = $data.'<div class="col-md-3 box btn-default"  onclick="addpop(\''.$row["id"].'\',\''.$row["item"].'\')" >
		<img src='.$row["img"].' class="img-circle box-thumb"/>
		<h3 class="box-name"> '.$row["item"].'</h3>
		<h4 class="qt"> Quantity</h2><h3 class="box-qty ">'.$row["quantity"].'
		</h3>
</div>

';
			}
		}
		else{
				echo '<blockquote> No products at this Section. </blockquote>';
		}
		echo $data;
?>
</div>

<b><h1>Out Of Stock</h1></b>
<div class="row">
<?php
		$query = "select * from items WHERE quantity=0";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		$data = '';
		if($count>0)
		{
			while($row =mysqli_fetch_array($result))
			{
				$id = $row['id'];
				$feed = $row['item'];
				$data = $data.'<div class="col-md-3 box btn-default"  onclick="addpop(\''.$row["id"].'\',\''.$row["item"].'\')" >
		<img src='.$row["img"].' class="img-circle box-thumb"/>
		<h3 class="box-name"> '.$row["item"].'</h3>
		<h4 class="qt"> Quantity</h2><h3 class="box-qty ">'.$row["quantity"].'
		</h3>
</div>

';
			}
			$data=$data.'<div class="final" val="'.$id.'" ></div>';
		}
		else{
					echo '<blockquote> No products at this Section. </blockquote>';
		}
		echo $data;
?>
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

<b><h1>Milk-Products</h1></b>
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

<div>
 <a href="#" class="btn bn btn-info btn-lg">+ New Item</a>
</div>
<script>
$(document).ready(function(){
	$(".bn").on("click",function(){
		$(".newitem").toggleClass("activepop");
		
		});
			$(".x").on("click",function(){
		$(".newitem").toggleClass("activepop");
		
		});
$(".cross").on("click",function(){
	
	$(".add-pop").hide("slow");
	$(".popgrey").css("display","none"); 
	});	

});



function addpop(data,mac){
	
	 $(".add-pop").addClass(data,item);
	$(".popgrey").css("display","block"); 
	$("."+data).show("slow");
	$(".monkeyjump").html(mac);
		$("#dummy").attr("value",mac);
	}
		

</script>
<script>
		$(function(){
				$('.loadmore').click(function(){
					var val = $('.final').attr('val');
					$.post('sql_query.php',{'from':val},function(data){
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