<!DOCTYPE html>
<html>
<head>
	<title>Panel - Home</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<header>
		<img src="img/ch.png" alt="Cheeseeeee!!!!">
		<?php
		echo '<a href="#">'.$name.' Panel</a>';
		?>
		<font class="cr"><a href="http://kl-pidu.xyz/" target="_blank">By Pidu</a></font>
	</header>
	<div class="left">
		<div class="lefts"></div>
		<a href="index.php?o=me">Profile</a><br>
		<div class="lefts"></div>
		<a href="index.php?o=change_email">Change Email</a><br>
		<div class="lefts"></div>
		<a href="index.php?o=change_pass">Change Pass</a><br>
		<div class="lefts"></div>
		<a href="index.php?o=t10">Top 10</a><br>
		<div class="lefts"></div>
		<a href="inc/logout.php">Log Out</a><br>
		<div class="lefts"></div>
	</div>
	</div>
	<div class="right">
		<?php
	if (isset($_GET['o'])) {
			if ($_GET['o'] == "me"){
			$user = $_SESSION['nume'];
			$a = "SELECT * FROM $usr WHERE $usrname = '$user'";
			$c = $con->prepare($a);
			$c->execute();
			$row = $c->fetch(PDO::FETCH_ASSOC);
			if ($row == 0){
				session_destroy();
			}else{
				include 'right_op.php';
			}
		}elseif($_GET['o'] == "change_email"){
			include 'inc/ch_email.php';
		}elseif($_GET['o'] == "change_pass"){
			include 'inc/ch_pass.php';

		}elseif($_GET['o'] == "t10"){
			include 'inc/t10.php';

		}else{
			include 'inc/news.php';
		}

	}else{
		include 'inc/news.php';
	}

	?>
	</div>
</body>
</html>