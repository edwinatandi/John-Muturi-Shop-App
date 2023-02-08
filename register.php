<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>register new user</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
	include'connect_db.php';
	include'myApi.php';
	if(isset($alert)){
		foreach ($alert as $alert) {
			echo'<div class="alert" onclick="this.remove();">'.$alert.'</div>';
		}
	}
	?>
	<div class="col-md-8 form-container">
   		<form class="form-group" action="" method="post">
     		<h3>Register Now</h3>
     		<label for="username">User Name</label>
      		<input class="form-control" id="username" type="text" name="name" required placeholder="enter username"><br>
      		<label for="email">Email</label>
      		<input class="form-control" id="email" type="email" name="email" required placeholder="enter email"><br>
      		<label for="password">Password</label>
      		<input type="password" name="password" required placeholder="enter password" class="form-control"><br>
      		<label for="cpassord">Confirm Password</label>
      		<input id="cpassord" type="password" name="cpassword" required placeholder="confirm password" class="form-control"><br>
      		<input type="submit" name="register" class="mybtn btn-primary" value="register now">
      		<p>already have an account? <a href="login.php">login now</a></p>
   		</form>
	</div>
</body>
</html>