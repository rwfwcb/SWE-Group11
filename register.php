<?php
/*
if($_SERVER['HTTPS'] != 'on'){
  die(header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
}
*/

session_start();

if(!empty($_SESSION['id'])){
  header('Location: index.php?id=home');
}

if(isset($_POST['submit'])) { // Was the form submitted?
  if ($_POST['password'] != $_POST['cpassword']){
    echo "<script type='text/javascript'>alert('Password entries do not match.')</script>";
    header("Location: index.php?id=register");
  }

  require "db.conf";

  if ($link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    $email = $_POST['email'];
    $sql = "INSERT INTO Profile (email, hashpass) VALUES (?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
      $pass = $_POST['password'];
      $cpass = $_POST['cpassword'];
      $hpass = password_hash($pass, PASSWORD_BCRYPT);
      mysqli_stmt_bind_param($stmt, "ss", $email, $hpass) or die("bind param");
      if ($pass == $cpass){
        if(mysqli_stmt_execute($stmt)) {
          echo "<script type='text/javascript'>alert('Profile created!')</script>";
        } else { echo "<script type='text/javascript'>alert('This email already has a LinkedIn account associated with it.')</script>"; }
      }
      mysqli_stmt_close($stmt);
    } else { echo "<script type='text/javascript'>alert('Prepared statement failed.')</script>"; }


  $sql2 = "SELECT id FROM Profile WHERE email='?'";
  /* create a prepared statement */
  if ($stmt2 = mysqli_prepare($link, $sql2)){
    /* bind variables to marker */
    if (mysqli_stmt_bind_param($stmt2, 's', $email)){
      /* execute query */
      if (mysqli_stmt_execute($stmt2)){
        /* store result */
        mysqli_stmt_store_result($stmt2);
        /* bind result variables */
        mysqli_stmt_bind_result($stmt2, $id);
        /* get results */
        mysqli_stmt_fetch($stmt2);
        /* close prepared statement */
        mysqli_stmt_close($stmt2);
    } else echo "<script type='text/javascript'>alert('bind_param failed, $email')</script>";

      $sql3 = "INSERT INTO Person (id, firstName, lastName) VALUES (?, ?, ?)";
      /* create a prepared statement */
      if ($stmt3 = mysqli_prepare($link, $sql3)){
        /* bind variables to marker */
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];

        mysqli_stmt_bind_param($stmt3, "sss", $id, $firstName, $lastName) or die("bind param");
        /* execute query */
        if (mysqli_stmt_execute($stmt3)){
          echo "<script type='text/javascript'>alert('Succesfully registered!')</script>";
          header("Location: index.php?id=login-form");
        } else echo "<script type='text/javascript'>alert('Unable to insert first name / last name.')</script>";;
        mysqli_stmt_close($stmt3);
      } else echo "<script type='text/javascript'>alert('Prepared statement 3 failed.')</script>";
    } else echo "<script type='text/javascript'>alert('Unable to retrieve the profile ID.')</script>";
  } else echo "<script type='text/javascript'>alert('Prepared statement 2 failed.')</script>";

  /* close the connection */
  mysqli_close($link);
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
