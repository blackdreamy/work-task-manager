  <?php 
    session_start(); 
    //проверка логина работяги
  if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  } 
  else {
  //коннект к бд
 $connect = mysqli_connect("localhost", "root", "123", "registration");  
 // если работяга нажал на старт таска, то обновляем в бд статус таска на In process и добавляем время начала задания
 if(isset($_POST["task_id"]))  
 {  
 	date_default_timezone_set("Europe/Moscow");
    $time = date('Y-m-d H:i:s');
 	$query = "  
        UPDATE tasks   
        SET 
	    `status` = 'Ongoing',
	    `starttime` = '$time'
        WHERE id='".$_POST["task_id"]."'";  
        $message = 'Data Updated';  
      $result = mysqli_query($connect, $query);  
      
 }  
 }
 ?>