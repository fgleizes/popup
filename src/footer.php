<?php 
    if (preg_match('/index.php/', $_SERVER['PHP_SELF'])) {
		$root = "";
	} else {
		$root = "../";
    }
    
    include ($root . "public/templates/footer_tpl.php");
?>