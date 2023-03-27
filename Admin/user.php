<?php
$page = 'User';
include"admin.php";

if(is_numeric($_GET['id']) == false) {
header('Location: users');
exit;
}
$id = $_GET['id'];
$SQLGetInfo = $odb -> prepare("SELECT * FROM `users` WHERE `ID` = :id LIMIT 1");
$SQLGetInfo -> execute(array(':id' => $id));
$userInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
$username = $userInfo['username'];
$rank = $userInfo['rank'];
$membership = $userInfo['membership'];
$status = $userInfo['status'];
$points = $userInfo['points'];
$secs = $userInfo['secs'];
$concu = $userInfo['concu'];
$motifban = $userInfo['motifban'];
$active = $userInfo['active'];
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">User</h4><div class="ml-auto">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-primary active" aria-current="page">Downthem.in</li>
                <li class="breadcrumb-item text-muted" aria-current="page">/ User</li>
              </ol>
            </nav>
          </div>
                        </div>
                     </div>
                  </div>


                 
 <?php 
				   if (isset($_POST['rBtn']))
				   {
					$sql = $odb -> prepare("DELETE FROM `users` WHERE `ID` = :id");
					$sql -> execute(array(':id' => $id));
						echo'<meta http-equiv="refresh" content="0; URL=utilisateurs">';
						
			
				    $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                    $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Deleting the user '.$username.''));
				   }
				   if (isset($_POST['updateBtn']))
				   {
					$update = false;
					if ($username!= $_POST['username'])
					{
						if (ctype_alnum($_POST['username']) && strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 15)
						{
							$SQL = $odb -> prepare("UPDATE `users` SET `username` = :username WHERE `ID` = :id");
							$SQL -> execute(array(':username' => $_POST['username'], ':id' => $id));
							$update = true;
							$username = $_POST['username'];
							
						}
						else
						{
							echo '<center><div class="alert alert-warning"><strong>Oops!</strong> Choose a nickname with at least 4-5 characters.</div></center>';
						}
					}
					if (!empty($_POST['password']))
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `password2` = :password WHERE `ID` = :id");
						$SQL -> execute(array(':password' => SHA1($_POST['password']), ':id' => $id));
						$update = true;
						$password = SHA1($_POST['password']);
					}
					if (!empty($_POST['motifban']))
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `motifban` = :motifban WHERE `ID` = :id");
						$SQL -> execute(array(':motifban' => $_POST['motifban'], ':id' => $id));
						$update = true;
						$motifban = $_POST['motifban'];
					}
					
					if ($rank != $_POST['rank'])
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `rank` = :rank WHERE `ID` = :id");
						$SQL -> execute(array(':rank' => $_POST['rank'], ':id' => $id));
						$update = true;
						$rank = $_POST['rank'];
					}
					if ($points != $_POST['points'])
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `points` = :points WHERE `ID` = :id");
						$SQL -> execute(array(':points' => $_POST['points'], ':id' => $id));
						$update = true;
						$points = $_POST['points'];
					}
					if ($concu != $_POST['concu'])
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `concu` = :concu WHERE `ID` = :id");
						$SQL -> execute(array(':concu' => $_POST['concu'], ':id' => $id));
						$update = true;
						$concu = $_POST['concu'];
					}
					if ($secs != $_POST['secs'])
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `secs` = :secs WHERE `ID` = :id");
						$SQL -> execute(array(':secs' => $_POST['secs'], ':id' => $id));
						$update = true;
						$secs = $_POST['secs'];
					}
					if ($membership != $_POST['plan'])
					{
						if ($_POST['plan'] == 0)
						{
							$SQL = $odb -> prepare("UPDATE `users` SET `expire` = '0', `membership` = '0', `secs` = '0', `concu` = '0' WHERE `ID` = :id");
							$SQL -> execute(array(':id' => $id));
							$update = true;
							$membership = $_POST['plan'];
						}
						else
						{
							$getPlanInfo = $odb -> prepare("SELECT `unit`,`length` FROM `plans` WHERE `ID` = :plan");
							$getPlanInfo -> execute(array(':plan' => $_POST['plan']));
							$plan = $getPlanInfo -> fetch(PDO::FETCH_ASSOC);
							$unit = $plan['unit'];
							$length = $plan['length'];
							$newExpire = strtotime("+{$length} {$unit}");
							$updateSQL = $odb -> prepare("UPDATE `users` SET `expire` = :expire, `membership` = :plan WHERE `id` = :id");
							$updateSQL -> execute(array(':expire' => $newExpire, ':plan' => $_POST['plan'], ':id' => $id));
							$update = true;
							$membership = $_POST['plan'];
						}
					}
					
					if ($status != $_POST['status'])
					{
						$SQL = $odb -> prepare("UPDATE `users` SET `status` = :status WHERE `ID` = :id");
						$SQL -> execute(array(':status' => $_POST['status'], ':id' => $id));
						$update = true;
						$status = $_POST['status'];
					}
					if ($update == true)
					{
						echo '<center><div class="alert alert-success"><strong>Very good!</strong> The user\'s settings have been successfully updated.</div></center>';
					}
					else
					{
						echo '<center><div class="alert alert-danger"><strong>Incident!</strong> No updates were successful.</div></center>';
					}
					
			
				$SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Changing user settings '.$username.''));
			}
					
		if (isset($_POST['envoyer']))
	   {  
			$contenu = ($_POST['contenu']);
			$errors = array();
			if (empty($contenu))
			{
				$errors[] = 'Information is missing, please fill in all fields';
			}
			if (empty($errors))
			{
				$SQLinsert = $odb -> prepare("INSERT INTO `courrier` VALUES(NULL, :sujet, :contenu, :username, 0, UNIX_TIMESTAMP())");
				$SQLinsert -> execute(array(':sujet' => 'Message By Admin', ':contenu' => $contenu, ':username' => $username));
				echo '<div class="alert alert-success"><strong>Very good!</strong> Your message has been successfully forwarded to '.$username.'</div>';
				
			
				$SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Sending a notification to the user '.$username.''));
			}
			else
			{
				echo '<div class="alert alert-danger"><strong>Incident !</strong>
';
				foreach($errors as $error)
				{
					echo ''.$error.'.';
				}
				echo ' </div>';
			}
		}
				   ?>	<div class="row" method="POST">
				   	<form method="POST">
				                       <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">USER = <?php echo $username;?></h4>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Info" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Info</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Addons" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Addons</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#buy" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">Buy</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Logs" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">Logs</span>
                                        </a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#API" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">API</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#LOGIN" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">Login Logs</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="Info" role="tabpanel">
 <div class="form-group">											

										<label for="username" class="col-md-4">Username</label>

										<div class="col-md-12">

											<input type="text" class="form-control"  name="username" value="<?php echo $username;?>">

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->

									
									<div class="form-group">											

										<label class="col-md-4">New password</label>

										<div class="col-md-12">

											<input type="text" class="form-control"  name="password">

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->

									




									

									<div class="form-group">											

										<label class="col-md-12" for="lastname">Rank</label>

										<div class="col-md-12">

							<select class="form-control" name="rank">
								<?php
								function selectedR($check, $rank)
								{
									if ($check == $rank)
									{
										return 'selected="selected"';
									}
								}
								?>
                                <option value="0" <?php echo selectedR(0, $rank); ?> >User</option>
                                <option value="1" <?php echo selectedR(1, $rank); ?> >Administrator</option>
                            </select>

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->

									

									

									<div class="form-group">											

										<label class="col-md-4" for="email">Subscription</label>

										<div class="col-md-12">

						  <select class="form-control" name="plan">
							 <option value="0">No subscription</option>
								<?php 
									$SQLGetMembership = $odb -> query("SELECT * FROM `plans` ORDER BY `ID` ASC");
									while($memberships = $SQLGetMembership -> fetch(PDO::FETCH_ASSOC))
									{
										$mi = $memberships['ID'];
										$mn = $memberships['name'];
										$selectedM = ($mi == $membership) ? 'selected="selected"' : '';
										echo '<option value="'.$mi.'" '.$selectedM.'>'.$mn.'</option>';
									}
								?>
                           </select>

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->


                           <div class="form-group">											

										<label class="col-md-4" for="email">State</label>

										<div class="col-md-12">

						   <select class="form-control" name="status">
								<?php
								function selectedS($check, $rank)
								{
									if ($check == $rank)
									{
										return 'selected="selected"';
									}
								}
								?>
                                <option value="0" <?php echo selectedS(0, $status); ?>>Active</option>
                                <option value="1" <?php echo selectedS(1, $status); ?>>Banned</option>
                            </select>

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->
							

									

									<div class="form-group">											

										<label for="firstname" class="col-md-4">Reason for restriction</label>

										<div class="col-md-12">

											<input type="text" class="form-control" value="<?php echo $motifban; ?>" name="motifban">

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->
					

										<br>

									

										

									<div class="form-group">



										<div class="col-md-offset-4 col-md-12">

											<button type="submit" name="updateBtn" class="btn btn-primary">Save</button> 

										</div>

									</div>  
                                    </div>
                                    <div class="tab-pane" id="Addons" role="tabpanel">
