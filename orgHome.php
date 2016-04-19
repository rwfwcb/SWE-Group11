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

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Organization Home</title>";
/* <!-- link in Bootstrap and jQuery --> */
echo "<link rel='stylesheet' href='css/app.css'>";
echo "<script src='js/bootstrap/bootstrap.min.js'></script>";
echo "<script src='js/jquery/dist/jquery.min.js'></script>";
echo "</head>";
echo "<body>";
echo "<div class='container'>";
echo "<img id='pic' src=http://placehold.it/200x200>";
echo "<button id='followBtn'>Follow</button>";
echo "<div class=info>";
echo "<h2>Name</h2>";
echo "<h5>Industry</h5>";
echo "<h5>Company Size</h5>";
echo "</div>";
echo "<br><br><br><br>";
echo "<div class='choice'>";
echo "<a href='orgHome.html'>Home</a>";
echo "<a href='orgCareers.html'>Careers</a>";
echo "</div>";
echo "</div>";
echo "<br>";
echo "<div class='container'>";
echo "<h4>About Us</h4>";
echo "<div class='aboutUs'>";
echo "<h5>Website</h5>";
echo "<p><a href='https://google.com'>https://google.com</a></p>";
echo "<h5>Industry</h5>";
echo "<p>Internet</p>";
echo "</div>";
echo "<div class='aboutUs'>";
echo "<h5>Company Size</h5>";
echo "<p>10,000+</p>";
echo "<h5>Founded</h5>";
echo "<p>1998</p>";
echo "</div>";
echo "<div class='aboutUs'>";
echo "<h5>Headquarters</h5>";
echo "<p>1600 Amphitheatre Parkway Mountain View, CA 94043 United States</p>";
echo "</div>";
echo "</div>";
echo "<br>";
echo "<div class='container'>";
echo "<h4 id='update'>Share an update...</h4>";
echo "<form name='shareUpdate' action='#' method='post'></form>";
echo "<input type='hidden' name='timestamp' value='#'>";
echo "<textarea form='shareUpdate' type=text name='message' rows=4 cols=60></textarea>";
echo "<input form='shareUpdate' type='submit'>";
echo "</div>";
echo "<br>";
echo "<div class='container'>";
echo "<h4>Recent Updates</h4><hr>";
echo "<p class='wallpost'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus hendrerit ex, eu auctor lectus consequat vitae. Nam diam ex, scelerisque eget hendrerit sagittis, iaculis ac arcu. Donec</p><hr>";
echo "<p class='wallpost'>Donec a pulvinar est, sodales congue mauris. Nullam eu efficitur sem. Morbi lobortis, tellus at iaculis lacinia, eros sapien varius ante</p><hr>";
echo "<p class='wallpost'>Ut efficitur libero eu quam euismod ultricies. Nam vehicula pellentesque neque eu fringilla. Nunc posuere quis turpis vitae accumsan</p><hr>";
echo "</div>";
echo "</body>";
echo "</html>";
?>
