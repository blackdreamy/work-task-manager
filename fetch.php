  <?php 
    session_start(); 
// провряем залогинен ли работяга
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  } 
// подключаемся к бд, получаем данные о таски по его id, отдаем обратно на страницу всю инфу, которая отрисуется в модальное окно
 $connect = mysqli_connect("localhost", "root", "123", "registration");  
 if(isset($_POST["task_id"]))  
 {  
      $query = "SELECT * FROM tasks WHERE id = '".$_POST["task_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>