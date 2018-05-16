<?php
include '../../config.php';
session_start();
$con = new PDO('sqlite:../../'.$dbloc);
$a = $_GET['p1'];
$b = $_GET['p2'];
$c = $_GET['np'];
$_SESSION['a'] = $_GET['a'];
if($a == $b){
	$user = $_SESSION['nume'];
	$s = "SELECT * FROM $usr WHERE $usrname = '$user'";
	$x = $con->prepare($s);
	$x->execute();
	$row = $x->fetch(PDO::FETCH_ASSOC);
	if ($row == 0){
		header("Location: ../../index.php?o=change_pass&s=Password not match");
	}else{
		if($a == $row['Password']){	
	    $user = $_SESSION['nume'];
	    $up = "UPDATE $usr SET $pwdu = :pw WHERE $usrname = :name";
	    $r = $con->prepare($up);
	    $r->bindParam(':pw', $c, PDO::PARAM_STR);
	    $r->bindParam(':name', $user, PDO::PARAM_STR);  
	    $r->execute();
	    header("Location: ../../index.php?o=change_pass&s=Password changed to ");
	}else{
        header("Location: ../../index.php?o=change_pass&s=Password not match");
	}
	}
}else{
	header("Location: ../../index.php?o=change_pass&s=Password not match");
}