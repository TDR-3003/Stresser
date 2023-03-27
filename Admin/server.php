<?php
 $page = 'Server';
 include"admin.php";
  function generateRandomString($length = 10){
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for($i=0;$i<$length;$i++){
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  $names = generateRandomString(15);
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Server</h4><div class="ml-auto">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-primary active" aria-current="page"><?php echo $info["nom"]; ?></li>
                <li class="breadcrumb-item text-muted" aria-current="page">/ <?php echo $page; ?></li>
              </ol>
            </nav>
          </div>
                        </div>
                     </div>
                  </div>
				<?php 
				if (isset($_POST['okBtn']))
				{
					$nameAdd = $_POST['nameAdd'];
					$adresseAdd = $_POST['adresseAdd'];
					$concurrents = $_POST['concu'];
					$osi = $_POST['osi'];
					if (empty($adresseAdd))
					{
						echo '<center><div class="alert alert-danger"><strong>Incident:</strong> An error has occurred, information is missing.</div></center>';
					}
						else
						{
							$SQLinsert = $odb -> prepare("INSERT INTO `serveurs` VALUE(NULL, :name, :adresse, 0, :concu, 0, :osi, UNIX_TIMESTAMP(NOW()))");
							$SQLinsert -> execute(array(':name' => $nameAdd, ':adresse' => $adresseAdd, ':concu' => $concurrents, ':osi' => $osi));
							echo '<div class="alert alert-success"><strong>Very well!</strong> A new server has been added to the database.</div>';
							

				            $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                            $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Adding a new server'));
						}
				}
				
				if (isset($_POST['suprBtn']))
						{
							$deletes = $_POST['deleteCheck'];
							if (!empty($deletes))
							{
								foreach($deletes as $delete)
								{
									$SQL = $odb -> prepare("DELETE FROM `serveurs` WHERE `ID` = :id LIMIT 1");
									$SQL -> execute(array(':id' => $delete));
								}
								echo '<meta http-equiv="refresh" content="0;"';
							}
						}
				?> <div class="row">
<div class="col-md-12">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Add Servers                              </div>
                           </div>
                           <div class="card-body"><p class="card-description">
                    if Layer 4 <code>?host=%hote%&port=%port%&time=%temps%&type=%type%&user=%user%</code>
                  </p>
                  <p class="card-description">
                    if Layer 7 <code>?hote=%hote%&temps=%temps%&type=%type%&reqmethod=%reqmethod%&rate=%rate%&host=%host%&origin=%origin%&post=%post%</code>
                  </p>
                  <form class="forms-sample" method="POST">
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" value="<?php echo $names; ?>" placeholder="Ex: NTP Amplification...." name="nameAdd">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="adresse" class="col-sm-3 col-form-label">API</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="adresse" value="?host=%hote%&port=%port%&time=%temps%&type=%type%&user=%user%" name="adresseAdd">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="concurrents" class="col-sm-3 col-form-label">Concurrents</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="concurrents" value="10" name="concu">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="classement" class="col-sm-3 col-form-label">Type</label>
                      <div class="col-sm-9">
                      <select class="form-control" name="osi">
						<option value="4">Layer 4</option>
						<option value="7">Layer 7</option>
					    </select>                      </div>
                    </div>
                    <div class="form-check form-check-flat form-check-primary">                      
                    </div>
                    <button type="submit" name="okBtn" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>


<div class="col-md-12">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Servers                              </div>
                           </div>
                           <div class="card-body">
                  <form method="POST">
                  <div class="table-responsive">
                    <table class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Check</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>API</th>
                          <th>Concurrents</th>
                          <th>Layer</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
<?php

									  $SQLSelect = $odb -> query('SELECT * FROM `serveurs` ORDER BY `ID` ASC');
									  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
									  {
										$rowID = $show['ID'];
										$name = $show['name'];
										$concurrents = $show['concurrents'];
										$osi = $show['type'];
		if($show['status'] == 1){ $status = '<i class="bx mr-2 bx-x text-danger"></i> Offline'; }
        if($show['status'] == 2){ $status = '<i class="fa fa-spinner fa-spin"></i> Maintenance'; }
        if($show['status'] == 0){ $status = '<i class="mdi mdi-checkbox-marked-circle-outline text-success"></i> Online'; }
?>
<td>
<div class="form-check form-checkbox-outline form-check-success mb-3">
                                                    <input class="form-check-input" type="checkbox" name="deleteCheck[]" value="<?php echo $rowID; ?>"></td>
<td><a style="color:blu" href="edits/<?php echo htmlspecialchars($rowID); ?>"><u><?php echo htmlspecialchars($rowID); ?></u></a></td>
<td><?php echo $name; ?></td>
<td>...</td>
<td><?php echo $concurrents; ?></td>
<td><?php echo $osi; ?></td>
<td><?php echo $status; ?></td>
</tr>
<?php } ?>	
                      </tbody>
                    </table>
                 
                <div class="form-check form-check-flat form-check-primary">                      
                    </div>
			  <button type="submit" name="suprBtn" class="pull-right btn btn-danger  waves-effect"><i class="icon-trash menu-icon"></i> Delete</button>
                  </form>
              </div>
            </div>
      	
		   </div></div></div>
  </div>      <!-- partial:partials/_footer.html -->
<?php include'footer.php'; ?> 

            </div>
        </div>

        <div class="rightbar-overlay"></div>

    </body>
</html>