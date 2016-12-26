<?php

require "db.conf";

$id = 0;

if ($link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
  $sql = "SELECT id FROM Profile WHERE email=?";
  if ($stmt = mysqli_prepare($link, $sql)) {
    $email = $_SESSION['email'];
    mysqli_stmt_bind_param($stmt, "s", $email) or die("bind param");
      if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id);
        mysqli_stmt_fetch($stmt);
      } else { echo "<script type='text/javascript'>alert('This email already has a LinkedIn account associated with it.')</script>"; }
  } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
} else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }

?>
<form id='indForm2' class="form-horizontal" action="index.php?id=reg-ind2-controller" method="POST"></form>
<fieldset>

<!-- Form Name -->
<legend><h2 class="text-center" style="padding-top: 10px;">Finish signing up!</h2></legend>
<div class="container-fluid" style="max-width: 500px;">
  <!-- Hidden input -->
  <?php
  echo "<input form='indForm2' type='hidden' name='id' value='$id'>";
  ?>
  <form>
    <!-- Text input-->
    <div class="form-group" id="fngroup">
      <label class="control-label" for="fname">First name</label>
      <input form='indForm2' id="fname" name="fname" placeholder="First name" class="form-control input-md" type="text">
    </div>
    <!-- Text input-->
    <div class="form-group" id="lngroup">
      <label class="control-label" for="lname">Last name</label>
      <input form='indForm2' id="lname" name="lname" placeholder="Last name" class="form-control input-md" type="text">
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="control-label" for="email">Languages</label>
      <textarea form='indForm2' id="languages" name="languages" placeholder="What languages do you know?" class="form-control input-md" required type="email"></textarea>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="control-label" for="password">Summary</label>
      <textarea form='indForm2' id="summary" name="summary" placeholder="Enter a summary of yourself here..." class="form-control input-md" required type="password"></textarea>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="control-label" for="submit">Register</label>
        <button form='indForm2' type="submit" id="submit" name="submit" class="btn btn-primary">Register now</button>
    </div>
</form>

</div>
</fieldset>
