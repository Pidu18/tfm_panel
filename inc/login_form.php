<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="styles/login.css">
</head>
<body>
	<header><a href="#"><?php echo $name; ?> Panel</a></header>
     <form action="a.php" method="post">
	<input type="text" name="un" placeholder="Username" required><br>
	<input type="password" name="pw" placeholder="Password" required><br>
	<input type="submit" name="submit" value="Login">
</form>
</body>
</html>