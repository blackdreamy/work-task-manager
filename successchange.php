<!-- Это страница которую видно, после того как работяга изменил пароль, через 2 секунды отсюда перекидывает на сраницу панели -->
<?php 
  session_start(); 

  if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Sucess!
	</title>
</head>

<body>
	<center><h1 style='color:green;'>Success!</h1></center>

	<script>setTimeout(function(){
  window.location.href = '/workerpanel.php';
}, 2 * 1000); </script>
</body>
</html>