<!-- Это страница которую видно, после того как админ создал аккаунт работяги, через 2 секунды отсюда перекидывает на сраницу админ-панели -->
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
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
  window.location.href = '/panel.php';
}, 2 * 1000); </script>
</body>
</html>