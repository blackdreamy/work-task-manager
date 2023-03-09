<?php  
// провряем залогинен ли работяга
    session_start();
   if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }
// если на жали кнопку просмотра таска, то отрисовываем в модальное окно всю инфу о таске
 if(isset($_POST["task_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "123", "registration");  
      $query = "SELECT * FROM `tasks` WHERE id = '".$_POST["task_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered" id="modalinfo">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Reason</label></td>  
                     <td width="70%">'.$row["reason"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Type</label></td>  
                     <td width="70%">'.$row["type"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Place</label></td>  
                     <td width="70%">'.$row["place"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Object adress</label></td>  
                     <td width="70%">'.$row["adress"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Comment</label></td>  
                     <td width="70%">'.$row["commentary"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Client contact</label></td>  
                     <td width="70%">'.$row["phone"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Worker name</label></td>  
                     <td width="70%">'.$row["workername"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Create data</label></td>  
                     <td width="70%">'.$row["dataadd"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Status</label></td>  
                     <td width="70%">'.$row["status"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Start time</label></td>  
                     <td width="70%">'.$row["starttime"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Finish time</label></td>  
                     <td width="70%">'.$row["finishdate"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Check on map</label></td>  
                     <td width="70%"><a href="https://maps.google.com?q='.$row["lat"].','.$row["lng"].'" id="maplink">Click me!</a></td>  
                </tr> 


                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
