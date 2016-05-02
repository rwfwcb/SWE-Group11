<?php
  if ($_POST['password'] != $_POST['cpassword']){
    echo "<script type='text/javascript'>alert('Password entries do not match.')</script>";
  }

  require "db.conf";

  $_SESSION['email'] = $_POST['email'];

  if ($link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    $sql = "INSERT INTO Profile (email, hashpass) VALUES (?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
      $email = $_POST['email'];
      $pass = $_POST['password'];
      $cpass = $_POST['cpassword'];
      $hpass = password_hash($pass, PASSWORD_BCRYPT);
      mysqli_stmt_bind_param($stmt, "ss", $email, $hpass) or die("bind param");
      if ($pass == $cpass){
        if(mysqli_stmt_execute($stmt)) {
          header("Location: index.php?id=reg-ind2");
        } else { echo "<script type='text/javascript'>alert('This email already has a LinkedIn account associated with it.')</script>"; }
      }
    } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
  } else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }

?>
