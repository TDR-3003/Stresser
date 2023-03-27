<?php
 $page = 'Licenses';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Licenses</h4><div class="ml-auto">
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
				if (isset($_POST['addBtn']))
				{
					$nameAdd = $_POST['nameAdd'];
					$unit = $_POST['unit'];
					$length = intval($_POST['length']);
					$mbtAdd = intval($_POST['mbt']);
					$nbrAdd = intval($_POST['nbr']);
					$apiAdd = intval($_POST['api']);
					$prix = intval($_POST['prix']);
					
					if (empty($nameAdd) || empty($mbtAdd) || empty($nbrAdd) || empty($prix) || empty($apiAdd) || empty($length))
					{
						echo '<center><div class="alert alert-danger"><strong>Incident!</strong> Some fields are not filled in correctly.</div></center>';
					}
					else
					{
						$codeAdd = $prix*100+1;
						$SQLinsert = $odb -> prepare("INSERT INTO `plans` VALUES(NULL, :name, :code, :mbt, :unit, :length, :nbr, :api, :eur)");
						$SQLinsert -> execute(array(':name' => $nameAdd, ':code' => $codeAdd, ':mbt' => $mbtAdd , ':unit' => $unit, ':length' => $length, ':nbr' => $nbrAdd, ':api' => $apiAdd, ':eur' => $prix));
						echo '<center><div class="alert alert-success"><strong>Very good!</strong> A new license has been added to the database.</div></center>';
						

				        $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                        $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Adding a new license '.$nameAdd.''));
					}
				}
				
		if (isset($_POST['deleteBtn']))
		{
			$deletes = $_POST['deleteCheck'];
			foreach($deletes as $delete)
			{
				$SQL = $odb -> prepare("DELETE FROM `plans` WHERE `ID` = :id LIMIT 1");
				$SQL -> execute(array(':id' => $delete));
				

				$SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Supression of one or more licenses.'));
			}
		}
				?><div class="row">
<div class="col-md-12">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Add Plans                              </div>
                           </div>
                           <div class="card-body">
                  <form class="forms-sample" method="POST">
                    <div class="form-group row">
                      <label for="nameAdd" class="col-sm-3 col-form-label">Souscription</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nameAdd" name="nameAdd">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="prix" class="col-sm-3 col-form-label">Price in €</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="prix" name="prix">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="mbt" class="col-sm-3 col-form-label">Number of seconds</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="mbt" name="mbt">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nbr" class="col-sm-3 col-form-label">Number of simultaneous shipments</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nbr" name="nbr">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="prix" class="col-sm-3 col-form-label">Price in €</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="prix" name="prix">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="api" class="col-sm-3 col-form-label">Access API utilities</label>
                      <div class="col-sm-9">
                      <select class="form-control" name="api">
						<option value="1">Oui</option>
					    <option value="0">Non</option>
					    </select>                      </div> </div>
					                        <div class="form-group row">
                      <label for="length" class="col-sm-3 col-form-label">Duration</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="length" name="length" value="1">
                      </div>
                    </div>
                                        <div class="form-group row">
                      <label for="unit" class="col-sm-3 col-form-label">Period</label>
                      <div class="col-sm-9">
                      <select class="form-control" name="unit">
						<option value="Months" selected="">Months</option>
					    <option value="Years">Years</option>
					    </select>                      </div> </div>
                   
                    <div class="form-check form-check-flat form-check-primary">                      
                    </div>
                    <button type="submit" name="addBtn" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
<div class="col-md-12">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Plans                              </div>
                           </div>
                           <div class="card-body">
                  <form method="POST">
                  <div class="table-responsive">
                    <table class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Check</th>
                          <th>Name</th>
                          <th>Seconds</th>
                          <th>Concurrent</th>                          
                          <th>API</th>
                          <th>Duration</th>                            
                        </tr>
                      </thead>
                      <tbody>
<?php
				  $SQLSelect = $odb -> query("SELECT * FROM `plans` ORDER BY `ID` ASC");
				  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
				  {
					$planName = $show['name'];
					$mbtShow = $show['mbt'];
                    $nbrShow = $show['nbr'];
					$api = $show['api'];
					$length = $show['length'];
					$unit = $show['unit'];
					$rowID = $show['ID'];
					?>
				    <tr>
					<td>
<div class="form-check form-checkbox-outline form-check-success mb-3">
                                                    <input class="form-check-input" type="checkbox" name="deleteCheck[]" value="<?php echo $rowID; ?>"></td>
					<td><a style="color:blu" href="edit/<?php echo $rowID; ?>"><u><?php echo htmlspecialchars($planName); ?></u></a></td>
					<td><?php echo $mbtShow; ?></td>
					<td><?php echo $nbrShow; ?></td>
					<td><?php if($api != "0") { echo"Oui"; } else { echo "Non"; } ?></td>
					<td><?php echo $length." ".$unit; ?></td>
					</tr>
                  <?php } ?>
	
                      </tbody>
                    </table>
                 
                <div class="form-check form-check-flat form-check-primary">                      
                    </div>
                			  <button type="submit" name="deleteBtn" class="pull-right btn btn-danger  waves-effect"><i class="icon-trash menu-icon"></i> Delete</button>
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
