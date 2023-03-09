  <?php 
    session_start(); 
    // провряем залогинен ли юзер
  if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  } 
  else {
 // подключаемся к бд
 $connect = mysqli_connect("localhost", "root", "123", "registration");  
 // если task_id передан, то обновляем статус таска в finished и добавляем время окончания таска
 if(isset($_POST["task_id"]))  
 {  
 	date_default_timezone_set("Europe/Moscow");
    $time = date('Y-m-d H:i:s');
 	$query = "  
        UPDATE tasks   
        SET 
	    `status` = 'Finished',
	    `finishdate` = '$time'
        WHERE id='".$_POST["task_id"]."'";  
        $message = 'Data Updated';  
      $result = mysqli_query($connect, $query);  
      
 }  
 }
 ?>