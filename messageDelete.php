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

/* run prepared queries to delete the message*/
	/* create a prepared statement */
		if($stmt = mysqli_prepare($link, "DELETE FROM Message WHERE senderID=? AND receiverID=? AND messageWhen=?")){
		/* bind variables to marker */
    $senderID = $_POST['senderID'];
    $receiverID = $_POST['receiverID'];
    $messageWhen = $_POST['messageWhen'];

		mysqli_stmt_bind_param($stmt, 'sss', $senderID, $receiverID, $messageWhen);
		/* execute query */
		mysqli_stmt_execute($stmt);

    /* redirect back to messenger */
    header("Location: index.php?id=messenger");
	}





?>
