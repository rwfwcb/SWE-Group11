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
$id2 = $_POST['id2'];

/* close prepared statement */
mysqli_stmt_close($stmt4);
mysqli_stmt_reset($stmt4);

/* create a prepared statement */
if ($stmt4 = mysqli_prepare($link, "INSERT INTO ConnectionRequest VALUES (?, ?)")) {
	/* bind paramaters to prepared statement */
	if (mysqli_stmt_bind_param($stmt4, 'dd', $id1, $id2)) {
		/* execute the query */
		if (mysqli_stmt_execute($stmt4)) {
			/* close the prepared statement */
			mysqli_stmt_close($stmt4);
			echo "<h2>Connection request sent!</h2>\n";
			echo "<form action='index.php?id=profileX' method='POST'>";
			echo "<input type='hidden' name='user' value='$id2'>";
			echo "<button type='submit' class='btn btn-primary'>Go back</button>";
			echo "</form>";
		 } else echo "Stmt execute failed.\n";
	} else echo "id1=$id1, id2=$id2, Bind param failed.\n";
} else echo "Prepared statement failed.\n";
/* close the connection */
mysqli_close($link);
?>
