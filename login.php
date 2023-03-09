<!-- подключаем файл server.php и провреяем есть ли активная сессия - если она уже есть, то редиректим в панель -->
<?php include('server.php'); ?>
<?php 
	
  if(isset($_SESSION['username'])){
  	header('location: panel.php');
  }
  if(isset($_SESSION['user'])){
  	header('location: workerpanel.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login as administrator</title>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	
</head>
<body>
	<div class="header">
		<h2>Login as administrator</h2>
	</div>
	<form method='post' action='login.php'>
		 <?php include('errors.php'); ?>
		<div class='input-group'>
			<label>Username</label>
			<input type='text' name='username'>
		</div>
		<div class='input-group'>
			<label>Password</label>
			<input type='password' name='password'>
		</div>
		<div class='input-group'>
			<button type='submit' name="login_user" class='btn'>Login</button>
		</div>
		<p>Don't have an account yet? <a href="signup.php">Register</a>.</p>
	</form>
</body>
</html>