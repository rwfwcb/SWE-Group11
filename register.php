<?php
/*
if($_SERVER['HTTPS'] != 'on'){
  die(header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
}
*/

session_start();

if(!empty($_SESSION['user'])){
  if($_SESSION['user_type'] == 'ind'){
    header('Location: index.php');
  } else{
    header('Location: orgHome.html');
  }
}

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
          echo "<script type='text/javascript'>alert('Succesfully registered!')</script>";
          header("Location: index.php");
        } else { echo "<script type='text/javascript'>alert('This email already has a LinkedIn account associated with it.')</script>"; }
      }
    } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }
  } else { echo "<script type='text/javascript'>alert('Unable to establish a MySQL connection.')</script>"; }
}
 ?>

<script type="text/javascript">
        $(document).ready(function () {
            toggleFields();
            $("#usertype").change(function () {
                toggleFields();
            });
        });
        
        function toggleFields() {
            if ($("#usertype").val() === "ind") {
                $("#fngroup").show();
                $("#fname").prop('required', true);
                $("#lngroup").show();
                $("lname").prop('required', true);
                $("#ongroup").hide();
                $("orgname").removeAttr('required');
            }
            else {
                $("#ongroup").show()
                $("orgname").prop('required', true);
                $("#fngroup").hide();
                $("#fname").removeAttr('required');
                $("#lngroup").hide();
                $("#lname").removeAttr('required');
            }
        }
</script>

<form class="form-horizontal" action="register.php" method="POST">
<fieldset>

<!-- Form Name -->
<legend><h2 class="text-center" style="padding-top: 10px;">Sign up!</h2></legend>
<div class="container-fluid">
    <!-- Text input-->
    <div class="form-group" id="fngroup">
      <label class="col-md-4 control-label" for="fname">First name</label>  
      <div class="col-md-4">
      <input id="fname" name="fname" placeholder="First name" class="form-control input-md" type="text">
      </div>
    </div>
    <!-- Text input-->
    <div class="form-group" id="lngroup">
      <label class="col-md-4 control-label" for="lname">Last name</label>  
      <div class="col-md-4">
      <input id="lname" name="lname" placeholder="Last name" class="form-control input-md" type="text">
      </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group" id="ongroup" style="display: none;">
      <label class="col-md-4 control-label" for="orgname">Organization</label>  
      <div class="col-md-4">
      <input id="orgname" name="orgname" placeholder="Organization" class="form-control input-md" type="text">
      </div>
    </div>

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

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="usertype">Individual/Organization</label>
      <div class="col-md-4">
        <select id="usertype" name="usertype" class="form-control">
          <option value="ind" selected>Individual</option>
          <option value="org">Organization</option>
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
</div>
</fieldset>
</form>