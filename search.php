<?php
/* start the session */
session_start();

/* make sure user is logged in and session variable is set*/
if(!isset($_SESSION['id'])) {
	header("Location: index.php?id=login-form");
}

echo "<form action='index.php?id=searchResults.php' method='POST'>";
echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='col-sm-6 col-sm-offset-3'>";
echo "<div id='imaginary_container'>";
echo "<div class='input-group stylish-input-group'>";
echo "<input type='text' class='form-control' name='input' placeholder='Search'>";
echo "<span class='input-group-addon'>";
echo "<button type='submit'>";
echo "<span class='glyphicon glyphicon-search'></span>";
echo "</button>";
echo "</span>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</form>";

?>
