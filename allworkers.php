<?php 
  session_start(); 
  // проверяем залогинен ли юзер
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }
  // запрашиваем из бд всех юзеров данной компании
  	$companyname = $_SESSION['companyname'];
 	$db = mysqli_connect('localhost', 'root', '123', 'registration');
  	$workers = mysqli_query($db, "SELECT * FROM `workers` WHERE `companyname`='$companyname'");
?>

<!doctype html>

<html lang="en" style='background-color:white;'>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel='stylesheet' href='css/panel.css'>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Workers list</title>
  </head>

  <body>
  		<center><h1><?php echo $_SESSION['companyname'];?> workers</h1></center> 
      <br>   
              <table class="table table-striped text-center" style='font-size:20px;'>
                    <thead>
                      <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = mysqli_fetch_array($workers)){ ?>
                        <tr>
                          <td><?php echo $row['user']; ?></td>
                          <td><?php echo $row['realname']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['role']; ?></td>

                        </tr>
                      <?php } ?>
                      
                    </tbody>
        </table>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>