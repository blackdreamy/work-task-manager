<!-- Подключаем файл сервер пхп, где хранится вся логика создания админ-аккаунта, проверяем не залогинен ли сейчас админ, если залогинен - отправляем его в админ панель -->
<?php include('server.php') ?>
<?php 
  if(isset($_SESSION['username'])){
  	header('location: panel.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="signup.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Company name</label>
  	  <input type="text" name="companyname" value="<?php echo $companyname; ?>">
  	</div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email">
    </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Repeat password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already registered? <a href="login.php">Login</a>
  	</p>
  </form>
</body>
</html>