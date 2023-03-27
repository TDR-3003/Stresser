<?php
 $page = 'Info';
 include"admin.php";
?> 
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Home</h4><div class="ml-auto">
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
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="row">
                           <div class="col-md-3">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Clients</p>
                                          <h4 class="mb-0"><?php echo number_format($stats -> totalUsers($odb), 0, ',', ','); ?></h4>
                                       </div>
                                       <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                          <span class="avatar-title">
                                          <i class="mdi mdi-account-multiple-plus card-custom-icon icon-dropshadow-info font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Online Boots</p>
                                          <h4 class="mb-0"><?php echo $stats -> runningBoots($odb); ?></h4>
                                       </div>
                                       <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                          <span class="avatar-title rounded-circle bg-primary">
                                          <i class="mdi mdi-alarm-check card-custom-icon icon-dropshadow-secondary font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                                                      <div class="col-md-3">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Ticket Pending</p>
                                          <h4 class="mb-0"><?php echo number_format($stats -> totaltickets($odb), 0, ',', ','); ?></h4>
                                       </div>
                                       <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                          <span class="avatar-title rounded-circle bg-primary">
<i class="mdi mdi-email-multiple-outline card-custom-icon icon-dropshadow-secondary font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Boots</p>
                                          <h4 class="mb-0"><?php echo number_format($stats -> totalBoots($odb), 0, ',', ','); ?></h4>
                                       </div>
                                       <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                          <span class="avatar-title rounded-circle bg-primary">
                                          <i class="mdi mdi-alarm card-custom-icon icon-dropshadow-warning font-size-24"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

   
      
         <?php
				if (isset($_POST['maj']))
				{
					$updateNom = $_POST['nomAdd'];
					$updateURL = $_POST['URLAdd'];
				    $updateIcon = $_POST['IconAdd'];

	$updatel4 = (isset($_REQUEST['l4Add']));
    if ($updatel4 == 1 )
      {
        $updatel4 = 1;
      }
    else
     {
       $updatel4 = 0;
     }

    $updatel7 = (isset($_REQUEST['l7Add']));
    if ($updatel7 == 1 )
      {
        $updatel7 = 1;
      }
    else
     {
       $updatel7 = 0;
     }

     $updateAPI = (isset($_REQUEST['APIAdd']));
    if ($updateAPI == 1 )
      {
        $updateAPI = 1;
      }
    else
     {
       $updateAPI = 0;
     }

     $updateSHOP = (isset($_REQUEST['SHOPAdd']));
    if ($updateSHOP == 1 )
      {
        $updateSHOP = 1;
      }
    else
     {
       $updateSHOP = 0;
     }

     $updateAddons = (isset($_REQUEST['AddonsAdd']));
    if ($updateAddons == 1 )
      {
        $updateAddons = 1;
      }
    else
     {
       $updateAddons = 0;
     }
     
     $updateDeposit = (isset($_REQUEST['DepositAdd']));
    if ($updateDeposit == 1 )
      {
        $updateDeposit = 1;
      }
    else
     {
       $updateDeposit = 0;
     }
     
     $updateAuth = (isset($_REQUEST['AuthAdd']));
    if ($updateAuth == 1 )
      {
        $updateAuth = 1;
      }
    else
     {
       $updateAuth = 0;
     }     
						    				    				    
					{
$SQLinsert = $odb -> prepare("UPDATE `informations` SET `nom` = :nom, `url` = :url, `icon` = :icon, `l4` = :l4, `l7` = :l7, `API` = :API, `SHOP` = :SHOP, `Addons` = :Addons, `Deposit` = :Deposit, `Auth` = :Auth");
						
$SQLinsert -> execute(array(':nom' => $updateNom, ':url' => $updateURL, ':icon' => $updateIcon, ':l4' => $updatel4, ':l7' => $updatel7, ':API' => $updateAPI, ':SHOP' => $updateSHOP, ':Addons' => $updateAddons, ':Deposit' => $updateDeposit, ':Auth' => $updateAuth));
						echo '<script type="text/javascript">
toastr["success"]("Success.")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>';header('refresh: 2;');
						$currentNom = $updateNom;
						$currentURL = $updateURL;
						$currentIcon = $updateIcon;
						

				        $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                        $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Changes to Site Information.'));
					}
				}
				?> <div class="row">
          <div class="col-md-12">
                        <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Site Information                              </div>
                           </div>
                           <div class="card-body">
                  <form class="forms-sample" method="POST">
                    <div class="form-group row">
                      <label for="nom" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" id="nom" name="nomAdd" value="<?php echo $info["nom"]; ?>">
                    </div></div>
                    <div class="form-group row">
                      <label for="Url" class="col-sm-3 col-form-label">Url</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" id="Url" name="URLAdd" value="<?php echo $info["url"]; ?>">
                    </div></div>
                    <div class="form-group row">
                      <label for="icon" class="col-sm-3 col-form-label">Icon path</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" id="icon" name="IconAdd" value="<?php echo $info["icon"]; ?>">
                    </div></div>
                    <div class="form-group">
                     <center><img width="70" src="<?php echo '../'.$info["icon"].''; ?>"></center>
                    </div>
                 	<div class="form-group">
                      <label for="L7">System Layer 7</label>
                       <center>
                                            <input type="checkbox" id="L7" name="l7Add" switch="none" value="1" <?php echo ($info["l7"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="L7" data-on-label="On" data-off-label="Off"></label>



     </div></center>
					<div class="form-group">
					  <label for="l4">System Layer 4</label>
                       <center>                                            <input type="checkbox" id="l4" name="l4Add" switch="none" value="1" <?php echo ($info["l4"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="l4" data-on-label="On" data-off-label="Off"></label> </div></center>
		            <div class="form-group">
                      <label for="api">API</label>
                       <center>                                            <input type="checkbox" id="api" name="APIAdd" switch="none" value="1" <?php echo ($info["API"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="api" data-on-label="On" data-off-label="Off"></label></div></center>
                    <div class="form-group">
                      <label for="shop">SHOP</label>
                       <center>                                            <input type="checkbox" id="shop" name="SHOPAdd" switch="none" value="1" <?php echo ($info["SHOP"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="shop" data-on-label="On" data-off-label="Off"></label></div></center>
                    <div class="form-group">
					  <label for="Addons">Addons</label>
                       <center>                                            <input type="checkbox" id="Addons" name="AddonsAdd" switch="none" value="1" <?php echo ($info["addons"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="Addons" data-on-label="On" data-off-label="Off"></label></div></center>
					<div class="form-group">
                      <label for="Deposit">Deposit</label>
                       <center>                                            <input type="checkbox" id="Deposit" name="DepositAdd" switch="none" value="1" <?php echo ($info["deposit"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="Deposit" data-on-label="On" data-off-label="Off"></label></div></center>
                    <div class="form-group">
                      <label for="Auth">Auth</label>
                       <center>                                            <input type="checkbox" id="Auth" name="AuthAdd" switch="none" value="1" <?php echo ($info["Auth"] == 1) ? 'checked="checked"' : ""; ?>>
                                            <label for="Auth" data-on-label="On" data-off-label="Off"></label></div></center>
                    <button type="submit" name="maj" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
           </div>
          <div class="row">
            <div class="col-md-12">
                                      <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Actions of the day applied                              </div>
                           </div>
                           <div class="card-body">
             
                  <div class="row">
                    <div class="col-12">
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                      <thead>
                        <tr>
                              <th>Username#</th>
                              <th>Action</th>
                              <th>Adresse IP</th>
                              <th>hours</th>
                             
                            </tr>
                            				<?php
				$SQLGetLogs = $odb -> query("SELECT `username`,`action`,`date`,`ip` FROM `admin_historique` ORDER BY `date` DESC");
				while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
				{
				
			
									
				?>  
                          </thead>  <tr>
					<td><?php echo $getInfo['username']; ?></td>
					<td><?php echo $getInfo['action']; ?></td>
					<td><?php echo $getInfo['ip']; ?></td>
					<td><?php echo strftime("%d %B - %H:%M",$getInfo['date']); ?></td>
					</tr>  <?php } ?>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                
              </div>
            </div>
        </div>
<?php include'footer.php'; ?> 

            </div>
        </div>


    </body>
</html>



