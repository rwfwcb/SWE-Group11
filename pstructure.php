<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>SWE Group 11 LinkedIn</title>
</head>
<?php require "navbar.php"; ?>
<body>
    <div id="contenturl" style="margin-top: 51px;">
        <?php require $contentURL; ?>
    </div>
</body>
<?php require "footer.php"; ?>
</html>