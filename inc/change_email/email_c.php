<?php
include '../../config.php';
session_start();
$con = new PDO('sqlite:../../'.$dbloc);
$email = htmlspecialchars($_POST['email']);
$user = $_SESSION['nume'];
$_SESSION['email'] = $email;
$up = "UPDATE $usr SET Email = :email Where $usrname = :user";
$c = $con->prepare($up);
$c->bindParam(':email', $email, PDO::PARAM_STR);
$c->bindParam(':user', $user, PDO::PARAM_STR);
$c->execute();
header("Location: ../../index.php?o=change_email&s=New Email ");

?>