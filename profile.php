<?php
$page = 'Profile';
include'header.php';
    
require "request/ahc.php";
    $usergoogle = '('.$_SESSION['username'].')';
    $namegoogle = $info["nom"]." ".$usergoogle;

$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}
 

$qrCodeUrl = $Authenticator->getQR($namegoogle, $_SESSION['auth_secret']);


        ?>    
       <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Profile</h4><div class="ml-auto">
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
                        <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Two Factor Auth
                                     </div>
                                </div>
                                <div class="card-body">
<?php if(empty($userInf['google']))
{echo'<table class="table bg-light table-striped table-bordered fs--1"><tbody><tr><th><img src="'.$qrCodeUrl.'" alt="Verify this Google Authenticator"></th><td><div class="row"><div class="col-12"><h5><i class="fas fa-shield-alt me-2"></i>Save into app</h5><p class="mt-2">Scan this QR code on the left into a app (e.g. Google Authenticator, Authy) and enter the code in the field below to activate two-factor authentication.</p><div class="form-group"><label for="2fa-code">Authentication code</label><form method="POST" action="request/authenticator">
                                        <input type="hidden" id="__csrf" name="__csrf" value="'.$_SESSION['token'].'">
                                        <input type="number" class="form-control" required="" maxlength="6" name="2fa-code" placeholder=""></div><div class="text-center"><button class="btn btn-primary mt-2"  type="submit"><i class="fas fa-check-circle"></i> Enable</button></div></div> </form></div></td></tr></tbody></table>
                                    </div>
                            
                            </div>
                        </div> ';} else { echo'<table class="table bg-light table-striped table-bordered fs--1"><tbody><tr><td><div class="row"><div class="col-12"><h5 class="mb-0 mt-2"><i class="fas fa-shield-alt me-2"></i>Disable 2FA</h5><p class="mt-2">Enter the code in the field below to desactivate two-factor authentication.</p><div class="form-group"><label for="2fa-code">Authentication code</label><form method="POST" action="request/authenticators">
                                        <input type="hidden" id="__csrf" name="__csrf" value="'.$_SESSION['token'].'"><input type="number" class="form-control" required="" name="2fa-code" maxlength="6" value="" placeholder=""><div class="text-center"><button class="btn btn-danger mt-2" type="submit"><i class="fas fa-times-circle"></i> Disable</button></div></div></div></div></td></tr></tbody></table></div>
                            
                            </div>
                        </div> '; } ?>
                           
<div class="col-xl-6">
                                                  <div class="card overflow-hidden">
                            <div class="row">
                                <div class="col-12">
                                  <div class="bg-circle-shape text-center p-3"><h1 class="text-white text-sans-serif font-weight-extra-bold fs-2 z-index-1 position-relative"><?php echo $info["nom"]; ?> ♥</h1></div>                            
<div class="card-body">
<form method="POST" action="request/profile">
<input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
<div class="form-group"><label class="form-label">Change Password</label> <input name="cpassword" type="password" value="" placeholder="Change Password" class="form-control"></div>
<div class="form-group"><label class="form-label">New Password</label> <input name="npassword" type="password" value="" placeholder="New Password" class="form-control"></div>
<div class="form-group"><label class="form-label">Confirm Password</label> <input name="rpassword" type="password" value="" placeholder="Confirm Password" class="form-control"></div>
                                 
                                </div>

                                <div class="card-footer text-right"><div class="d-flex flex-wrap gap-2"><button type="submit" class="btn btn-primary">Update</button><button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Logs</button></div></form>
                               
                                            <!-- Large modal button -->
                                            


                                        <div>
                                            <!--  Extra Large modal example -->

    
                                            <!--  Large modal example -->
                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myLargeModalLabel">Login logs</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                  <div class="form-group">                      
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                  <thead>
                    <tr>
                    <th>IP Address</th>
                    <th>Country</th>
                    <th>Statue</th>
                    <th>Connection Date</th>
                    </tr>
                    </thead>
                    <tbody>
        <?php
        $req = $odb -> query('SELECT * FROM loginlogs WHERE username="'.$_SESSION['username'].'" ORDER BY `date` DESC');
        while($data = $req -> fetch(PDO::FETCH_ASSOC)):
                  ?>
                    <tr>
          <td><?php echo substr_replace($data['ip'], "********", -10); ?></td>
          <td><?php echo $data['country']; ?></td>
          <td><?php echo $data['status']; ?></td>
                    <td><?php echo strftime("%d %B %Y à %Hh%M", $data['date']); ?></td>
                    </tr>
                    <?php endwhile; ?>
            </tbody>
                </table>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->


                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
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
				
