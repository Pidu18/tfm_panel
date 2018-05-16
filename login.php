<?php
session_start();
include 'conn.php';
if (isset($_GET['verify'])) {
	$b = $_GET['verify'];
	$un = $_GET['un'];
	$a = "SELECT * from $usr WHERE $pwdu = '$b' AND $usrname = '$un'";
	$c = $con->prepare($a);
	$c->execute();
	$row = $c->fetch(PDO::FETCH_ASSOC);
	if ($b != $row[$pwdu]){
		header("Location: index.php?login=False");
	}else{
		    $_SESSION['nume'] = $row[$usrname];
		    header("Location: index.php?login=True");
	} 
}