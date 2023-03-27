<?php
 $page = 'Edit';
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
header('Location: licenses');
exit;
}
$SQLGetInfo = $odb -> prepare("SELECT * FROM `plans` WHERE `ID` = :id LIMIT 1");
$SQLGetInfo -> execute(array(':id' => $instantidpub));
$planInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
$currentName = $planInfo['name'];
$currentCodes = $planInfo['code'];
$currentMbt = $planInfo['mbt'];
$currentNbr = $planInfo['nbr'];
$currentEur = $planInfo['eur'];
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
                  </div>				<?php
				if (isset($_POST['updateBtn']))
				{
					$updateName = $_POST['nameAdd'];
					$updateEur = $_POST['prix'];
					$updateMbt = intval($_POST['mbt']);
					$updateNbr = intval($_POST['nbr']);
					$updateCodes = $updateEur*100+1;
					{
						$SQLinsert = $odb -> prepare("UPDATE `plans` SET `name` = :name, `code` = :code, `nbr` = :nbr, `mbt` = :mbt, `eur` = :eur WHERE `ID` = :id");
						$SQLinsert -> execute(array(':name' => $updateName, ':code' => $updateCodes, ':mbt' => $updateMbt, ':nbr' => $updateNbr, ':eur' => $updateEur, ':id' => $instantidpub));
						echo '<center><div class="alert alert-success"><strong>Very good!</strong> The information about this license has been successfully updated.</div></center>';
						$currentName = $updateName;
						$currentCodes = $updateCodes;
						$currentMbt = $updateMbt;
						$currentNbr = $updateNbr;
						$currentEur = $updateEur;
						
					
				        $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                        $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Changing license settings '.$currentName.''));
					}
				}
				?>
               <div class="col-md-12">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Edit                              </div>
                           </div>
                           <div class="card-body">



					<form role="form" method="POST" class="form-horizontal">





						<div class="form-group">

							<label class="col-md-4">Licence</label>

							<div class="col-md-12">

								<input type="text" name="nameAdd" value="<?php echo $currentName; ?>" class="form-control">

							</div>

						</div> <!-- /.form-group -->



						<div class="form-group">

							<label class="col-md-4">Prix en Eur</label>

							<div class="col-md-12">

								<input type="text" name="prix" value="<?php echo $currentEur; ?>" class="form-control">

							</div>

						</div> <!-- /.form-group -->
						
						
						<div class="form-group">

							<label class="col-md-4">Nombre de seconde compris</label>

							<div class="col-md-12">

								<input type="text" value="<?php echo $currentMbt; ?>" name="mbt" class="form-control">

							</div>

						</div> <!-- /.form-group -->
											
											
						<div class="form-group">

							<label class="col-md-4">Nombre d'envois en simultanés compris</label>

							<div class="col-md-12">

								<input type="text" value="<?php echo $currentNbr; ?>" name="nbr" class="form-control">

							</div>

						</div> <!-- /.form-group -->
						
							<div class="form-group">



								<div class="col-md-offset-4 col-md-12">



									<button type="submit" name="updateBtn" class="pull-right btn btn-light">Ok</button>

								</div>



							</div> <!-- /.form-group -->



					</form>





				</div> <!-- /.widget-content -->





      		</div> <!-- /.widget -->



<?php include'/footer.php'; ?> 

            </div>
        </div>

        <div class="rightbar-overlay"></div>
    </body>
</html>