<?php
	require "../../classes/Database.class.php";
	require "../../classes/User.class.php";

	session_start();

	if (isset($_POST)) {
		if( array_key_exists( "mail", $_POST )
		&& array_key_exists( "password", $_POST )) {
			if( !empty($_POST["mail"])
			&& !empty($_POST["password"]) 
			){
				$user = new user();
				$user->loginUser($_POST);
				header("location: ../../index.php");
			}
		}
	}
	include "../templates/login_tpl.php";
?>