<?php
session_start();

if(empty($_SESSION["user_id"])) {
header("Location:../");
}
if($_SESSION["admin"]==false){
	header("Location:stock.php");
	}
include("conx.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>stats</title>
<link rel="stylesheet" type="text/css" href="../css/stock.css" />
<script src="../include/jquery.min.js"></script>
<link rel="stylesheet" href="../include/bootstrap.min.css">
<script src="../include/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="../css/nav.css" />
<link rel="stylesheet" href="../include/bootstrap-theme.min.css">

</head>

<body>
<nav>
<ul class="navigation">
<li class="tag title" ><a href="#">Company</a></li>
<a href="stock.php"><li class="tag bin">Stocking</li></a>
<a href="stats.php"><li class="tag bin">Stats</li></a>
<a href="logout.php"><li class="tag last">Logout</li></a>
</ul>
</nav>
</body>
<style>
*{
		font:Arial, Helvetica, sans-serif;
		margin:0;
		padding:0;
	}
th{margin:20px !important;}
h2,h3{
	text-align:center;

	}

	
</style>
<div class="container-fluid" style="margin-left:10%; margin-top:10%; padding:0;">
<table border="1" width="80%" cellpadding="10px" background="../img/trans.png" bgcolor="#DFDFDF">
<tr>
<th><h2>ID</h2></th>
<th><h2>Customer name</h2></th>
<th><h2>Phone no</h2></th>
<th><h2>Paid</h2></th>
<th><h2>Date</h2></th>
</tr>
<?php
		$query = "select * from bill";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		$data = '';
		if($count>0)
		{
			while($row =mysqli_fetch_array($result))
			{ 
				$id=$row["id"];
				$name=$row["name"];
				$phone=$row["phone"];
				$total=$row["total"];
				$date=$row["date"];
				echo'
				<tr>
				<td><h3>'.$id.'</h3></td>
				<td><h3>'.$name.'</h3></td>
				<td><h3>'.$phone.'</h3></td>
				<td><h3>Rs '.$total.'</h3></td>
				<td><h3>'.$date.'</h3></td>
				</tr>				
				
				';
			}
		}
?>



</table>
</div>
</html>