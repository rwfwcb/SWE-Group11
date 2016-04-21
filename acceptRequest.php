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

echo "$id1\n";
echo "$id2\n";

/* close prepared statement */
mysqli_stmt_close($stmt4);
mysqli_stmt_reset($stmt4);

/* create a prepared statement */
if ($stmt4 = mysqli_prepare($link, "INSERT INTO PersonConnection VALUES (?, ?)")) {
	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt4, 'dd', $id1, $id2)){
		/* execute the query */
		if (mysqli_stmt_execute($stmt4)) {
			/* close the prepared statement */
			mysqli_stmt_close($stmt4);
		} else echo "Stmt1 execute failed.\n";
	} else echo "id1=$id1, id2=$id2, Bind param failed.\n";
} else echo "Prepared statement1 failed.\n";

/* create a prepared statement */
if ($stmt4 = mysqli_prepare($link, "INSERT INTO PersonConnection VALUES (?, ?)")) {
	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt4, 'dd', $id2, $id1)) {
		/* execute the query */
		if (mysqli_stmt_execute($stmt4)) {
			/* close the prepared statement */
			mysqli_stmt_close($stmt4);
			/* redirect back to the profile page */
			header("Location: index.php?id=profile");
		} else echo "Stmt2 execute failed.\n";
	} else echo "Bind param failed.\n";
} else echo "Prepared statement2 failed.\n";

/* create a prepared statement */
if ($stmt4 = mysqli_prepare($link, "DELETE FROM ConnectionRequest WHERE id2=?")) {
	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt4, 'dd', $id1)){
		/* execute the query */
		if (mysqli_stmt_execute($stmt4)) {
			/* close the prepared statement */
			mysqli_stmt_close($stmt4);
		} else echo "Stmt3 execute failed.\n";
	} else echo "Bind param failed.\n";
} else echo "Prepared statement3 failed.\n";

/* close the connection */
mysqli_close($link);
?>
