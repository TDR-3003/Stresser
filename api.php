<?php
$page = "API Manager";
include'header.php';
?> 

<?php
									if (isset($_POST['createKey']))
	{        if ($_POST['ip'] == ''){
$ipapiss = '1.1.1.1';}
else{
$ipapiss = $_POST['ip'];
   }
			function generateRandomString($length = 10){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZa-bcdefghijklmnopqrstuvwxyz-';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i=0;$i<$length;$i++){
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	        $timeapi = ($_POST['time']);
                    $csrf = ($_POST['__csrf']);
                             if ($info["API"] != 0)


                          
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

  
}else{if (empty($timeapi) || empty($ipapiss)){
	 echo '
  <script type="text/javascript">
toastr["error"]("There\'s a lack of information, please fill in all the fields.")

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

  if ($timeapi < 30)
      {

   echo '
  <script type="text/javascript">
toastr["error"]("The minimum accepted time is 30 seconds.")

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
    if ($timeapi > $userInfo['mbt'] +$userInf['secs'])
			{
				
	 echo '
  <script type="text/javascript">
toastr["error"]("You cannot create an API with more seconds than the one in your plans.")

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
	if (filter_var($ipapiss, FILTER_VALIDATE_IP) === FALSE)

	        {

	 echo '
  <script type="text/javascript">
toastr["error"]("IP Address Allowed is not a valid IP.")

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
	$ipapis = htmlentities($ipapiss);
	$key = generateRandomString(40);
				$SQL = $odb -> prepare("INSERT INTO `apiplus` VALUES(NULL, :user, :timeapi, :ip, :apikey, UNIX_TIMESTAMP())");
				$SQL -> execute(array(':user' => $_SESSION['ID'],':timeapi' => $timeapi, ':ip' => $ipapis, ':apikey' => $key));
					 echo '
  <script type="text/javascript">
toastr["success"]("Your API has been successfully generated.")

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


		
}}}}}}}

if (isset($_POST['delete']))
{
   $csrf = ($_POST['__csrf']);
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
$delete = $_POST['delete'];
$SQL = $odb -> query("DELETE FROM `apiplus` WHERE `ID` = '$delete'");
								 echo '
  <script type="text/javascript">
toastr["success"]("API has been removed.")

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

}}
?>




        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">API Manager</h4><div class="ml-auto">
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
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Manage API
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Attack Duration</th>
                                                    <th scope="col">Key</th>
                                                    <th scope="col">Whitelist</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php 
      $SQLGetTickets = $odb -> prepare("SELECT * FROM `apiplus` WHERE `user` = :user");
      $SQLGetTickets -> execute(array(':user' => $_SESSION['ID']));
      while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
      {
        $timeapi = $getInfo['timeapi'];
   
     if ($getInfo['ip'] == '1.1.1.1'){
$ipa = 'Na';}
else{
$ipa = $getInfo['ip'];
   }

      ?>                                    

       <tr><form method="POST">
                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
									   <td><?php echo htmlspecialchars($getInfo['timeapi']); ?></td> <td><?php echo htmlspecialchars($getInfo['apikey']); ?></td>

									   <td><?php echo htmlspecialchars($ipa); ?></td>
									  
                                       <td><?php echo strftime("%d %B - %H:%M", $getInfo['date']); ?></td>
                                       <td><button type="submit" title="Delete API" name="delete" value="<?php echo $getInfo['ID']; ?>" class="btn btn-danger btn-sm"><i class="bx mr-2 bx-x text"></i></button></td>
                                </tr>      
      <?php } ?> 
         </tbody>
</table>
     </form>
    
      <?php if ($stats -> apisst($odb) == 0) { ?>
                                                    <br>
<center><h6><i class="bx mr-2 bx-x text"></i> No data available.</h6></center> <br>
<?php } ?>
                                                                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Generate API
                                    </div>
                                </div>
                                <form method="POST" id="GenerateAPI">
                                <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                    <div class="card-body">
                                        <div class="form-group"><label for="duration">
                                            Max Attack Duration
                                            </label>   </br><input class="form-range" step="1" min="0" max="<?php
			if($userInfo['mbt'] == ""){
			echo "0";
			}else{
			echo $userInfo['mbt'] +$userInf['secs'];
			}
			?>" value="0" oninput="this.form.time.value=this.value" type="range">
      <input class="form-control" name="time" type="number" placeholder="Min: 30, Max: <?php
                      if($userInfo['mbt'] == ""){
                      echo "0";
                      }else{
                      echo $userInfo['mbt'] +$userInf['secs'];
                      }
                      ?>
">
                                        </div>
                                        <div class="form-group"><label for="ip-address">IP Address Allowed</label><input class="form-control" name="ip" placeholder=""></div>
                                        <strong>Informations :</strong>
                                        <p>If you want to allow requests from all, keep this field empty.</p>
                                    </div>
                                    <div class="card-footer text-right"><button type="submit" name="createKey" class="btn btn-primary">Deploy</button></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="card-title">
                                    Documentation
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group"><label>
                                    Layer 4 Attack
                                    </label><input type="text" class="form-control" id="" name="" maxlength="" value="<?php echo $info["url"]; ?>start?user=<?php echo $_SESSION['ID'] ?>&amp;api_key=&amp;target=8.8.8.8&amp;port=80&amp;duration=30&amp;method=NTP" placeholder="" onclick="this.select();document.execCommand('copy');toastr['success']('Successfully copied!', '');">
                                    </div>
                                    <div class="form-group"><label>
                                    Layer 7 Attack
                                    </label><input type="text" class="form-control" id="" name="" maxlength="" value="<?php echo $info["url"]; ?>start7?user=<?php echo $_SESSION['ID'] ?>&amp;api_key=&amp;address=&amp;duration=&amp;type7=&amp;mode=&amp;rate=&amp;origin=Worldwide&amp;host=&amp;post=" placeholder="" onclick="this.select();document.execCommand('copy');toastr['success']('Successfully copied!', '');">
                                    </div>
                                    <div class="form-group"><label>
                                    Stop Attack
                                    </label><input type="text" class="form-control" id="" name="" maxlength="" value="<?php echo $info["url"]; ?>stop?user=<?php echo $_SESSION['ID'] ?>&amp;api_key=&amp;stopper=" placeholder="" onclick="this.select();document.execCommand('copy');alert('Copied');">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        FAQ
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                What is the purpose of the API
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                        <p>The API is that you can send attacks via a link, which allows you to use our services on your stresser<br></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                How to use it
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                        <p>AIt is very easy to use API, above in the documentation you have links on how to start attacks and how to stop them. You can see the list of methods <a href="helpdesk">here</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Contact Support
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="text-muted">
                                                    If you need help or have any questions you can contact us at our Telegram group or contact the owner at <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1578667661735565783b7870">[email&#160;protected]</a>, dont forget to also read our support / help page which may answer your questions.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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