<div class="form-group">											

										<label for="username" class="col-md-4">Additional seconds</label>

										<div class="col-md-12">

											<input type="text" class="form-control"  name="secs" value="<?php echo $secs;?>">

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->

									<br>
									<div class="form-group">											

										<label for="username" class="col-md-4">Number of additional simultaneous shipments</label>

										<div class="col-md-12">

											<input type="text" class="form-control"  name="concu" value="<?php echo $concu;?>">

										</div> <!-- /controls -->				

									</div> <!-- /control-group -->
                                     <br>
									<div class="form-group">											

										<label for="username" class="col-md-4">Balance Sheet Name</label>

										<div class="col-md-12">

											<input type="text" class="form-control"  name="points" value="<?php echo $points;?>">

										</div> <!-- /controls -->				

									</div>
                                    </div>
                                    <div class="tab-pane" id="buy" role="tabpanel">
                                       	
 <div class="form-group">											
            
			
                                          <table class="table table-bordered dt-responsive  nowrap w-100">

                  <thead>
                    <tr>
					<th>Licence / Service</th>
					<th>Status</th>
					<th>Date of purchase</th>
                    </tr>
                    </thead>
                    <tbody>
				            <?php 
			$SQLGetBTC = $odb -> prepare("SELECT * FROM `historique` WHERE `username` = :username ORDER BY `id` DESC");
			$SQLGetBTC -> execute(array(':username' => $username));
			while ($getInfo = $SQLGetBTC -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['id'];
				$licence = $getInfo['licence'];
				$statut = $getInfo['statut'];
				$date = $getInfo['date'];
				echo '
                            
                            <tr>
                                <td>'.$licence.'</td>
                                <td>'.$statut.'</td>
								<td>'.strftime("%d %B - %H:%M", $getInfo['date']).'</td>
                            </tr>';
			}
			?>
			      </tbody>
                </table>
              </div>
			 
                                    </div>
                                    <div class="tab-pane" id="Logs" role="tabpanel">
