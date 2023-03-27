<?php
$page = 'Shop';
include'header.php';
?> <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Shop</h4><div class="ml-auto">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item text-primary active" aria-current="page"><?php echo htmlspecialchars($info["nom"]); ?></li>
                <li class="breadcrumb-item text-muted" aria-current="page">/ <?php echo htmlspecialchars($page); ?></li>
              </ol>
            </nav>
          </div>
                        </div>
                     </div>
                  </div>
                    <div class="row row-sm">
                        <?php
                    $newssql = $odb -> query("SELECT * FROM `plans`  ORDER BY `ID` ASC");
                    while($row = $newssql ->fetch())
                    {
        if (isset($_POST[''.$row['name'].'']))
        {

        $SQL = $odb -> prepare("SELECT `membership` FROM `users` WHERE `ID` = :id");
        $SQL -> execute(array(':id' => $_SESSION['ID']));
        $result = $SQL -> fetchColumn(0);
                            $csrf = ($_POST['__csrf']);
                                     if ($info["SHOP"] != 0)
      {

   echo '
  <script type="text/javascript">
toastr["error"]("this system is under maintenance.")

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
</script>';       

  
}else{
       if ($csrf != $_SESSION['token'])
      {

   echo '
  <script type="text/javascript">
toastr["error"]("error token.")

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
</script>';       

  
}else{if ($result == $row['ID'])
        {
 echo '
  <script type="text/javascript">
toastr["error"]("Nice try.")

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
</script>';   
        } else {
        $SQL = $odb -> prepare("SELECT `points` FROM `users` WHERE `ID` = :id");
        $SQL -> execute(array(':id' => $_SESSION['ID']));
        $result = $SQL -> fetchColumn(0);
        if ($result > $row['eur'] -1)
        {
$currentUnit = $row['unit'];
$currentLength = $row['length'];
$newExpire = strtotime("+{$currentLength} {$currentUnit}");
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `membership` = :membership, `expire` = :expire, `points` = points -:pts WHERE `username` = :user");
$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $row['eur'], ':membership' => $row['ID'], ':expire' => $newExpire));
 echo '
   <script type="text/javascript">
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
</script>'; 
header('refresh: 2; url=shop'); 
$SQLinsert = $odb -> prepare("INSERT INTO `historique` VALUES(NULL, :licence, :statut, :username, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':licence' => $row['name'], ':statut' => '<span class="label label-success">Payé</span>', ':username' => $_SESSION['username']));

$SQL = $odb -> prepare("SELECT `api` FROM `plans` WHERE `ID` = :id");
$SQL -> execute(array(':id' => $row['ID']));
$result = $SQL -> fetchColumn(0);
if ($result == 1)
{
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `active` = 1 WHERE `username` = :user");
$SQLUpdate -> execute(array(':user' => $_SESSION['username']));
}
    }
            else
           {
echo'
  <script type="text/javascript">
toastr["error"]("You dont have enough money. Please add balance.")

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
</script>';  
      }
    }
  }
 }
}
?>
 


  <div class="col-xl-3 col-md-6">
                            <div class="card plan-box">
                                <div class="card-header">
                                    <div class="card-title">
                                    <?php echo htmlspecialchars($row['name']); ?>                                   </div>
                                </div>
                                <div class="card-body">
                                    <div class="py-4">
                                        <h2><sup><small>$</small></sup> <?php echo $row['eur']; ?>/<span class="font-size-13">Per <?php if($row['unit'] == "Months") { echo ' Month'; } else if($row['unit'] == "Years") { echo 'Year'; }?></span></h2>
                                    </div>

                                    <div class="plan-features mb-4">
                                        <p><i class="bx bx-checkbox-square text-success mr-2"></i> <?php echo $row['mbt']; ?> seconds</p>
                                        <p><i class="bx bx-checkbox-square text-success mr-2"></i> <?php echo $row['nbr']; ?> concurrent</p>
                                        <p><?php $api = $row['api']; if($api == "1") { echo'<i class="bx bx-checkbox-square text-success mr-2"></i>'; } else { echo'<i class="bx bx-checkbox-square text-
danger mr-2"></i>'; } ?> Premium</p>
                                        <p><?php $api = $row['api']; if($api == "1") { echo'<i class="bx bx-checkbox-square text-success mr-2"></i>'; } else { echo'<i class="bx bx-checkbox-square text-
danger mr-2"></i>'; } ?> API Access</p>
                                    </div>

                                    <div class="text-center plan-btn">
                                                                                <form method="POST">
                                                                                <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                            <?php if(htmlspecialchars($row['name']) == $userInfo['name']) { echo'<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" disabled="" />Paid</button>'; } else { echo'<button type="submit" name="'.htmlspecialchars($row['name']).'" class="btn btn-primary btn-sm waves-effect waves-light">Buy</button>'; } ?>

                                        </form>
                                                                            </div>
                                </div>
                            </div>
                        </div>


            <?php } ?>
       
                                               
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
