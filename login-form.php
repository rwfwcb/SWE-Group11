<?php session_start(); ?>

<?php if ($error) {
    echo("<p id=\"error\" class=\"danger text-danger\">" . $error . "</p>");
} ?>

<div class="container" id="tdshrink">

   <form class="form-signin" role="form" action="login.php" method="POST">
     <input type="hidden" name="action" value="do_login">
     <h2 class="form-signin-heading">Test login page!</h2>
     <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="" required autofocus>
     <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
     <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Log in">
   </form>

</div>