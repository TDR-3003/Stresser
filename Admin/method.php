<?php
 $page = 'Method';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Method</h4><div class="ml-auto">
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
                    $nomAdd = $_POST['nomAdd'];
					$methodAdd = $_POST['methodAdd'];
					$classementAdd = $_POST['classementAdd'];
					if (empty($nomAdd) || empty($classementAdd) || empty($methodAdd))
					{
						echo '<center><div class="alert alert-danger"><strong>Incident:</strong> An error has occurred, information is missing.</div></center>';
					}
						else
						{
							$SQLinsert = $odb -> prepare("INSERT INTO `methodes` VALUE(NULL, :nom, :method, :classement)");
							$SQLinsert -> execute(array(':nom' => $nomAdd, ':method' => $methodAdd, ':classement' => $classementAdd));
							echo '<div class="alert alert-success"><strong>Very good!</strong> A new method has been added to the database.</div>';
							

				            $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                            $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Adding the method'.$nomAdd.''));
						}
				}
				
				if (isset($_POST['suprBtn']))
						{
							$deletes = $_POST['deleteCheck'];
							if (!empty($deletes))
							{
								foreach($deletes as $delete)
								{
									$SQL = $odb -> prepare("DELETE FROM `methodes` WHERE `ID` = :id LIMIT 1");
									$SQL -> execute(array(':id' => $delete));
								}
								echo '<center><div class="alert alert-success"><strong>Incident:</strong> An error has occurred, information is missing.</div></center><meta http-equiv="refresh" content="3;"';
							}
						}
				?> <div class="row">
<div class="col-md-6">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Add Methodes                              </div>
                           </div>
                           <div class="card-body">

                  <form class="forms-sample" method="POST">
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Full name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" placeholder="Ex: NTP Amplification...." name="nomAdd">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="short" class="col-sm-3 col-form-label">Short name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="short" placeholder="Ex: NTP, SYN..." name="methodAdd">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="classement" class="col-sm-3 col-form-label">Type</label>
                      <div class="col-sm-9">
                      <select class="form-control" name="classementAdd">
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


<div class="col-md-6">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Methodes                              </div>
                           </div>
                           <div class="card-body">
                  <form method="POST">
                  <div class="table-responsive">
                    <table class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Check</th>
                          <th>Methode</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        				<?php

									  $SQLSelect = $odb -> query('SELECT * FROM `methodes` ORDER BY `ID` ASC');
									  while ($show = $SQLSelect -> fetch())
									  {
										$rowID = $show['id'];
										$nomShow = $show['nom'];
										$classement = $show['classement'];
?>
<td>
<div class="form-check form-checkbox-outline form-check-success mb-3">
                                                    <input class="form-check-input" type="checkbox" name="deleteCheck[]" value="<?php echo $rowID; ?>"></td>
<td><?php echo htmlspecialchars($nomShow); ?></td>
<td><?php echo htmlspecialchars($classement); ?></td>
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