<div class="form-group">											
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                  <thead>
                    <tr>
					<th>Target</th>
                    <th>Time</th>
                    <th>Servers</th>
                    <th>Methods</th>
                    <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
						     <?php
                                $req = $odb->query('SELECT * FROM logs WHERE user="'.$username.'" ORDER BY `date` DESC');
                                while($data = $req->fetch(PDO::FETCH_ASSOC)):
                             ?>
							<tr>
						    <td><?php echo htmlspecialchars($data['ip']); ?>:<?php echo $data['port']; ?></td>
							<td><?php $time = $data['time'];
							if($time != "0"){ echo $data['time']; } else { echo '<span class="label label-danger">Stopped</span>'; }?></td>
							<td><?php echo $data['serveur']; ?></td>
							<td><?php echo $data['method']; ?></th>
							<td><?php echo strftime("%A %d %B %Y à %Hh%M", $data['date']); ?></td>
                            </tr>
                            <?php endwhile; ?>
			      </tbody>
                </table>			

									</div> 
                                            </div>  
                            


		<div class="tab-pane" id="API" role="tabpanel">

 <div class="form-group">											
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                  <thead>
                    <tr>
					<th>Clé</th>
					<th>Type</th>
					<th>Valeur</th>
					<th>Adresse IP</th>
					<th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
				            <?php 
			$SQLGetBTC = $odb -> prepare("SELECT * FROM `api_historique` WHERE `username` = :username ORDER BY `id` DESC");
			$SQLGetBTC -> execute(array(':username' => $username));
			while ($getInfo = $SQLGetBTC -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['id'];
				$clef = $getInfo['clef'];
				$type = $getInfo['type'];
				$value = $getInfo['value'];
				$ip = $getInfo['ip'];
				$date = $getInfo['date'];
				echo '
                            
                            <tr>
                                <td>'.$clef.'</td>
								<td>'.htmlspecialchars($type).'</td>
                                <td>'.htmlspecialchars($value).'</td>
								<td>'.$ip.'</td>
								<td>'.strftime("%d %B - %H:%M", $getInfo['date']).'</td>
                            </tr>';
			}
			?>
			      </tbody>
                </table>			

									</div> </div>                                                                                                                         

                               	<div class="tab-pane" id="LOGIN" role="tabpanel">

									<div class="form-group">											
                                <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                  <thead>
                    <tr>
                    <th>IP Address</th>
                    <th>Statue</th>
                    <th>Connection Date</th>
                    </tr>
                    </thead>
                    <tbody>
				<?php
				$req = $odb -> query('SELECT * FROM loginlogs WHERE username="'.$username.'" ORDER BY `date` DESC');
				while($data = $req -> fetch(PDO::FETCH_ASSOC)):
                  ?>
                    <tr>
					<td><?php echo $data['ip']; ?></td>
					<td><?php echo $data['status']; ?></td>
                    <td><?php echo strftime("%d %B %Y à %Hh%M", $data['date']); ?></td>
                    </tr>
                    <?php endwhile; ?>
			      </tbody>
                </table>			

									</div>
                                            </div>
                                        </div>
                                    </div></form>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>


<?php include'footer.php'; ?> 

            </div>
        </div>

        <div class="rightbar-overlay"></div>
    </body>
</html>

					
