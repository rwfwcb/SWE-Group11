<?php session_start(); ?>

<?php if (isset($_SESSION['error'])) {
    echo("<div class=\"container-fluid\">");
    echo("<p style=\"margin-bottom: 0px; margin-top: 10px;\" id=\"error\" class=\"danger text-danger\">" . $error . "</p>");
    echo("</div>");
} ?>

<div class="container-fluid">

   <form class="form-signin" role="form" action="login.php" method="POST">
     <h2 style="margin-top: 10px;" class="form-signin-heading">Sign in</h2>
     <input style="margin-bottom: 10px;" type="email" id="username" name="username" class="form-control" placeholder="Email address" value="" required autofocus>
     <input style="margin-bottom: 10px;" type="password" id="password" name="password" class="form-control" placeholder="Password" required>
     <input style="margin-bottom: 10px;" class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Log in">
    </form>
</div>