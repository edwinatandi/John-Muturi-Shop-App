<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login</title>
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
		<div class=" col-md-6 form-container">
   		<form class="form-group" action="myApi.php" method="post">
      		<h2><b>Login to John Muturi App</b></h2>
      		<label for="email">Email</label>
      		<input id="email" class="form-control" type="email" name="email" required placeholder="enter email" class="box">
      		<br>
      		<label for="password">Password</label>
      		<input id="password" class="form-control" type="password" name="password" required placeholder="enter password" class="box">
      		<br>
      		<input type="submit" name="login" class="btn btn-primary" value="login now">
      		<br>
      		<p>don't have an account? <a href="register.php">register now</a></p>
   		</form>
	</div>

	
	
</body>
</html>