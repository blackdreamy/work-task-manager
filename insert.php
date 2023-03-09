
<?php

  session_start(); 
  //проверяем залогинен ли юзер
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }
  //подклюяаем файл в котором лежат функции отправки мейлов
include('sendmail.php');
  //коннект к бд
$connect = mysqli_connect("localhost", "root", "123", "registration");
// если нажали на добавления таска, то получаем всю инфу из полей информации
if(!empty($_POST))
{
 	$output = '';
    $reason = $_POST['reason'];
    $type = $_POST['type'];
    $place = $_POST['place'];
    $adress = $_POST['adress'];
    $commentary = $_POST['commentary'];
    $phone = $_POST['phone'];
    $workername = $_POST['workername'];
    $status = 'Not started';
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    //меняем время, чтобы в бд добавлялось по текущему часовому поясу мск
    date_default_timezone_set("Europe/Moscow");
    $time = date('Y-m-d H:i:s');
    $timehours = date('H:i:s');
    $companyname =  $_SESSION['companyname'];
    //засовываем в таблицу

    //если изменяем таск, то обновляем всю инфу нужного таска по id
    if($_POST["task_id"] != '')  
      {  
           $query = "  
           UPDATE tasks   
           SET `reason`='$reason',   
           `type`='$type',   
           `place`='$place',   
           `adress` = '$adress',   
           `commentary` = '$commentary',
		   `phone` = '$phone',
		   `workername` = '$workername'
           WHERE id='".$_POST["task_id"]."'";  
           $message = 'Data Updated';  
      }  
      // если добавляем новый,то просто создаем новую строку в бд
	else  
      {  
        $query="INSERT INTO `tasks`(`reason`,`type`,`place`,`adress`,`commentary`,`phone`,`workername`,`companyname`,`dataadd`,`status`,`lat`,`lng`) VALUES ('$reason','$type','$place','$adress','$commentary','$phone','$workername','$companyname','$time','$status','$lat','$lng')";
           $message = 'Data Inserted';  
      }  

      // инциируем запрос в бд
    if(mysqli_query($connect, $query))
    {
      // получаем инфу из бд о работяге, которого выбрали в таске
      $queryUser = "SELECT * FROM `workers` WHERE `companyname`='$companyname' AND `realname`='$workername'";
      $results = mysqli_query($connect, $queryUser);
      $fromsql = mysqli_fetch_array($results);
      //отправляем работяге на мыло инфу о том, что был добавлен новый таск
      sendNotification($fromsql['email'], $fromsql['realname'], $time);
    }
    

}
?>
