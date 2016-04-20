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

mysqli_stmt_close($stmt2);
mysqli_stmt_reset($stmt2);

$input = $_POST['input'];
$sql = "SELECT id, firstName, lastName FROM Person WHERE firstName LIKE '%?%' OR lastName LIKE '%?%' ";

if ($stmt2 = mysqli_prepare($link, $sql)){
	echo "chkpt2 \n";
	/* bind variables to marker */
	$t = gettype($input);
	echo "$t $input $t $input\n";
	if(mysqli_stmt_bind_param($stmt2, "ss", $input, $input)){
		echo "chkpt3 \n";
		/* execute query */
		if (mysqli_stmt_execute($stmt2)){
			echo "chkpt4 \n";
			/* store result */
			mysqli_stmt_store_result($stmt2);
			echo "chkpt5 \n";
			/* bind result variables */
			if (mysqli_stmt_bind_result($stmt2, $id, $firstName, $lastName)){
				echo "chkpt6 \n";

				/* fetch results */
				while (mysqli_stmt_fetch($stmt2)){
					echo "chkpt7 \n";
					//echo "<li class = 'list-card'>";
					//echo "<div class='connection-card'>";
					//echo "<div class='connection-body-left'>";
					//echo "<img src='$picture' alt='User Picture'>";
					//echo "</div>";
					//echo "<div class='connection-body-right'>";
					//echo "<p class='connection-name'>$firstName $lastName</p>";
					//echo "<span></span>";
					//echo "<p class='connection-basicinfo'>$summary</p>";
					//echo "</div>";
					//echo "</div>";
					//echo "</li>";
					echo "$firstName $lastName \n\n";
				}

				/* close prepared statement */
				mysqli_stmt_close($stmt2);
				mysqli_close($link);
				echo "chkpt9 \n";
			}else echo "Stmt bind result failed.\n";
		}else echo "Stmt execute failed.\n";
	}else	echo "Stmt bind param failed.\n";
}else echo "Stmt prepare failed.\n";
?>
