
<?php
// проверяем залогинен ли работяга, если нет - отправляем на главную страницу. 
  session_start(); 
  if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
	}
	// логин к бд
  	$db = mysqli_connect('localhost', 'root', '123', 'registration');
  	$companyname = $_SESSION['companyname'];
  	$myname = $_SESSION['realname'];
  	$status = 'Finished';
  	//грузим все таски из бд, который еще не начаты или в процессе
  	$tasks = mysqli_query($db, "SELECT * FROM `tasks` WHERE `companyname`='$companyname' AND `workername` = '$myname' AND `status`!='$status' ");
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/workerpanel.css">
    <title>Worker panel</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  </head>
  <body>
	<div class="col-xs-12">
  		<nav class="navbar navbar-light header">
  			<a class="navbar-brand" href="/workerpanel.php">
    	<img src="/img/logo.png" height="30" alt="">
		  	</a>
		  	<span class="navbar-text">
		  		<div class='icons'>
     		 <i class="fas fa-user-alt" id='usericon'></i>
     		 <i class="fas fa-lock" id='passwordicon'></i>
     		 <i class="fas fa-sign-out-alt" id='logouticon'></i>
     		</div>
   			 </span>
		</nav>
	</div>

		<div class="container-fluid" id='maincontainer'>
			<div class="row justify-content-center">
			<div class="col-md-9 text-center" id='content'>
				<table id='taskstable'>
				<thead>
							<tr>
								<th>Title</th>
								<th>Type</th>
								<th>Place</th>
								<th>Object adress</th>
								<th>Comment</th>
								<th>Status</th>
								<th>CreateTime</th>
								<th id='view'></th>
								<th id='thstart'></th>

							</tr>
					</thead>
						<tbody>

							<?php while ($row = mysqli_fetch_array($tasks)){ ?>
								<tr>
								<td id='reason'><span class='tdspan1'><?php echo $row['reason']; ?></span></td>
								<td id='type'><span class='tdspan1' ><?php echo $row['type']; ?></span></td>
								<td id='place'><span class='tdspan1' ><?php echo $row['place']; ?></span></td>
								<td id='adress'><span class='tdspan2' ><?php echo $row['adress']; ?></span></td>
								<td id='commentary'><span class='tdspan2'><?php echo $row['commentary']; ?></span></td>
								<td id='status'><span class='tdspan2 rarity'><?php echo $row['status']; ?></span></td>
								<td id='date'><span class='tdspan2'><?php echo $row['dataadd']; ?></span></td>
								<td ><input type="button" name="view" value="&#xf002" id="<?php echo $row["id"]; ?>" class="fa btn btn-info btn-xs view_data editbutton" /></td>
								<td id='tdstart'>
								<input type="button" name="start" value="&#xf04b" id="<?php echo $row["id"]; ?>" class="fa btn btn-info btn-xs starttask editbutton" />
								<input type="button" name="finish" value="&#xf058" id="<?php echo $row["id"]; ?>" class="fa btn btn-info btn-xs  editbutton finishtask" />
								</td>
								<td id='tdfinishtime'><span class='tdspan2 starttime'><?php echo $row['starttime']; ?></span></td>
							</tr>
							<?php } ?>

						</tbody>
					</table>


			</div>
		</div></div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="src/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='js/panelworker.js'></script>
    <script src='js/viewworker.js'></script>
  </body>
</html>



<!-- task details modal window -->
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                	<h4 class="modal-title">Task description</h4> 
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="task_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal" id='closebutton'>Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 


<!-- profile modal window -->
 <div id="profileModal" class="modal fade show" >  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                	<h4 class="modal-title">Hello, <?php echo $_SESSION['user']; ?></h4> 
                     <button type="button" class="close" data-dismiss="modal">×</button>  
                </div>  
                <div class="modal-body" id="task_detail">  
      <div class="table-responsive">  
           <table class="table table-bordered" id="modalinfo">  
                <tbody><tr>  
                     <td width="30%"><label>Your companyname</label></td>  
                     <td width="70%"><p><?php echo $_SESSION['companyname']; ?></p></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Unit</label></td>  
                     <td width="70%"><p><?php echo $_SESSION['squad']; ?></p></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Role</label></td>  
                     <td width="70%"><p><?php echo $_SESSION['role']; ?></p></td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%"><p><?php echo $_SESSION['email']; ?></p></td>  
                </tr> 
                </tbody></table></div></div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal" id="closebutton">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
