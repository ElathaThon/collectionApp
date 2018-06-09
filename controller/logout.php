<?php 

session_start();

if ($_SESSION['logged_in'] == 1) {
	session_destroy();
}


$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = '../index.php';  // change accordingly

header("Location: http://$host$uri/$extra");

?>