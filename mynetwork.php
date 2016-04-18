<?php
/* start the session */
session_start();

if(!isset($_SESSION['username'])) {
	header("Location: index.php?id=login-form");
}

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

<!DOCTYPE html>
<html>
<head>
<title>My Network</title>
<!-- link in Bootstrap and jQuery -->
<link rel="stylesheet" href="css/app.css">
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="css/mynetwork.css">
</head>
<body>
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
			if ($stmt2 = mysqli_prepare($link, "SELECT * FROM Profile JOIN Person USING (id) WHERE id=?")){
				/* bind variables to marker */
				mysqli_stmt_bind_param($stmt2, 's', $id2);
				/* execute query */
				mysqli_stmt_execute($stmt2);
				/* store result */
				mysqli_stmt_store_result($stmt2);
				/* bind result variables */
				mysqli_stmt_bind_result($stmt2, $id, $email, $hashpass, $picture, $memberSince, $firstName, $lastName, $languages, $summary);
				/* print output for each result returned */
				while (mysqli_stmt_fetch($stmt2)){
					<li class = "list-card">
						<div class="connection-card">
							<div class="connection-body-left">
								<img src="$picture" alt="User Picture">
							</div>
							<div class="connection-body-right">
								<p class="connection-name">$firstName . " " . $lastName</p>
								<span></span>
								<p class="connection-basicinfo">$summary</p>
							</div>
						</div>
					</li>
				}
				mysqli_stmt_close($stmt2);
			}
		}
		mysqli_stmt_close($stmt);
	}
?>
		</ul>
		</div>
	</div>
</body>
<!--"connection-card" classes based on LinkedIn's engagement-cards, but simplified for this assignment.
</html>
