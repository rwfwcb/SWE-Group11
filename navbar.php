<?php session_start(); ?>
<head>
	<link rel="stylesheet" href="css/app.css">
	<!-- <link rel="stylesheet" href="css/custom.css"> -->
	<script src="js/jquery/dist/jquery.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">LinkedIn</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li
		<?php
			if(empty($_GET['id'])) { ?>
				class="active" <?php } ?>
		>
		<a href="index.php">Home</a></li>
      </ul>
        <?php
			if(!$loggedIn)
			{ ?>
            <ul class="nav navbar-right">
                <form class="navbar-form" role="form" action="login.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="username" name="username" placeholder="Email" value="" required autofocus class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" value="" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Sign in</button>
                    <a href="index.php?id=register"><button type="button" class="btn btn-primary">Register</button></a>
                </form>
            </ul>
        <?php } ?>
        <?php
			if($loggedIn)
			{ ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        <?php } ?>
    </div><!--/.nav-collapse -->
  </div>
</nav>