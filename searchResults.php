<!--
Robert Fink
CS4320
-->

<link rel="stylesheet" href="css/mynetwork.css">

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

/* initialize variables */
$input = "%" . $_POST['input'] . "%";
$sql = "SELECT id, firstName, lastName, summary FROM Person WHERE firstName LIKE ? OR lastName LIKE ? ";

/* close prepared statement */
mysqli_stmt_close($stmt2);
mysqli_stmt_reset($stmt2);

/* create a prepared statement for a search query */
if ($stmt2 = mysqli_prepare($link, $sql)){
	/* bind variables to marker */
	if(mysqli_stmt_bind_param($stmt2, "ss", $input, $input)){
		/* execute query */
		if (mysqli_stmt_execute($stmt2)){
			/* store result */
			mysqli_stmt_store_result($stmt2);
			/* bind result variables */
			if (mysqli_stmt_bind_result($stmt2, $id, $firstName, $lastName, $summary)){
				echo "<div class='container'>";
				echo "<ul class='networkbox'>";
				/* fetch results */
				while (mysqli_stmt_fetch($stmt2)){
					echo "<li class = 'list-card'>";
					echo "<div class='connection-card'>";
					echo "<div class='connection-body-left'>";
					//echo "<img src='$picture' alt='User Picture'>";
					echo "</div>";
					echo "<div class='connection-body-right'>";
					echo "<form action='index.php?id=profileX' method='POST'>";
					echo "<input type='hidden' name='user' value='$id'>";
					echo "<button type='submit' class='connection-name btn btn-link'>$firstName $lastName</button>";
					echo "</form>";
					echo "<span></span>";
					echo "<p class='connection-basicinfo'>$summary</p>";
					echo "</div>";
					echo "</div>";
					echo "</li>";
				}
				echo "</ul>";
				echo "</div>";
				/* close prepared statement */
				mysqli_stmt_close($stmt2);
				mysqli_close($link);
			}else echo "Stmt bind result failed.\n";
		}else echo "Stmt execute failed.\n";
	}else	echo "Stmt bind param failed.\n";
}else echo "Stmt prepare failed.\n";
?>
