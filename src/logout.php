<?php
	session_start();
	
	require "../classes/User.class.php";
	
	$user = new user();
	$user->logoutUser();
?>