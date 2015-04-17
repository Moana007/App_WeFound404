<?php 

if ($session){
	$helper->getLogoutUrl($session, $next);	
}
session_start();
session_unset();
session_destroy();
header("location:index.php");

?>