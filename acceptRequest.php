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

$id1 = $_SESSION['id'];
$id2 = $_POST['user'];
$stamp = "now()";

/* close prepared statement */
mysqli_stmt_close($stmt4);
mysqli_stmt_reset($stmt4);

/* create a prepared statement */
if ($stmt4 = mysqli_prepare($link, "INSERT INTO PersonConnection (id1, id2, since) VALUES (?, ?, ?")) {
	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt4, 'dds', $id1, $id2, $stamp) {
		/* execute the query */
		if (mysqli_stmt_execute($stmt4)) {
			/* close the prepared statement */
			mysqli_stmt_close($stmt4);
		 } else echo "Stmt execute failed.\n";
	} else echo "id1=$id1, id2=$id2, Bind param failed.\n";
} else echo "Prepared statement failed.\n";

/* create a prepared statement */
if ($stmt4 = mysqli_prepare($link, "INSERT INTO PersonConnection (id1, id2, since) VALUES (?, ?, ?")) {
	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt4, 'dds', $id2, $id1, $stamp) {
		/* execute the query */
		if (mysqli_stmt_execute($stmt4)) {
			/* close the prepared statement */
			mysqli_stmt_close($stmt4);
			/* redirect back to the profile page */
			header("Location: index.php?id=profile");
		 } else echo "Stmt execute failed.\n";
	} else echo "id1=$id1, id2=$id2, Bind param failed.\n";
} else echo "Prepared statement failed.\n";
/* close the connection */
mysqli_close($link);
?>
