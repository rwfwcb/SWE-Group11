<?php

/* start the session */
session_start();

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

/* run prepared queries to see if the user has any connections*/
	/* create a prepared statement */
		if($stmt = mysqli_prepare($link, "INSERT INTO Message VALUES (?, ?, ?, now())")){
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt, 'dds', $_SESSION['id'], $_POST['receiver'], $_POST['messageContent']);
		/* execute query */
		mysqli_stmt_execute($stmt);
		/* close the prepared stmt */
    mysqli_stmt_close($stmt);
    /* close the connection */
    mysqli_close($link);
  } else echo "Prepared stmt failed.\n";

header("Location: index.php?id=messenger");
?>
