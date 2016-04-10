<?php
	// Attempt to start/resume the session
	if(!session_start()) {
		// If unable, error
		$errorMessage = "Unable to start session.";
		$contentURL = "error_info.php";
		require "pstructure.php";
		exit;
	}
	
	// Find out if the user is logged in
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	// URL to the home page content
	$contentURL = "home.php";
	
	$id = empty($_GET['id']) ? "home" : $_GET['id'];
	
	$contentURL = $id . ".php";
	require "pstructure.php";
?>