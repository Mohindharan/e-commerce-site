<?php
$error="";

if(isset($_SESSION["user_id"])){
}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>

<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<div class="wrapper">
	<div class="container">
		<h1>Welcome</h1> 
<form class="form" action="php/login.php" method="post">

<input id="name" name="username" placeholder="username" type="text">

<input id="password" name="password" placeholder="Password" type="password">
<input name="submit" style="cursor:pointer" type="submit" id="login-button" value=" Login ">

</form>
</div>

	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>

</body>
</html>