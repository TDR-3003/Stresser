<?php
$page = 'Addons';
include'header.php';
?>


    <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Addons</h4><div class="ml-auto">
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
                  <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Blacklist Target $60.
                                     </div>
                                </div>
                                <div class="card-body">
                                	<form method="POST">
                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                        <div class="form-group"><label class="form-label">Save the IP address of your choice to a blacklist.</label> <input placeholder="Adresse IPv4 1.1.1.1" name="ip" type="text" value="" class="form-control"></div>
                                    </div>
                            <div class="card-footer text-right"><button type="submit" name="bl" class="btn btn-primary mt-2"><i class="fas fa-check-circle"></i> Enable</button></div></form>
                            </div>
                        </div>  

                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    +1 Concurrents $20.
                                     </div>
                                </div>
                                <div class="card-body">
                                	<form method="POST">
                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                                               </div>       <div class="card-footer text-center"><button type="submit" name="+" class="btn btn-primary">Update</button></div></form></div>
                         </div>
                            
                           
                        
                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    + Attack Duration.
                                     </div>
                                </div>
                                <div class="card-body">
                                	<form method="POST">
                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                    <input type="text" name="points" value="<?php echo $userInf['points']; ?>" class="form-control">
                    
                                    </div>
                            <div class="card-footer text-right"><button type="submit" name="c" class="btn btn-primary mt-2"><i class="fas fa-check-circle"></i> Enable</button></div></form>
                            </div>
                        </div>  
<?php
     
        if (isset($_POST['c']))
		{
			                       $csrf = ($_POST['__csrf']);
                                      if ($info["addons"] != 0)
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

  
}else{
		$pts = $_POST['points'];
		$SQL = $odb -> prepare("SELECT `expire` FROM `users` WHERE `ID` = :id");
		$SQL -> execute(array(':id' => $_SESSION['ID']));
		$result = $SQL -> fetchColumn(0);
		if ($result == 0)
		{
   echo '
  <script type="text/javascript">
toastr["error"]("You don\'t have plans.")

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
		if ($result == 0)
		{
   echo '
  <script type="text/javascript">
toastr["error"]("You have no balance.")

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
		if (!is_numeric($pts))
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
		if ($result > $pts -1)
		{
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `points` = points -:pts, `secs` = secs +:pts WHERE `username` = :user");
$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
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
$SQLinsert = $odb -> prepare("INSERT INTO `historique` VALUES(NULL, :licence, :statut, :username, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':licence' => "Ajout de ".$pts." secondes", ':statut' => '<span class="label label-success">Payé</span>', ':username' => $_SESSION['username']));

$SQLinsert = $odb -> prepare("INSERT INTO `courrier` VALUES(NULL, :sujet, :contenu, :username, 0, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':sujet' => 'Payment confirmation', ':contenu' => ' '.$_SESSION['username'].', Hello,<br>
<p>We confirm receipt of payment for your payment for the addition of'.$pts.' additional seconds. '.$pts.' balance have been debited from your account.<br>
Need more information? Do not hesitate to <a style="color:blu" href="new">open a ticket</a><br>
'.$info["nom"].' - Launch denial-of-service attacks at competitive and clear prices at no additional cost!<br>
'.$info["url"].'</p>', ':username' => $_SESSION['username']));
	}
			else
		   {
   echo '
  <script type="text/javascript">
toastr["error"]("You do not have the number of balance required to benefit from this option.")

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
 }} }
}

		if (isset($_POST['+']))
		{
			                       $csrf = ($_POST['__csrf']);
                                                                   if ($info["addons"] != 0)
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

  
}else{
		$pts = 20;
		$SQL = $odb -> prepare("SELECT `expire` FROM `users` WHERE `ID` = :id");
		$SQL -> execute(array(':id' => $_SESSION['ID']));
		$result = $SQL -> fetchColumn(0);
		if ($result == 0)
		{
   echo '
  <script type="text/javascript">
toastr["error"]("You don\'t have plans.")

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
		if ($result > $pts -1)
		{
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `points` = points -:pts, `concu` = concu +1 WHERE `username` = :user");
$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
                        echo '<script type="text/javascript">
toastr["success"]("Success")

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
$SQLinsert = $odb -> prepare("INSERT INTO `historique` VALUES(NULL, :licence, :statut, :username, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':licence' => "Plus d'envoi (<span class='label label-info'>1</span>)", ':statut' => '<span class="label label-success">Payé</span>', ':username' => $_SESSION['username']));

$SQLinsert = $odb -> prepare("INSERT INTO `courrier` VALUES(NULL, :sujet, :contenu, :username, 0, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':sujet' => 'Payment confirmation', ':contenu' => ' '.$_SESSION['username'].', Hello,<br>
<p>We confirm receipt of the payment of your payment for the addition of 1 concurrent. '.$pts.' balance have been debited from your account.<br>
Need more information? Do not hesitate to <a style="color:blu" href="new">open a ticket</a><br>
'.$info["nom"].' - Launch denial-of-service attacks at competitive and clear prices at no additional cost!<br>
'.$info["url"].'</p>', ':username' => $_SESSION['username']));
	}
			else
		   {
                        echo '<script type="text/javascript">
toastr["error"]("You do not have the number of balance required to benefit from this option.")

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
	  } }
    }
}}



		if (isset($_POST['bl']))
		{
			                       $csrf = ($_POST['__csrf']);
                                                                   if ($info["addons"] != 0)
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

  
}else{
		$ip = ($_POST['ip']);
		$pts = 60;
		if (empty($ip))
					{
                        echo '<script type="text/javascript">
toastr["error"]("The request could not succeed, information is missing.")

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
		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `blacklist` WHERE `IP` = :ip");
		$SQL -> execute(array(':ip' => $ip));
		$result = $SQL -> fetchColumn(0);
		if ($result > 0)
		{

                        echo '<script type="text/javascript">
toastr["error"]("IP address is already blacklisted.")

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
		if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		{
                        echo '<script type="text/javascript">
toastr["error"]("The inserted IP address is not correct.")

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
		if ($result > $pts -1)
		{
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `points` = points -:pts WHERE `username` = :user");
$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
                        echo '<script type="text/javascript">
toastr["success"]("Success")

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
$SQLinsert = $odb -> prepare("INSERT INTO `historique` VALUES(NULL, :licence, :statut, :username, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':licence' => "Anti Boot", ':statut' => '<span class="label label-success">Payé</span>', ':username' => $_SESSION['username']));

$SQLinsert = $odb -> prepare("INSERT INTO `blacklist` VALUES(NULL, :ip, :note)");
$SQLinsert -> execute(array(':ip' => $ip, ':note' => $_SESSION['username']));

$SQLinsert = $odb -> prepare("INSERT INTO `courrier` VALUES(NULL, :sujet, :contenu, :username, 0, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':sujet' => 'Payment confirmation', ':contenu' => ' '.$_SESSION['username'].', Hello,<br>
<p>We confirm receipt of payment for your payment for the addition of the IP address<span class="label label-primary">'.htmlentities($ip).'</span> blacklisted. '.$pts.' balance have been debited from your account.<br>
Need more information? Do not hesitate to <a style="color:blu" href="new">open a ticket</a><br>
'.$info["nom"].' - Launch denial-of-service attacks at competitive and clear prices at no additional cost!<br>
'.$info["url"].'</p>', ':username' => $_SESSION['username']));
	}
			else
		   {
                        echo '<script type="text/javascript">
toastr["error"]("You do not have the number of balance required to benefit from this option.")

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
    } }
  }
}
}}
?>
          
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