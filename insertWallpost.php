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

$sql3 = "INSERT INTO Wallpost (id, postTime, body) VALUES (?, now(), ?)";
/* create a prepared statement */
if ($stmt3 = mysqli_prepare($link, $sql3)){
  /* bind variables to marker */
	$id = $_SESSION['id']
  $body = $_POST['wallpost'];

  mysqli_stmt_bind_param($stmt3, "ss", $id, $body) or die("bind param");
  /* execute query */
  mysqli_stmt_execute($stmt3);
	/* close the prepared statement */
	mysqli_stmt_close($stmt3);

} else echo "<script type='text/javascript'>alert('Prepared statement 3 failed.')</script>";

?>
