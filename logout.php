<!-- уничтожаем сессию при помощи session_destroy и выкидываем пользователя на главную страницу -->
<?php session_start(); session_destroy();
header('location: index.php'); ?>

