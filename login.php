<?php
	session_start();

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
		header("Location: index.php");
		exit;
	}

    require "db.conf";

    $email = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];

		if ($link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
			$sql = "SELECT id, hashpass FROM Profile WHERE email=?";
			if ($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "s", $email) or die("bind param");
				if(mysqli_stmt_execute($stmt)) {
					mysqli_stmt_bind_result($stmt, $id, $hashpass);
					mysqli_stmt_fetch($stmt);
					if (password_verify($password, $hashpass)){
						echo "<script type='text/javascript'>alert('Login successful!')</script>";
                        $_SESSION['loggedin'] = $email;
                        $_SESSION['error'] = false;
                        $_SESSION['id'] = $id;
                        header("Location: index.php?id=profile");
						//die(header("Location: index.php"));
					}
                    else {
                        echo "<script type='text/javascript'>alert('Login failed.  Please enter your username and password.')</script>";
                        $error = "Username or password incorrect.";
                        header("index.php?id=login-form");
                    }
				} else { echo "<script type='text/javascript'>alert('Failed to execute mySQL statement.')</script>"; }
			} else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
		} else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }

	/* function login_form() {
		$username = "";
		$error = "";
		$contentURL = "login-form.php";
		require "pstructure.php";
	} */
?>
