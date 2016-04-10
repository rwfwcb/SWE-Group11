<?php session_start(); ?>
<?php
/*	// Make sure the form is served using HTTPS
	if ($_SERVER['HTTPS'] !== 'on') {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURL");
		exit;
	} */
	
	// Attempt to start/resume the session
	if(!session_start()) {
		$errorMessage = "Unable to start session.";
		$contentURL = "error_info.php";
		require "pstructure.php";
		exit;
	}
	
	// If the user is logged in, redirect them home
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	if ($loggedIn) {
		header("Location: index-dale.php");
		exit;
	}
	
    $username = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];

    if ($username == "test" && $password == "pass") {
        $_SESSION['loggedin'] = $username;
        $error = "";
        header("Location: index-dale.php");
        exit;
    } else {
        $error = 'Login failed.  Please enter your username and password.';
        $contentURL = "login-form.php";
        require "pstructure.php";
        echo("<p>This is the part where I want to know what the following are: " . $_POST['username'] . " " . $_POST['password'] . "</p>");
    }
	
	/* function login_form() {
		$username = "";
		$error = "";
		$contentURL = "login-form.php";
		require "pstructure.php";
	} */
?>