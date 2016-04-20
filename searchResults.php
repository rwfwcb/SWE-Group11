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

echo "chkpt1 \n";

$input = $_POST['input'];
$sql = "SELECT id, firstName, lastName FROM Person WHERE firstName LIKE '%?%' OR lastName LIKE '%?%' ";

if ($stmt = mysqli_prepare($link, $sql)){
	echo "chkpt2 \n";
	/* bind variables to marker */
	mysqli_stmt_bind_param($stmt, 'ss', $input, $input);
	echo "chkpt3 \n";
	/* execute query */
	mysqli_stmt_execute($stmt);
	echo "chkpt4 \n";
	/* store result */
	mysqli_stmt_store_result($stmt);
	echo "chkpt5 \n";
	/* bind result variables */
	mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName);
	echo "chkpt6 \n";
	/* fetch results */
	while (mysqli_stmt_fetch($stmt)){
		echo "chkpt7 \n";
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
		echo "chkpt8 \n";
	}
	/* close prepared statement */
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	echo "chkpt9 \n";
}
?>
