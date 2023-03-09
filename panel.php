<!-- если сессия активна, то редиректим юзера на страницу логина -->
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }
 
?>

<?php
	//Добавить таск
	//коннект к бд
	$db = mysqli_connect('localhost', 'root', '123', 'registration');
	$companyname =  $_SESSION['companyname'];


	//delete task
	if (isset($_GET['del_task'])){
		$id = $_GET['del_task'];
    	$results = mysqli_query($db, "SELECT * FROM `tasks` WHERE `id`='$id'");
    	$fromsql = mysqli_fetch_array($results);
		if ($fromsql['companyname'] == $_SESSION['companyname']){
					mysqli_query($db, "DELETE FROM `tasks` WHERE `id`=$id");
					header ('location: panel.php');
		}
		
	}
	
	// получаем с бд все таски и всех работяг компании юзера
	$tasks = mysqli_query($db, "SELECT * FROM `tasks` WHERE `companyname`='$companyname' ORDER BY `finishdate` ASC");
	$workers = mysqli_query($db, "SELECT * FROM `workers` WHERE `companyname`='$companyname'");

?>
<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel='stylesheet' href='css/panel.css'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
 
    <title>Panel</title>
  </head>

  <body>
  	<nav class="navbar navbar-light header">
  			<a class="navbar-brand" href="/panel.php">
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


    <div class='container-fluid' id='maincontainer' id='maincontainer'>  
      <div class="row">
        <div class="col-2" id='leftdiv'>
        	<button type="button" name="age" id="add_button" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success"><i class="fas fa-plus"></i>New Task</button>
			<ul class='nav nav-sidebar'>
				<li><a href="/allworkers.php">
                    <span class="sidebar-icon-wrapper"><i class="fas fa-users"></i></span><span class="sidebar-item-text">Employees</span>
                </a></li>
                <li><a href="/adduser.php">
                    <span class="sidebar-icon-wrapper"><i class="fas fa-user-plus"></i></span><span class="sidebar-item-text">Add an employee</span>
                </a></li>
			</ul>
			</div>
        		<div class="col-10 text-center" id='tasksdiv'><h2>Current tasks</h2>
					<table id='taskstable'>
						<thead>
							<tr>
								<th id='title1'>Title</span></th>
								<th id='type'>Type</th>
								<th id='place'>Place</th>
								<th id='object'>Object<br>Adress</th>
								<th id='comment'>Comment</th>
								<th id='contact'>Client<br> contact</th>
								<th id='workername'>Responsible <br> person</th>
								<th id='create'>Create Time</th>
								<th id='status'>Status</th>
								<th id='start'>Start Time</th>
								<th id='finish'>Finish time</th>
								<th id ='edit'></th>
                <th id ='edit'></th>
								<th id = 'del'></th>
							</tr>
						</thead>
						<tbody>
							<?php while ($row = mysqli_fetch_array($tasks)){ ?>
								<tr>
								<td class='time' id='reason'><span class='tdspan1'><?php echo $row['reason']; ?></span></td>
								<td class='time' id='type'><span class='tdspan1'><?php echo $row['type']; ?></span></td>
								<td class='time' id='place'><span class='tdspan1'><?php echo $row['place']; ?></span></td>
								<td class='time' id='adress'><span class='tdspan2' ><?php echo $row['adress']; ?></span></td>
								<td class='time' id='commentary'><span class='tdspan2' ><?php echo $row['commentary']; ?></span></td>
								<td class='time' id='phone'><span class='tdspan2' ><?php echo $row['phone']; ?></span></td>
								<td class='time' id='workername'><span class='tdspan2' ><?php echo $row['workername']; ?></span></td>
								<td class='time' id='date'><span class='tdspan2' ><?php echo $row['dataadd']; ?></span></td>
								<td class='rarity' id='rarity'><span class='tdspan2' ><?php echo $row['status']; ?></span></td>
								<td class='time' id='timefinish'><span class='tdspan2' ><?php echo $row['starttime']; ?></span></td>
								<td class='time' id='timestart'><span class='tdspan2' ><?php echo $row['finishdate']; ?></span></td>
								<td class='time'><input type="button" name="view" value="&#xf002" id="<?php echo $row["id"]; ?>" class="fa btn btn-info btn-xs view_data editbutton" /></td>
               				    <td class='time'><input type="button" name="edit" value="&#xf044" id="<?php echo $row["id"]; ?>" class="fas btn btn-info btn-xs edit_data editbutton" /></td> 
								<td id='del'>
									<a class='delete' href="panel.php?del_task=<?php echo $row['id']; ?>">X</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
        		</div>	
      </div>   
    </div>





	<script src="src/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script src='js/panel.js'></script>
    <script src='js/view.js'></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_xfMkOX1D5CWpVQn8wSu0Nvv9fcwAWf4&language=en&region=GB&libraries=places"></script>
	<script src='js/maps.js'></script>
 
  </body>
</html>

<!-- task details modal window -->
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                	<h4 class="modal-title">Task details</h4> 
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

<!-- add data in sql modal -->
 <div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
   	<h4 class="modal-title" id='modaltitle'>New task</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Title</label>
     <input type="text" name="reason" id="reasonm" class="form-control" />
     <br />
     <label>Type</label>
     <textarea name="type" id="typem" class="form-control" type="number"></textarea>
     <br />
     <label>Place</label>
     <textarea name="place" id="placem" class="form-control"></textarea>
     <br />
     <label>Object adress</label>
     <textarea name="adress" id="adressm" class="form-control"></textarea>
     <br />
     <label>Comment</label>
     <textarea name="commentary" id="commentarym" class="form-control"></textarea>
     <br />
     <label>Contact number</label>
     <textarea name="phone" id="phonem" class="form-control"></textarea>
     <br />
     <label>Worker name</label>
     <select name="workername" id="workernamem" class="form-control">
			<<?php while ($row1 = mysqli_fetch_array($workers)){ ?>
								<option><?php echo $row1['realname']; ?></option>
						<?php } ?>
     </select>
     <label id='maplabel' style='margin-top:30px;'>Check on map</label>
     	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
     	<div id="map" style="width:100%;height:380px;"></div>
     <br />
     <input type='hidden' name='lat' id='lat' value='0'>  
	 <input type='hidden' name='lng' id='lng' value='0'> 
     <input type="hidden" name="task_id" id="task_id" /> 
     <br />  
 
     <input type="submit" name="insert" id="insert" value="Add task" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id='closebutton'>Close</button>
   </div>
  </div>
 </div>
</div>

<!-- profile modal -->
<div id="profileModal" class="modal fade show" >  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                	<h4 class="modal-title">Hello,  <?php echo $_SESSION['username']; ?></h4> 
                     <button type="button" class="close" data-dismiss="modal">×</button>  
                </div>  
                <div class="modal-body" id="task_detail">  
      <div class="table-responsive">  
           <table class="table table-bordered" id="modalinfo">  
                <tbody><tr>  
                     <td width="30%"><label>Your login</label></td>  
                     <td width="70%"><p><?php echo $_SESSION['username']; ?></p></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Your companyname</label></td>  
                     <td width="70%"><p><?php echo $_SESSION['companyname']; ?></p></td>  
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
