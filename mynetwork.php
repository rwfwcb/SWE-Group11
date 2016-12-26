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
				mysqli_stmt_close($stmt2);
			} else echo "prepare 2 failed.\n";
		}
		mysqli_stmt_close($stmt);
	}

?>

</ul>
	</div>

<!--"connection-card" classes based on LinkedIn's engagement-cards, but simplified for this assignment. -->
            
<h1 style="text-align: center;">Number of users registered toward goal:</h1>
<svg id="fillgauge1" style="text-align: center;"></svg>            
<script src="js/d3/d3.min.js"></script>
<script src="js/d3/lfg.js"></script>
<script>
    window.onload = function(){
    var gauge1 = loadLiquidFillGauge("fillgauge1", 
<?php
    if($stmt3 = mysqli_prepare($link, "SELECT count(*) from Person")){
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_store_result($stmt3);
        mysqli_stmt_bind_result($stmt3, $numMembers);
        while (mysqli_stmt_fetch($stmt3)){echo $numMembers;}
        mysqli_stmt_close($stmt3);
    }
    mysqli_close($link);
?>
    );
    var config1 = liquidFillGaugeDefaultSettings();
    config1.circleColor = "#FF7777";
    config1.textColor = "#FF4444";
    config1.waveTextColor = "#FFAAAA";
    config1.waveColor = "#FFDDDD";
    config1.circleThickness = 0.2;
    config1.textVertPosition = 0.2;
    config1.waveAnimateTime = 1000;
    }
</script>