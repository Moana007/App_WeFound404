<?php 

session_start();
session_unset();
session_destroy();

if ($session){
	$helper->getLogoutUrl($session, $next);
	header("location:../index.php");	
}
else {
	header("location:index.php");
}
?>