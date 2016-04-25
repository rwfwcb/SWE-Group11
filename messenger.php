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

/* run prepared queries to see if the user has any connections*/
	/* create a prepared statement */
		if($stmt = mysqli_prepare($link, "SELECT * FROM PersonConnection WHERE id1=?")){
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt, 's', $_SESSION['id']);
		/* execute query */
		mysqli_stmt_execute($stmt);
		/* store result */
		mysqli_stmt_store_result($stmt);
		/* bind result variables */
		mysqli_stmt_bind_result($stmt, $id1, $id2);
		/* fetch results row by row */
		while (mysqli_stmt_fetch($stmt)){ /* print output */
			/* create a prepared statement */
			if ($stmt2 = mysqli_prepare($link, "SELECT id, picture, firstName, lastName FROM Profile JOIN Person USING (id) WHERE id=?")){
				/* bind variables to marker */
				mysqli_stmt_bind_param($stmt2, 's', $id2);
				/* execute query */
				mysqli_stmt_execute($stmt2);
				/* store result */
				mysqli_stmt_store_result($stmt2);
				/* bind result variables */
				mysqli_stmt_bind_result($stmt2, $id, $picture, $firstName, $lastName);
			} else echo "prepare 2 failed.\n";
		}
	}
?>

<link rel="stylesheet" href="css/messenger.css">

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-lg-4">
          <div class="post-box">
              <div class="inner-post-box">
                <h2>Select Connecions</h2>
                <h4>Click on a connection to send them a message.<h6>Note: a message can only be sent to 1 connection at a time.</h6></h4>
                  <div class = "users">
                    <?php
              				/* print output for each connection returned */
              				while (mysqli_stmt_fetch($stmt2)){
                        echo "<div>";
                        echo "<p>";
                        echo "<img class='img-circle' src='data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' alt='Generic placeholder image' width='60' height='60'>";
                        echo "$firstName $lastName";
                        echo "</p>";
              					echo "<form class='form-inline' action='index.php?id=messenger' method='POST'>";
              					echo "<input type='hidden' name='recipient' value='$id'>";
              					echo "<button type='submit' class='connection-name btn btn-primary'>Select</button>";
              					echo "</form>";
                        echo "<hr style='height:1px;border:none;border-top:1px dashed #0066CC;'/>";
                        echo "</div>";
              				}
              				mysqli_stmt_close($stmt2);
                      mysqli_stmt_close($stmt);
                        ?>
              </div>
              </div>
          </div>
        </div>

        <div class="col-lg-8">
            <h2 align="center">Message Box </h2>
              <div class="col-lg-12">
                  <div class="message_box">
                      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                      <form id="messageForm" class="form-inline" role="form" action="index.php?id=messageController" method="POST">
                        <div class="form-group" id = "group">
                            <div id = "combine">
                              <input type="text" class="form-control" placeholder="Message recipients go here..." name="receiver" value="<? $_POST['recipient'] ?>" readonly>
                              <textarea form="messageForm" class="form-control" placeholder="" id ="messages" name='messageContent' rows=4 placeholer='Enter message contents here...'></textarea>
                                <button class="btn btn-primary" id= "connection">Send</button>
                            </div>
                        </div>
                       </form>
                      <br>
                  </div>
              </div><!-- /.col-lg-4 -->
          </div>
        </div>
        <div class='inbox'>
          <?php
          /* run prepared queries to see if the user has any connections*/
          	/* create a prepared statement */
          		if($stmt = mysqli_prepare($link, "SELECT senderID, receiverID, body, messageWhen FROM Message WHERE recipient=?")){
          		/* bind variables to marker */
          		mysqli_stmt_bind_param($stmt, 's', $_SESSION['id']);
          		/* execute query */
          		mysqli_stmt_execute($stmt);
          		/* store result */
          		mysqli_stmt_store_result($stmt);
          		/* bind result variables */
          		mysqli_stmt_bind_result($stmt, $senderID, $receiverID, $body, $messageWhen);
          		/* fetch results row by row */
              while (mysqli_stmt_fetch($stmt)){ /* print output */
                if($stmt2 = mysqli_prepare($link, "SELECT firstName, lastName FROM Person WHERE id=?")){
            		/* bind variables to marker */
            		mysqli_stmt_bind_param($stmt2, 's', $senderID);
            		/* execute query */
            		mysqli_stmt_execute($stmt2);
            		/* store result */
            		mysqli_stmt_store_result($stmt2);
            		/* bind result variables */
            		mysqli_stmt_bind_result($stmt2, $fName, $lName);
            		/* fetch results row by row */
                echo "<table>";
                echo "<tr><th></th><th></th><th>From</th><th>Message Content</th><th>Timestamp</th></tr>";
                while (mysqli_stmt_fetch($stmt2)){
                  echo "<tr><td>Delete</td><td>Reply</td><td>$fName $lName</td><td>$body</td><td>$messageWhen</td></tr>";
                }
                echo "</table>";
                mysqli_stmt_close($stmt2);
              }
            }
          }
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            echo "</div>";
            echo "</div>";

            ?>
