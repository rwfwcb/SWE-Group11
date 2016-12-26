<form class="form-horizontal" action="index.php?id=reg-ind-controller" method="POST">
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
