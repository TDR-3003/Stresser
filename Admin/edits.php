<?php
 $page = 'Edit Server';
 include"admin.php";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
    $link = "http";
  
// Here append the common URL characters.
$link .= "://";
  
// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];
  
// Append the requested resource location to the URL
$link .= $_SERVER['REQUEST_URI'];
$number = str_replace(['+', '-'], '', filter_var($link, FILTER_SANITIZE_NUMBER_INT));
$instantidpub = htmlentities($number);
if(is_numeric($instantidpub) == false) {
header('Location: server');
exit;
}
$SQLGetInfo = $odb -> prepare("SELECT * FROM `serveurs` WHERE `ID` = :id LIMIT 1");
$SQLGetInfo -> execute(array(':id' => $instantidpub));
$serveurInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
$currentNom = $serveurInfo['name'];
$currentAdresse = $serveurInfo['adresse'];
$currentConcu = $serveurInfo['concurrents'];
$currentStatues = $serveurInfo['status'];
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Edit / <?php echo $instantidpub; ?></h4><div class="ml-auto">
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
               <div class="col-md-12">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Edit Server                              </div>
                           </div>
                           <div class="card-body">



					<form role="form" method="POST" class="form-horizontal">


				<?php
				if (isset($_POST['updateBtn']))
				{
					$updateAdresse = $_POST['adresseAdd'];
					$updateConcu = $_POST['concu'];
					$updateStat = $_POST['stat'];
					{
						$SQLinsert = $odb -> prepare("UPDATE `serveurs` SET `concurrents` = :concu, `adresse` = :adresse, `status` = :status WHERE `ID` = :id");
						$SQLinsert -> execute(array(':concu' => $updateConcu, ':adresse' => $updateAdresse, ':id' => $instantidpub, ':status' => $updateStat));
						echo '<center><div class="alert alert-success"><strong>Very good!</strong> The information about this server has been successfully updated.</div></center>';
						$currentAdresse = $updateAdresse;
						$currentConcu = $updateConcu;
						
						
				        $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                        $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Changing the settings of the '.$currentNom.''));
					}
				}
				?>



						<div class="form-group">

							<label class="col-md-4">Adresse API</label>

							<div class="col-md-12">

								<input type="text" name="adresseAdd" value="<?php echo $currentAdresse; ?>" class="form-control">

							</div>

						</div> <!-- /.form-group -->
						
						<div class="form-group">

							<label class="col-md-4">Concurrents</label>

							<div class="col-md-12">

								<input type="text" name="concu" value="<?php echo $currentConcu; ?>" class="form-control">

							</div>

						</div> <!-- /.form-group -->
						<div class="form-group">

							<label class="col-md-4">Status</label>

							<div class="col-md-12">

								<select class="form-control" name="stat">
								<option value="1">Offline</option>
								<option value="2">Maintenance</option>
								<option value="0">Online</option>
								</select>

							</div>

						</div>
											
							<div class="form-group">



								<div class="col-md-offset-4 col-md-12">



									<button type="submit" name="updateBtn" class="btn btn-light btn-sm">Ok</button>

													</div>



							</div> <!-- /.form-group -->



					</form>





				</div> <!-- /.widget-content -->





      		</div> <!-- /.widget -->



<?php include'footer.php'; ?> 

            </div>
        </div>

        <div class="rightbar-overlay"></div>
    </body>
</html>