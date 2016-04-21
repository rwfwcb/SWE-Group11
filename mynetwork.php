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
?>

<link rel="stylesheet" href="css/mynetwork.css">
	<div class="container">
		<ul class="networkbox">
			<div class="network-header">
				<h1>Your Connections</h1>
			</div>

<?php
/* run prepared queries to see if the user has any connections*/
	/* create a prepared statement */
		if($stmt = mysqli_prepare($link, "SELECT * FROM PersonConnection WHERE id1=?")){
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt, 's', $_SESSION['id']);
		/* execute query */
		mysqli_stmt_execute($stmt);
		/* store result */
		mysqli_stmt_store_result($stmt);
		printf("You have %d connections.<br>", mysqli_stmt_num_rows($stmt));
		/* bind result variables */
		mysqli_stmt_bind_result($stmt, $id1, $id2);
		/* fetch results row by row */
		while (mysqli_stmt_fetch($stmt)){ /* print output */
			/* create a prepared statement */
			if ($stmt2 = mysqli_prepare($link, "SELECT id, picture, firstName, lastName, summary FROM Profile JOIN Person USING (id) WHERE id=?")){
				/* bind variables to marker */
				mysqli_stmt_bind_param($stmt2, 's', $id2);
				/* execute query */
				mysqli_stmt_execute($stmt2);
				/* store result */
				mysqli_stmt_store_result($stmt2);
				/* bind result variables */
				mysqli_stmt_bind_result($stmt2, $id, $picture, $firstName, $lastName, $summary);
				echo "<ul class='networkbox'>";
				/* print output for each result returned */
				while (mysqli_stmt_fetch($stmt2)){
					echo "<li class = 'list-card'>";
					echo "<div class='connection-card'>";
					echo "<div class='connection-body-left'>";
					echo "<img src='http://placehold.it/100x100' alt='User Picture'>";
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
				mysqli_stmt_close($stmt2);
			} else echo "prepare 2 failed.\n"
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($link);
?>
		</ul>
		</div>
	</div>
<!--"connection-card" classes based on LinkedIn's engagement-cards, but simplified for this assignment. -->
