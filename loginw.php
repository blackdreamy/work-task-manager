<!-- Подключаем server.php с логикой логина. -->
<?php include('server.php'); ?>
<?php 
	// проверяем залогинен ли работяга если залогинен админ - его в админ панель, если работяга - в работягопанель
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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	
</head>
<body>
	<div class="header">
		<h2>User Login</h2>
	</div>
	<form method='post' action='loginw.php'>
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
			<button type='submit' name="login_worker" class='btn'>Login</button>
		</div>
		<p>If you do not have an account, contact your corporate administrator.</p>
	</form>
</body>
</html>