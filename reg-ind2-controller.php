<?php

  require "db.conf";

  if ($link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    $sql = "INSERT INTO Person (id, firstName, lastName, languages, summary) VALUES (?,?,?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
      $id = htmlspecialchars($_POST['id']);
      $fname = htmlspecialchars($_POST['fname']);
      $lname = htmlspecialchars($_POST['lname']);
      $languages = htmlspecialchars($_POST['languages']);
      $summary = htmlspecialchars($_POST['summary']);
      mysqli_stmt_bind_param($stmt, "dssss", $id, $fname, $lname, $languages, $summary) or die("bind param");
        if(mysqli_stmt_execute($stmt)) {
          header("Location: index.php?id=login-form");
        } else { echo "<script type='text/javascript'>alert('Statement execute failed.\n"; }
    } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
  } else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }
?>
