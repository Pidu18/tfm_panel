
<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['nume'])){
  include 'inc/login_form.php';
}elseif (isset($_SESSION['nume'])){
	    include 'inc/home.php';
}

