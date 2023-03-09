<?php 
  session_start(); 
  // проверяем залогинен ли админ
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
 
?>
<?php include('sendmail.php'); ?>

<?php


	$db = mysqli_connect('localhost', 'root', '123', 'registration');

	$errors = array();

	if (isset($_POST['reg_worker'])) {
  // получаем все значения из полей на странице регистрации
	  	$username = mysqli_real_escape_string($db, $_POST['username']);
		$companyname = $_SESSION['companyname'];
		$inputcompanyname = mysqli_real_escape_string($db, $_POST['companyname']);
		$username = $username.$inputcompanyname;
		$realname = mysqli_real_escape_string($db, $_POST['realname']);
		$squad =  mysqli_real_escape_string($db, $_POST['squadChoose']);
		$role = mysqli_real_escape_string($db, $_POST['roleChoose']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['generatepass']);

		

		 $user_check_query = "SELECT * FROM workers WHERE user='$username' OR email='$email' LIMIT 1";
 		 $result = mysqli_query($db, $user_check_query);
 		 $user = mysqli_fetch_assoc($result);
  
		  if ($user) { // если юзернейм или мейл уже есть в бд - выдаем ошибку
		    if ($user['user'] === $username) {
		      array_push($errors, "Username already exists");
		    }

		    if ($user['email'] === $email) {
		      array_push($errors, "Email $email already exists");
		    }
		  }    	

 
    	//если ошибок нет - засовываем инфу в бд и отправляем на почту сообщение. 
    	if (count($errors) == 0) {
  			$query = "INSERT INTO `workers` (`user`,`companyname`,`realname`,`squad`,`role`,`email`,`password`) VALUES ( '$username','$companyname','$realname','$squad','$role','$email','$password')";
  			mysqli_query($db, $query);
  			header('location: success.php');
  			sendMail($email, $realname, $username, $companyname, $password, $role, $squad);
  }

	}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/adduser.css">
    <title>Add worker</title>
  </head>
  <body>

		<div class="header">
  	<h2>Create new worker account</h2>
  </div>

  		 <form method="post" action="adduser.php">
  		 	<?php include('errors.php'); ?>
  		 	<label>Username</label>
			  	<div class="input-group" id='usernamediv'>
			  	  <input type="text" name="username" id='usernameinput' required pattern="[^' ']+" placeholder="Spaces are not allowed">
			  	  <input type="text" name="companyname" id='companyname' value='_<?php echo $_SESSION['companyname'];?>' readonly>
			  	</div>
			  	<div class="input-group">
			  	  <label>Name</label>
			  	  <input type="text" name="realname" required>
			  	</div>
			  	<div class="input-group">
			  	  <label>Unit</label>
			  	    <select name="squadChoose"id='squadch'>
					  <option value="Alpha">Alpha</option>
					  <option value="Beta">Beta</option>
					  <option value="Delta">Delta</option>
				    </select>
			  	</div>
			  	<div class="input-group">
			  	  <label>Role</label>
			  	  <select name="roleChoose"id='rolech'>
					  <option value="Head">Head</option>
					  <option value="Worker">Worker</option>
				    </select>
			  	</div>
			  	<div class="input-group">
			  	  <label>Mail</label>
			  	  <input type="email" name="email" patter='email' required>
			  	</div>
			  	<div class="input-group generatepassdiv">
			  	  <label>Password</label>
			  	  <input type="text" name="generatepass" id='genpass' readonly="">
			  	</div>
			  	<div class="input-group">
			  	  <button type="submit" class="btn" name="reg_worker" id='regbutton'>Create new employee account</button>
			  	</div>
			  	<div class="input-group">
			  	<button  class="btn" name="back" id='backbutton'>Back</button>
				</div>
 		 </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='js/adduser.js'></script>

  </body>
</html>