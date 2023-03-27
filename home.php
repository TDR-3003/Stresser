<?php
$page = 'Home';
include'header.php';
?><?php
        if (isset($_POST['add']))
        { 

   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['avatar']['size'] <= $tailleMax) {
    if ($_POST['__csrf'] = $_SESSION['token']) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $chemin = "assets/images/".$_SESSION['ID'].".".$extensionUpload;
            $fichier = "assets/images/".$userInf['avatar'];
      unlink( $fichier ) ;
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
         if($resultat) {
            $updateavatar = $odb->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
            $updateavatar->execute(array(
               ':avatar' => $_SESSION['ID'].".".$extensionUpload,
               ':id' => $_SESSION['ID']
               ));
             echo ' <script type="text/javascript">
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
         } else {
             echo ' <script type="text/javascript">
toastr["error"]("Error importing your profile picture.")

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
      } else {
         echo ' <script type="text/javascript">
toastr["error"]("Your profile picture must be in jpg, jpeg, gif or png format.")

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
   } else {
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
     }
   } else {
       echo ' <script type="text/javascript">
toastr["error"]("Your profile picture must not exceed 2MB.")

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
?>
   
                                            <!-- Static Backdrop Modal -->
                                            <div class="modal fade" id="ava" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="avatar" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="avatar" for="avata">Avatar</h5>
                                                            
                                                        </div>
                                                        <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                                        <div class="input-group">
                                                    <input type="file" name="avatar" id="avata" class="form-control" id="inputGroupFile02"><button class="btn btn-primary" type="submit" name="add"><i class="fas fa-check-circle"></i> Update</button>
                                                </div>
                                                        </div><center><code>Format avalable jpg, png, jpeg, gif. Max 2MB</code></center>  </br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                   </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
    <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Home</h4><div class="ml-auto">
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
                    <div class="col-xl-4">
                    <div class="card overflow-hidden">
                            <div class="row">
                                <div class="col-12">
                                  <div class="bg-circle-shape text-center p-3"><h1 class="text-white text-sans-serif font-weight-extra-bold fs-2 z-index-1 position-relative"><?php echo $info["nom"]; ?> ♥</h1></div>
                             <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a data-bs-toggle="modal" data-bs-target="#ava" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
  <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets/images/<?php
                      if($userInf['avatar'] == "0"){
                      echo "favicon.ico";
                      }else{
                      echo htmlspecialchars($userInf['avatar']);
                      }
                      ?>" alt="" class="rounded-circle avatar-md">
                                        </span>
                                    </div>  </a>     
                             

                                        <div class="col-sm-12">
 <div class="table-responsive">
                                 <table class="table mb-0">
                                    <tbody>
                                    	                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50"><h5 class="font-size-15 text-truncate">Username</h5></span></td>
                                             <td class="py-2 px-0"><p class="text-muted mb-0 text-truncate"><?php echo $_SESSION['username']; ?></p></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Balance</span></td>
                                             <td class="py-2 px-0">&euro; <?php echo $userInf['points']; ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Plan Name</span></td>
                                             <td class="py-2 px-0"><?php
                      if($userInfo['name'] == ""){
                      echo "Na";
                      }else{
                      echo $userInfo['name'];
                      }
                      ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Attack Duration</span></td>
                                             <td class="py-2 px-0"><?php
                      if($userInfo['mbt'] == ""){
                      echo "Na";
                      }else{
                      echo $userInfo['mbt'] +$userInf['secs'];
                      }
                      ?></td>
                                       </tr>
                                       <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Concurrents</span></td>
                                             <td class="py-2 px-0"><?php
                      if($userInfo['nbr'] == ""){
                      echo "Na";
                      }else{
                      echo $userInfo['nbr'] +$userInf['concu'];
                      }
                      ?></td>
                                       </tr>
                                        <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">API Access</span></td>
                                             <td class="py-2 px-0"><?php
      if($userInfo['api'] == ""){
      echo '<i class="bx mr-2 bx-x text-danger"></i>';
      }else{
      echo '<i class="mdi mdi-check text-success"></i>';
      }
        ?></td>
                                       </tr>
                                                                              <tr>
                                             <td class="py-2 px-0"><span class="font-weight-semibold w-50">Expires</span></td>
                                             <td class="py-2 px-0">
<?php



      if($userInf['expire'] == "0"){
      echo 'Na' ;
      }else{
            if(strftime("%Y", $userInf['expire']) > "2021"){
      echo 'Never' ;
           }else{
            if($userInf['expire'] !== "0"){ 

$date = strftime("%m/%d/%y",$userInf['expire']);
$DateAndTime = date('m/d/Y', time());  

$datetime1 = new DateTime($DateAndTime);
$datetime2 = new DateTime($date);
$difference = $datetime1->diff($datetime2);
echo ''.$difference->y.' Year(s), ' 
                   .$difference->m.' Mouth, ' 
                   .$difference->d.' Day';
      } } }
        ?>


                                              </td>
                                       </tr>
                                    </tbody>
                                 </table>
                            
                                                 
                                                

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></div></div> </div>
                           
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-md-4">
                              <div class="card mini-stats-wid">
                                 <div class="card-body">
                                    <div class="media">
                                       <div class="media-body">
                                          <p class="text-muted fw-medium">Total Users Online</p>
                                          <h4 class="mb-0"><a id="online"></a>/<?php echo number_format($stats -> totalUsers($odb), 0, ',', ','); ?></h4>
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
                           <div class="col-md-4">
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
                           <div class="col-md-4">
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
              
                
                        <div class="card">
                           <div class="card-header">
                              <div class="card-title">
                              News
                              </div>
                           </div>
                           <div class="card-body">
                              <div id="scrollbar3" class="latest-timeline scrollbar3" data-simplebar="">
                                 <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                       <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                       <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                          <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                                <div class="card-body">
                                                   <ul class="verti-timeline list-unstyled">            <?php
                        $newssql = $odb -> query("SELECT `title`,`detail`,`date` FROM `news` ORDER BY `date` DESC");
                        while($row = $newssql ->fetch())
            {
            $go = date("Y-m-d, h:i:s" ,$row['date']);
            $fin = date("Y-m-d, h:i:s");
            $date1 = new DateTime($go);
            $date2 = $date1->diff(new DateTime($fin));

            if($date2->days > '1'){ $icon = '<i class="bx bx-right-arrow-circle font-size-18"></i>';} else { $icon = '<i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>';
} 
              	?>
 <li class="event-list">
                                                         <div class="event-timeline-dot">
                                                         <?php echo $icon; ?>
                                                         </div>
                                                         <div class="media">
                                                            <div class="media-body">
                                                               <div>
                                                                  <div class="d-flex "><span><h5><?php echo htmlspecialchars($row['title']); ?></h5></span><span class="ml-auto text-muted fs-11"><?php echo strftime("%H:%M - %B %d, %Y" ,$row['date']); ?></span></div>
                                                                  <p class="text-muted"><?php echo htmlspecialchars($row['detail']); ?></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </li>

          
            <?php
              
                } ?>
                                                                                                         
                                                                                                         </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 907px;"></div>
                                 </div>
                                 <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                       <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                 </div>
                                 <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                       <div class="simplebar-scrollbar" style="height: 138px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                 </div>
                              </div>
                           </div>
                        </div>  
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card">
                              <div class="card-header">
                                 <div class="card-title">
Our Network                              </div>
                              </div>
                              <div class="card-body">
                                 <div class="table-responsive">
          <div class="block-content">
          

          <div id="live_servers"></div>
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

        <div class="rightbar-overlay"></div>


    </body>
</html>


