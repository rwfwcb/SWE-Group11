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

<form class="form-horizontal" action="index.php?id=reg-org2-controller" method="POST">

<!-- hidden input -->
<?php
  echo "<input type='hidden' name='id' value='$id'>";
?>

<!-- Text input-->
<div class="form-group" id="ongroup">
  <label class="col-md-4 control-label" for="orgname">Organization name</label>
  <div class="col-md-4">
  <input id="orgname" name="orgname" placeholder="Organization name" class="form-control input-md" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group" id="ongroup">
  <label class="col-md-4 control-label" for="pType">Are you a school or a company?</label>
  <div class="col-md-4">
    <select name='pType' class='form-group'>
      <option value="School">School</option>
      <option value="Company">Company</option>
    </select>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit">Register</label>
  <div class="col-md-4">
    <button type="submit" id="submit" name="submit" class="btn btn-primary">Register now</button>
  </div>
</div>

</form>
