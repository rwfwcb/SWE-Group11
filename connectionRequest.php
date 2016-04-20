<?php
/* start the session */
session_start();

/* make sure user is logged in and session variable is set*/
if(!isset($_SESSION['id'])) {
	header("Location: index.php?id=login-form");
}

/* require credentials! */
require "db.conf";

/* connect to database */
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

/* check connection */
if (!$link){
		printf("Connect failed: %s\n", mysqli_connect_error());
}

$id1 = $_POST['id1'];
$id2 = $_POST['id2'];

/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "INSERT INTO ConnectionRequest (id1, id2) VALUES (?, ?)")){

	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt, $id1, $id2)){

		/* execute the query */
		if (mysqli_stmt_execute($stmt)){

			/* close the prepared statement */
			mysqli_stmt_close($stmt);

			echo "<script type='text/javascript'>alert('Connection request sent.')</script>";

			header("Location: index.php?id=profile");

		} else echo "Stmt execute failed.\n";
	} else echo "id1=$id1, id2=$id2, Bind param failed.\n";
} else echo "Prepared statement failed.\n";



?>
