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

$id1 = $_SESSION['id'];
$id2 = $_POST['id2'];
$id2 = 130;

/* run prepared queries to get user info */
	/* create a prepared statement */
		$stmt = mysqli_prepare($link, "SELECT firstName, lastName, languages, summary FROM Person WHERE id=?");
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt, 's', $id2);
		/* execute query */
		mysqli_stmt_execute($stmt);
		/* store result */
		mysqli_stmt_store_result($stmt);
		/* bind result variables */
		mysqli_stmt_bind_result($stmt, $firstName, $lastName, $languages, $summary);
    /* get results */
    mysqli_stmt_fetch($stmt);

		echo "<div class='container-fluid' style='padding-top: 10px;'>";
		echo "<div class='row'>";
		echo "<div class='col-md-5 col-md-offset-1 col-sm-12'>";
		echo "<div class='panel panel-info'>";
		echo "<div class='panel-heading' style='font-size: 18pt;'>$firstName $lastName";

		/* close prepared statement */
    mysqli_stmt_close($stmt);

echo "<form action='connectionRequest.php' method='POST'>";
echo "<input type='hidden' name='id1' value='$id1'>";
echo "<input type='hidden' name='id2' value='$id2'>";
echo "<button type='submit' class='btn btn-primary' id='followBtn'>Connect</button>";
echo "</form>";
echo "</div>";

echo "<div class='row' style='padding-top: 10px; padding-bottom: 10px;'>";
echo "<div class='col-md-3 col-sm-3 col-md-offset-1 col-sm-offset-1'>";
echo "<img class='img-responsive img-rounded' src='http://placehold.it/200x200' style='max-height: 200px; max-width: 200px;'>";
echo "</div>";
echo "<div class='col-md-6 col-sm-6 col-md-offset-1 col-sm-offset-1 pull-right'>";
echo "<div class='panel-body'>";
echo "<div class='text-muted'>$summary</div>";
echo "<div class='text-muted'>Columbia, MO</div>";
echo "<div class='text-muted'>$languages</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "<div class='col-md-5 col-sm-12'>";
echo "<div class='panel panel-default'>";
echo "<div class='panel-heading' style='font-size: 18pt;'>$firstName's recent connections</div>";
echo "<div class='row' style='padding-top: 10px; padding-bottom: 10px;'>";
echo "<div class='col-md-10 col-md-offset-1'>";


/* run prepared queries to get users recent connections*/
	/* create a prepared statement */
		if($stmt = mysqli_prepare($link, "SELECT id2 FROM PersonConnection WHERE id1=? LIMIT 4")){
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt, 's', $id2);
		/* execute query */
		mysqli_stmt_execute($stmt);
		/* store result */
		mysqli_stmt_store_result($stmt);
		/* bind result variables */
		mysqli_stmt_bind_result($stmt, $id02);
		/* fetch results row by row */
		while (mysqli_stmt_fetch($stmt)){ /* print output */
			/* create a prepared statement */
			if ($stmt2 = mysqli_prepare($link, "SELECT firstName, lastName FROM Person WHERE id=?")){
				/* bind variables to marker */
				mysqli_stmt_bind_param($stmt2, 's', $id02);
				/* execute query */
				mysqli_stmt_execute($stmt2);
				/* store result */
				mysqli_stmt_store_result($stmt2);
				/* bind result variables */
				mysqli_stmt_bind_result($stmt2, $firstName, $lastName);
				/* print output for each result returned */
				while (mysqli_stmt_fetch($stmt2)){
				echo "$firstName $lastName<br>";
				mysqli_stmt_close($stmt2);
				mysqli_stmt_close($stmt);
			}
			} else echo "Prepared statement 3 failed.";
		}
	} else echo "Prepared statement 2 failed.";


echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-md-10 col-sm-12 col-md-offset-1'>";
echo "<div class='panel panel-default'>";
echo "<div class='panel-heading' style='font-size: 18pt;'>News Feed</div>";
echo "<div class='row' style='padding-top: 10px; padding-bottom: 10px;'>";
echo "<div class='col-md-10 col-md-offset-1'>";

/* run prepared queries to get user wallposts */
	/* create a prepared statement */
		if($stmt3 = mysqli_prepare($link, "SELECT P.firstName, P.lastName, W.postTime, W.body FROM Wallpost W JOIN Person P USING (id) WHERE id=?")){
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt3, 's', $id2);
		/* execute query */
		mysqli_stmt_execute($stmt3);
		/* store result */
		mysqli_stmt_store_result($stmt3);
		/* bind result variables */
		mysqli_stmt_bind_result($stmt3, $firstName, $lastName, $postTime, $body);
    /* get results */
    while (mysqli_stmt_fetch($stmt3)){
			echo "id2 = $id2 $firstName $lastName $postTime\n";
			echo "$body";
      echo "<hr>";
    }
    /* close prepared statement */
    mysqli_stmt_close($stmt3);
  } else echo "Prepared statement 4 failed.";

echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

?>
