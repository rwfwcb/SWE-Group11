<?php
if(isset($_POST['submit'])) { // Was the form submitted?
  if ($_POST['password'] != $_POST['cpassword']){
    echo "<script type='text/javascript'>alert('Password entries do not match.')</script>";
  }

  require "db.conf";

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
          header("Location: index.php?id=reg-org2");
        } else { echo "<script type='text/javascript'>alert('This email already has a LinkedIn account associated with it.')</script>"; }
      }
    } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
  } else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }
}
?>

<form class="form-horizontal" action="reg-org.php" method="POST">
<fieldset>

<!-- Form Name -->
<legend><h2 class="text-center" style="padding-top: 10px;">Sign up!</h2></legend>
<div class="container-fluid">

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email</label>
      <div class="col-md-4">
      <input id="email" name="email" placeholder="Email address" class="form-control input-md" required type="email">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Password</label>
      <div class="col-md-4">
      <input id="password" name="password" placeholder="Password" class="form-control input-md" required type="password">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="cpassword">Confirm password</label>
      <div class="col-md-4">
      <input id="cpassword" name="cpassword" placeholder="Confirm password" class="form-control input-md" required type="password">
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit">Register</label>
      <div class="col-md-4">
        <button type="submit" id="submit" name="submit" class="btn btn-primary">Register now</button>
      </div>
    </div>
</div>
</fieldset>
</form>
