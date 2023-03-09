<?php 
  session_start(); 
  // проверяем залогинен ли работяга
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }

	$errors = array(); 
	$db = mysqli_connect('localhost', 'root', '123', 'registration');

	if (isset($_POST['change_password'])) {
	  // получаем все значения из полей на странице регистрации
	  $currentPassword = $_SESSION['password'];
	  $username = $_SESSION['username'];
	  $inputCurrentPassword = mysqli_real_escape_string($db, $_POST['currentpassword']);
	  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	  // валидация формы, убеждаемся, что все данные введены корректно
	  // array_push добавляет лог ошибки в массив errors
	  if (empty($currentPassword)) { array_push($errors, "Current Password required"); }
	  if (empty($password_1)) { array_push($errors, "New Password required"); }
	  if (empty($password_2)) { array_push($errors, "Confirm New Password is required"); }
	  if ($password_1 != $password_2) {
		array_push($errors, "The two new passwords do not match");
  	  }
  	  if ($inputCurrentPassword != $currentPassword){
  	  	array_push($errors, "Wrong current password");
  	  }
  	   if (count($errors) == 0) {
    // проверяем совпадает ли логин и пароль с бд
		    $query = "UPDATE `users` SET `password` = '$password_1' WHERE `username`='$username'";
		    mysqli_query($db, $query);
		    //обновляем пасс в текущей сессии
		    $_SESSION['password'] = $password_1;
		    header('location: successupdate.php');
  			}
  		}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Change password</title>
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  <link rel="stylesheet" type="text/css" href="css/changepassword.css">
</head>
<body>
  <div class="header">
  	<h2>Change password</h2>
  </div>
	


		    	<form method="post" action="updatepassword.php">
					  	<?php include('errors.php'); ?>
					  	<div class="input-group">
					  	  <label>Current password</label>
					  	  <input type="password" name="currentpassword" autocomplete="off">
					  	</div>

					  	<div class="input-group">
					  	  <label>New password</label>
					  	  <input type="password" name="password_1" autocomplete="new-password">
					  	</div>
					  	<div class="input-group">
					  	  <label>Repeat new password</label>
					  	  <input type="password" name="password_2" autocomplete="new-password">
					  	</div>
					  	<div class="input-group">
					  	  <button type="submit" class="btn" name="change_password" id='changepasswordbutton'>Change!</button>
					  	  <button  class="btn" name="back" id='backbutton'>Back</button>
					  	</div>
					  	
  </form>
  </form>
  <script type="text/javascript" src='js/changepassword.js'></script>
</body>
</html>