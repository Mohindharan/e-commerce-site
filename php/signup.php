<?php
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>signup form</title>
</head>

<body>
<form action="" method="post">
<label for="user">Username:</label>
<input id="username" name="username" type="text" placeholder="username" /><span><?php echo $username_error; ?></span>
<label for="password">password:</label>
<input id="password" name="password" type="password"  placeholder="password"/>
<label for="cpassword">confirm password:</label>
<input id="cpassword" name="c_password" type="password"  placeholder="type again "/><span><?php echo $password_error; ?></span>
<label for="email">email:</label>
<input id="email" name="email" placeholder="email" type="email" /><span><?php echo $email_error; ?></span>
<input type="submit" value="submit" />
 </form>

</body>
</html>