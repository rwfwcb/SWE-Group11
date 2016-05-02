<?php

  require "db.conf";

  if ($link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    $sql = "INSERT INTO SchoolOrCompany (id, name, pType) VALUES (?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
      $id = $_POST['id'];
      $orgName = $_POST['orgname'];
      $ptype = $_POST['pType'];
      mysqli_stmt_bind_param($stmt, "dss", $id, $orgName, $ptype) or die("bind param");
        if(mysqli_stmt_execute($stmt)) {
          echo "<script type='text/javascript'>alert('Succesfully registered (organization)!')</script>";
          header("Location: index.php?id=login-form");
        } else { echo "Statment execute failed.\n"; }
    } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
  } else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }


?>
