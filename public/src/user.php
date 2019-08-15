<?php  
	session_start();
	
	if (isset($_SESSION)) {
		if( array_key_exists("connected", $_SESSION) && $_SESSION['connected']){
			include "../templates/user_tpl.php";
		}
	}
?>