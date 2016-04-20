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

$input = $_POST['input'];
$sql = "SELECT id, firstName, lastName FROM Person P JOIN Profile Pr USING (id) WHERE firstName LIKE '%?%' OR lastName LIKE '%?%' ";

if ($stmt = mysqli_prepare($link, $sql)){
	/* bind variables to marker */
	mysqli_stmt_bind_param($stmt, 'ss', $input, $input);
	/* execute query */
	mysqli_stmt_execute($stmt);
	/* store result */
	mysqli_stmt_store_result($stmt);
	/* bind result variables */
	mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName);
	/* fetch results */
	while (mysqli_stmt_fetch($stmt)){
		echo "<li class = 'list-card'>";
		echo "<div class='connection-card'>";
		echo "<div class='connection-body-left'>";
		//echo "<img src='$picture' alt='User Picture'>";
		echo "</div>";
		echo "<div class='connection-body-right'>";
		echo "<p class='connection-name'>$firstName $lastName</p>";
		echo "<span></span>";
		//echo "<p class='connection-basicinfo'>$summary</p>";
		echo "</div>";
		echo "</div>";
		echo "</li>";
	}
	/* close prepared statement */
}
?>
