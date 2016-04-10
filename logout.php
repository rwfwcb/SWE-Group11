<?php session_start(); ?>
<?php
	if(!session_start()) {		
		$errorMessage = "Unable to start session.";
		$contentURL = "error_info.php";
		require "pstructure.php";
		exit;	
	}
	
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', 1,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	session_destroy();
	
	header("Location: index-dale.php");
	exit;
?>