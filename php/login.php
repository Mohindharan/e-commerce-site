<?php
session_start();
$error="";

$db_password="";
if (isset($_POST['submit'])) {
			if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
			}
			else
			{
			include "conx.php";
	
			$username=$_POST["username"];
			$password=$_POST["password"];

			$query="SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result =mysqli_query($con,$query);
			$row=mysqli_fetch_assoc($result);
				$db_username=$row['username'];
				$db_password=$row['password'];
				$db_admin=$row['admin'];
				if($db_username==$username&&$db_password==$password){
			
				if($db_admin==1){
				$_SESSION["user_id"] = $row['username'];

				$_SESSION["admin"]=true;
				header("location:stock.php");
				}
				else{
				$_SESSION["user_id"] = $row['username'];
				$_SESSION["i"]=0;
				$_SESSION["admin"]=false;
				header("location:use.php");
					}
				}
				else{
					
					$error="invalid user";

					}
				
			
			}
}
?>
