<?php
$page = "Attack Hub";
include'header.php';
if (!$user-> hasMembership($odb))
{
	header('Location: shop');
}
?>
<?php  ?> <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">ATTACK HUB</h4><div class="ml-auto">
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
                        <div class="col-xl-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Stresser Form
                                    </div>
                                </div>

                                <div class="card-body">

                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#l4" role="tab" aria-selected="true">
                                                <span class="d-block d-sm-none">Layer 4</span>
                                                <span class="d-none d-sm-block">Layer 4</span>
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#l7" role="tab" aria-selected="false">
                                                <span class="d-block d-sm-none">Layer 7</span>
                                                <span class="d-none d-sm-block">Layer 7</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="l4" role="tabpanel">
                                            <form method="POST" id="Details4">
<input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                                <div class="form-group">
                                                    <label>Attack Method</label>
                        <select class="form-control" name="type">
							<optgroup label="Layer 4">
<?php
									  $SQLSelect = $odb -> query("SELECT * FROM `methodes` WHERE `classement` = 4 ORDER BY `id` ASC");
									  while($show = $SQLSelect ->fetch())
									  {
										$nom = $show['nom'];
										$nommethod = $show['method'];
?>
						    <option value="<?php echo $nommethod; ?>"><?php echo $nom; ?></option>
<?php } ?>
							</optgroup>
							
						</select>
                                                </div>
                                                <div class="form-group"><label for="address">
                                                    Address
                                                    </label>
                                                    <input type="text" class="form-control" required="" name="hote" placeholder="127.0.0.1" onchange="IpPort()">
                                                </div>
                                                <div class="form-group"><label for="port">
                                                    Port
                                                    </label>
                                                    <input type="text" class="form-control" required="" value="80" name="port" placeholder="1-65535">
                                                </div>
                                                <div class="form-group"><label for="time">
                                                    Duration
                                                    </label>
                                                    <input class="form-range" step="1" min="0" max="<?php
            if($userInfo['mbt'] == ""){
            echo "0";
            }else{
            echo $userInfo['mbt'] +$userInf['secs'];
            }
            ?>" value="0" oninput="this.form.temps.value=this.value" type="range"><input class="form-control" required="" name="temps" type="number" placeholder="Min: 15, Max:  sec (Optional)">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><button type="submit" name="attaquer" class="btn btn-outline-primary waves-effect waves-light btn-block pointer">Send Attack</button></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="l7" role="tabpanel">
                                            <form method="POST" id="Details7">
                                                <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                                <div class="form-group">
                                                    <label>Attack Method</label>
                                                                                <select class="form-control" name="type7">
							 <optgroup label="Layer 7">
<?php
									  $SQLSelect = $odb -> query("SELECT * FROM `methodes` WHERE `classement` = 7 ORDER BY `id` ASC");
									  while($show = $SQLSelect ->fetch())
									  {
										$nom = $show['nom'];
										$nommethod = $show['method'];
?>
						    <option value="<?php echo $nommethod; ?>"><?php echo $nom; ?></option>
<?php } ?>
							</optgroup>
						</select>                 
                                                </div>
                                                <div class="form-group"><label>
                                                    Address
                                                    </label>
                                                    <input type="text" class="form-control" id="address" required="" name="address" maxlength="" value="" placeholder="Website: https://example.com/">
                                                </div>
                                                <div class="form-group">
                                                    <label for="time">Duration</label>
                                                    <input class="form-range" step="1" min="0" max="<?php
            if($userInfo['mbt'] == ""){
            echo "0";
            }else{
            echo $userInfo['mbt'] +$userInf['secs'];
            }
            ?>" value="0" oninput="this.form.time.value=this.value" type="range"><input class="form-control" required="" id="time" name="time" type="text" placeholder="Min: 15, Max:  sec (Optional)">
                                                </div>
                                                <div class="multi-collapse collapse" id="AdvancedLayer7" style="">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="col-form-label">Request Method</label><br>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="mode" value="GET" checked="" >
                                                                <label class="form-check-label">
                                                                    GET
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="mode" value="POST">
                                                                <label class="form-check-label">
                                                                    POST
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-6 col-12"><label for="rate" class="col-form-label">Requests per IP</label> <input name="rate" placeholder="Min 1, Max: 64 (Optional)" type="text" class="form-control"></div>
                                                        <div class="form-group col-6" style="display: none;"><label for="rate" class="col-form-label">StatusCode</label> <input name="statusCode" placeholder="200 (Optional)" type="text" class="form-control"></div>
                                                    </div>
                                                    <div class="form-group" style="display:none;">
                                                        <label for="post">Post Data</label>
                                                        <input class="form-control" id="post" name="post" type="text" placeholder="username=username&password=password (Optional)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Host</label>
                                                        <input class="form-control" id="host" name="host" type="text" placeholder="google.com (Optional)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="origin">
                                                        Attack Origin
                                                        </label>
                                                        <select name="origin" id="origin" class="form-control">
                                                            <option value="Worldwide">Worldwide</option>
                                                            <option value="United_states">United States</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Vietnam">Vietnam</option>
                                                            <option value="China">China</option>
                                                            <option value="Hong_Kong">Hong Kong</option>
                                                            <option value="Korea">Korea</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Netherland">Netherland</option>
                                                            <option value="Poland">Poland</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"><button type="submit" name="l7" class="btn btn-outline-primary waves-effect waves-light btn-block pointer">Send Attack</button></div>
                                                    <div class="col-md-6"><button type="button" class="btn btn-outline-light waves-effect btn-block" data-bs-toggle="collapse" href="#AdvancedLayer7" role="button" aria-expanded="false" aria-controls="AdvancedLayer7">Advanced Options</button></div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Running Attacks
                                    </div>
                                    <div class="card-options">
                                        <div class="d-flex gap-2 flex-wrap">
                                        <div class="btn-group"><form method="POST"><input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                                    <button type="submit" name="all" class="btn btn-primary" class="dropdown-item">Stop All Attacks</button>
</form>
                                                <div class="dropdown-menu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Target</th>
                                                    <th>Duration</th>
                                                    <th>Method</th>
                                                    <th>Timeleft</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody><?php
$SQLGetLogs = $odb -> query('SELECT * FROM `logs` WHERE user="'.$_SESSION['username'].'" AND `time` + `date` > UNIX_TIMESTAMP() ORDER BY `id` DESC LIMIT 0,5');
while($ArrayInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
{
$id = $ArrayInfo['id'];
$port = $ArrayInfo['port'];
$IP = $ArrayInfo['ip'];
$time = $ArrayInfo['time'];
$timerst = $ArrayInfo['timerst'];
$serveur = $ArrayInfo['serveur'];
$method = $ArrayInfo['method'];
$note = $ArrayInfo['note'];
$date = strftime("%d %B - %H:%M" ,$ArrayInfo['date']);
										
$cible = $ArrayInfo['date']+$ArrayInfo['time'];
	
$now = time();

$seconde = $cible - $now;
if(isset($_POST['all']))
{
$SQL = $odb -> prepare("SELECT * FROM `logs` WHERE `id` = :id AND `user` = :user  AND `time` + `date` < UNIX_TIMESTAMP()");
$SQL -> execute(array(':user' => $_SESSION['username'], ':id' => $id));
$result = $SQL -> fetchColumn(0);
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

  
}else{if ($result != 0)
{
echo '
   <script type="text/javascript">
toastr["error"]("This shipment is already complete.")

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
$SQLSelect = $odb -> prepare("SELECT * FROM `serveurs` WHERE `ID` = :id");
$SQLSelect -> execute(array(':id' => $serveur));
while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
{
$adresse = $show['adresse'];                                        
ini_set('default_socket_timeout', 1);
$adresse = str_replace("%hote%", $IP, $adresse);
$adresse = str_replace("%temps%", "60", $adresse);
$adresse = str_replace("%port%", "80", $adresse);
$adresse = str_replace("%type%", "STOP", $adresse);
$adresse = str_replace("%user%", $_SESSION['username'], $adresse);
APIinit($adresse, $odb);
}
$SQLUpdate = $odb -> prepare("UPDATE `logs` SET `time` = 0 WHERE `user` = :user AND `id` = :id AND `time` + `date` > UNIX_TIMESTAMP()");
$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':id' => $id));
 echo '
   <script type="text/javascript">
toastr["success"]("all attack its stop.")

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
header('refresh: 4;');
}
}}
if(isset($_POST['annuler'.$id.'']))
{
$SQL = $odb -> prepare("SELECT * FROM `logs` WHERE `id` = :id AND `user` = :user  AND `time` + `date` < UNIX_TIMESTAMP()");
$SQL -> execute(array(':user' => $_SESSION['username'], ':id' => $id));
$result = $SQL -> fetchColumn(0);
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

  
}else{if ($result != 0)
{
echo '
   <script type="text/javascript">
toastr["error"]("This shipment is already complete.")

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
$SQLSelect = $odb -> prepare("SELECT * FROM `serveurs` WHERE `ID` = :id");
$SQLSelect -> execute(array(':id' => $serveur));
while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
{
$adresse = $show['adresse'];										
ini_set('default_socket_timeout', 1);
$adresse = str_replace("%hote%", $IP, $adresse);
$adresse = str_replace("%temps%", "60", $adresse);
$adresse = str_replace("%port%", "80", $adresse);
$adresse = str_replace("%type%", "STOP", $adresse);
$adresse = str_replace("%user%", $_SESSION['username'], $adresse);
APIinit($adresse, $odb);
}
$SQLUpdate = $odb -> prepare("UPDATE `logs` SET `time` = 0 WHERE `user` = :user AND `id` = :id AND `time` + `date` > UNIX_TIMESTAMP()");
$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':id' => $id));
 echo '
   <script type="text/javascript">
toastr["success"]("attack it stop.")

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
header('refresh: 4;');
}
}}
?> 
<script>
var count<?php echo $id; ?>=<?php echo ($seconde < 10 ? "0". $seconde : $seconde); ?>;
var counter<?php echo $id; ?>=setInterval(stress<?php echo $id; ?>, 1000);
function stress<?php echo $id; ?>()
{
  count<?php echo $id; ?>=count<?php echo $id; ?>-1;
  if (count<?php echo $id; ?> <= 0)
  {
     clearInterval(counter<?php echo $id; ?>);
	 document.getElementById("stress<?php echo $id; ?>").innerHTML = '<span class="label label-danger">Terminé</span>';
     return;
  }
document.getElementById("stress<?php echo $id; ?>").innerHTML=count<?php echo $id; ?>;
}
</script>
	<tr>			<form method="POST">
                    <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
	<td><?php echo htmlspecialchars($IP); ?></td>
		<td><?php echo $timerst; ?></td>
	<td><?php echo $method; ?></td>
        <td><span id="stress<?php echo $id; ?>"></span></td>
	<td><button class="btn btn-danger btn-sm" type="submit" name="annuler<?php echo $id; ?>">Stop</button></td>
	</tr>
<?php } ?>
</form>  </div>   
                                                                                            </tbody>
                                        </table>   <?php if ($stats -> runningBootUser($odb) == 0) { ?>
                                            <br>
<center><h6><i class="bx mr-2 bx-x text"></i> No data available.</h6></center> <br>
<?php } ?>
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
<?php
                    
                if (isset($_POST['l7']))
                {

                    $address = $_POST['address'];
                    $time = intval($_POST['time']);
                    $method = $_POST['type7'];
                    $mode = $_POST['mode'];
                    $rate = $_POST['rate'];
                    $origin = $_POST['origin'];
                    $host = $_POST['host'];
                      if ($mode == 'GET')
                      {$post = '0';
                      	}else{
                      		$post = $_POST['post'];} 

                    $SQLGetInfo = $odb -> prepare("SELECT `classement` FROM `methodes` WHERE `method` = :method");
                    $SQLGetInfo -> execute(array(':method' => htmlspecialchars($method)));
                    $type = $SQLGetInfo -> fetchColumn(0);
                    $serveurs = array();
                    $serveur = "*";
                    $ServeursRotation = $odb -> query("SELECT * FROM `serveurs` WHERE `type` = $type AND `status` = 0 ORDER BY ABS(`date`) ASC LIMIT 1;");
                    if ($ServeursRotation -> rowCount() != 0) {
                    $serveurs = $ServeursRotation -> fetchAll(PDO::FETCH_ASSOC);
                    $id = $serveurs[0]['ID'];
                    $adresse = $serveurs[0]['adresse'];
                       $csrf = ($_POST['__csrf']);
      
         if ($info["l7"] != 0)
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
    $serve = $odb -> prepare('SELECT * FROM `serveurs` WHERE `ID` = :serveur');
$serve -> execute(array(':serveur' => $id));
$servet = $serve -> fetch(PDO::FETCH_ASSOC);
                        $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `serveur` = :id AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
                        $SQL -> execute(array(':id' => $id));
$concurr = $SQL -> fetchColumn(0);
if ($concurr >= $servet['concurrents']) {
                
                echo '<script type="text/javascript">
toastr["error"]("No server is available or online at the moment, please renew your request within minutes.")

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
                    else
                    {
if (empty($address) || empty($time) || empty($method))
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

if (isset($rate)) {
       if ($rate > 64)
 {
                    echo '<script type="text/javascript">
toastr["error"]("Please enter a value inferior than 65 requests.")

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

                    }}}
                    else{
                    if ($time < 15)
                    {
                    echo '<script type="text/javascript">
toastr["error"]("Please enter a value greater than 15 seconds minimum.")

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
                    else{
                    if (!filter_var($address, FILTER_VALIDATE_URL))
                        {
                            echo '<script type="text/javascript">
toastr["error"]("The request could not succeed, please insert an URL Website.")

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
</script>';                       }
                        else{
            
                       

	$allowedmode = array('POST', 'GET');
	if (!in_array($mode, $allowedmode))
	{
	echo'   <script type="text/javascript">
toastr["error"]("Please choose a correct Request Method.")

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
                        else{
    $allowedorigin = array('Worldwide', 'United_states', 'Germany', 'Brazil', 'Thailand', 'Vietnam', 'China', 'Hong_Kong', 'Korea', 'Japan', 'Italy', 'Netherland', 'Poland',);
	if (!in_array($origin, $allowedorigin))
	{
	echo'   <script type="text/javascript">
toastr["error"]("Please choose a correct Attack Origin.")

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
                        else{
                 $ServeurCompatible = $odb -> prepare("SELECT COUNT(*) FROM `methodes` WHERE `method` = :nom AND `classement` = :classement");
                 $ServeurCompatible -> execute(array(':nom' => $method, ':classement' => '7'));
                 $Verification = $ServeurCompatible -> fetchColumn(0);
                 if ($Verification == 0)
                 {
 echo'<script type="text/javascript">
toastr["error"]("It was not possible to start your shipment, please make sure that the selected attack method is available.")

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
                 else {
$SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = '$address' AND `user` = :username AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
$SQL -> execute(array(':username' => $_SESSION['username']));
$countRunningH = $SQL -> fetchColumn(0);
if ($countRunningH > 0)
                            {
                                echo '<script type="text/javascript">
toastr["error"]("You have too many boots running.")

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
</script>
';
                            }
                            else
                            {
                                                     $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = '$address' AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
            $SQL -> execute(array());
            $countRunningH = $SQL -> fetchColumn(0);
            if ($countRunningH == 1) {
                                echo '<script type="text/javascript">
toastr["error"]("Have an active attack on this target.")

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
</script>
';
                            }
                            else
                            { 
                            $SQLCheckBlacklist = $odb -> prepare("SELECT COUNT(*) FROM `blacklist` WHERE `IP` = :host");
                            $SQLCheckBlacklist -> execute(array(':host' => $address));
                            $countBlacklist = $SQLCheckBlacklist -> fetchColumn(0);
                            if ($countBlacklist > 0)
                            {
                                echo '<script type="text/javascript">
toastr["error"]("The request could not succeed, this address can not be attacked from our servers.")

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
</script>
';
                            }
                            else
                            {

                            $checkHoteSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = :ip AND `serveur` = :serveur AND `time` + `date` > UNIX_TIMESTAMP()");
                            $checkHoteSQL -> execute(array(':ip' => $address, ':serveur' => $serveur));
                            $countHote= $checkHoteSQL -> fetchColumn(0);
                            if ($countHote == 0)
                            {
                                
                                $checkServeurSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `serveur` = :serveur AND `time` + `date` > UNIX_TIMESTAMP()");
                                $checkServeurSQL -> execute(array(':username' => $_SESSION['username'], ':serveur' => $serveur));
                                $countServeur= $checkServeurSQL -> fetchColumn(0);
                                if ($countServeur == 0)
                                {                               
                                   $checkRunningSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP()");
                                   $checkRunningSQL -> execute(array(':username' => $_SESSION['username']));
                                   $countRunning = $checkRunningSQL -> fetchColumn(0);
                                    if ($countRunning < $userInfo['nbr'] +$userInf['concu'])
                                  {
                                    $SQLGetTime = $odb -> prepare("SELECT `plans`.`mbt` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
                                    $SQLGetTime -> execute(array(':id' => $_SESSION['ID']));
                                    $maxTime = $SQLGetTime -> fetchColumn(0);
                                    if (!($time > $maxTime +$userInf['secs']))
                                    {
                                        ini_set('default_socket_timeout', 1);
                                        $adresse = str_replace("%hote%", $address, $adresse);                                  
                                        $adresse = str_replace("%temps%", $time, $adresse);
                                        $adresse = str_replace("%type%", $method, $adresse);
                                        $adresse = str_replace("%mode%", $mode, $adresse);
                                        $adresse = str_replace("%rate%", $rate, $adresse);
                                        $adresse = str_replace("%host%", $host, $adresse);   
                                        $adresse = str_replace("%origin%", $origin, $adresse);
                                        $adresse = str_replace("%post%", $post, $adresse);                                   
                                        $adresse = str_replace("%user%", $_SESSION['username'], $adresse);
                                        APIinit($adresse, $odb);
                                        header('refresh: 2;');
                                        
                                        $insertLogSQL = $odb -> prepare("INSERT INTO `logs` VALUES(NULL, :user, :ip, :port, :time, :timerst, :method, :serveur, :note, '', UNIX_TIMESTAMP())");
                                        $insertLogSQL -> execute(array(':user' => $_SESSION['username'], ':ip' => $address, ':port' => '0', ':time' => $time, ':timerst' => $time, ':method' => $method, ':serveur' => $id, ':note' => "layer 7 info mode=$mode&rate=$rate&host=$host&origin=$origin&post=$post"));
                                        
                                        $updateServeur = $odb -> prepare("UPDATE `serveurs` SET `date` = UNIX_TIMESTAMP(NOW()) WHERE `ID` = :id");
                                        $updateServeur -> execute(array(':id' => $id));
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
</script>';
                                    } else {
                                    echo '<script type="text/javascript">
toastr["error"]("You do not have enough seconds, if you want to increase your sending time opt for a higher license or the purchase of additional seconds.")

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
                                    else
                                    {
                                        echo '<script type="text/javascript">
toastr["error"]("You have reached your maximum limit of simultaneous shipments.")

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
                                else   
                                {          
                                    echo '<script type="text/javascript">
toastr["error"]("You already have a shipment being processed from this server, please renew your request.")

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
                        else{
                        echo '<script type="text/javascript">
toastr["error"]("This address is already being processed from this server, please renew your request.")

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
</script>
';  
                            
                }   }  }  }  }   }
                        
                    }
                    }
                    }
                }
                } } }
                     }
                else{ 
                echo '   <script type="text/javascript">
toastr["error"]("No server is available or online at the moment, please renew your request within minutes.")

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
</script>
';
                }
                }
                ?>





		<?php
					
				if (isset($_POST['attaquer']))
				{

					$host = $_POST['hote'];
					$port = intval($_POST['port']);
					$time = intval($_POST['temps']);
					$method = $_POST['type'];
					$SQLGetInfo = $odb -> prepare("SELECT `classement` FROM `methodes` WHERE `method` = :method");
                    $SQLGetInfo -> execute(array(':method' => htmlspecialchars($method)));
                    $type = $SQLGetInfo -> fetchColumn(0);
					$serveurs = array();
					$serveur = "*";
					$ServeursRotation = $odb -> query("SELECT * FROM `serveurs` WHERE `type` = $type AND `status` = 0 ORDER BY ABS(`date`) ASC LIMIT 1;");
					if ($ServeursRotation -> rowCount() != 0) {
					$serveurs = $ServeursRotation -> fetchAll(PDO::FETCH_ASSOC);
					$id = $serveurs[0]['ID'];
					$adresse = $serveurs[0]['adresse'];
                                           $csrf = ($_POST['__csrf']);

                                                    if ($info["l4"] != 0)
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
					if (empty($host) || empty($time) || empty($port) || empty($method))
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
					}
					else{

$serve = $odb -> prepare('SELECT * FROM `serveurs` WHERE `ID` = :serveur');
$serve -> execute(array(':serveur' => $id));
$servet = $serve -> fetch(PDO::FETCH_ASSOC);
                        $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `serveur` = :id AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
                        $SQL -> execute(array(':id' => $id));
$concurr = $SQL -> fetchColumn(0);
if ($concurr >= $servet['concurrents']) {
                
                echo '<script type="text/javascript">
toastr["error"]("No server is available or online at the moment, please renew your request within minutes.")

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
                    else
                    {








					if ($time < 15)
					{
					echo '<script type="text/javascript">
toastr["error"]("Please enter a value greater than 15 seconds minimum.")

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
					else{ 
                                     if ($port < 1)
                    {
                    echo '<script type="text/javascript">
toastr["error"]("The minimum accepted port is 1.")

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
                    else{                if ($port > 65535)
                    {
                    echo '<script type="text/javascript">
toastr["error"]("The maximum accepted port is 65535.")

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
                    else{
			        if (!filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
						{
							echo '<script type="text/javascript">
toastr["error"]("The request could not succeed, please insert an IP address(v4).")

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
						else{
                 $ServeurCompatible = $odb -> prepare("SELECT COUNT(*) FROM `methodes` WHERE `method` = :nom AND `classement` = :classement");
                 $ServeurCompatible -> execute(array(':nom' => $method, ':classement' => '4'));
		         $Verification = $ServeurCompatible -> fetchColumn(0);
		         if ($Verification == 0)
		         {
 echo'<script type="text/javascript">
toastr["error"]("It was not possible to start your shipment, please make sure that the selected attack method is available.")

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
				 else {
$SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = '$host' AND `user` = :username AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
$SQL -> execute(array(':username' => $_SESSION['username']));
$countRunningH = $SQL -> fetchColumn(0);
if ($countRunningH > 0)
                            {
                                echo '<script type="text/javascript">
toastr["error"]("You have too many boots running.")

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
</script>
';
                            }
                            else
                            { 

                     $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = '$host' AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
            $SQL -> execute(array());
            $countRunningH = $SQL -> fetchColumn(0);
            if ($countRunningH == 1) {
                                echo '<script type="text/javascript">
toastr["error"]("Have an active attack on this target.")

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
</script>
';
                            }
                            else
                            { 

							$SQLCheckBlacklist = $odb -> prepare("SELECT COUNT(*) FROM `blacklist` WHERE `IP` = :host");
							$SQLCheckBlacklist -> execute(array(':host' => $host));
							$countBlacklist = $SQLCheckBlacklist -> fetchColumn(0);
							if ($countBlacklist > 0)
							{
								echo '<script type="text/javascript">
toastr["error"]("The request could not succeed, this address can not be attacked from our servers.")

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
</script>
';
							}
							else
							{

							$checkHoteSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = :ip AND `serveur` = :serveur AND `time` + `date` > UNIX_TIMESTAMP()");
							$checkHoteSQL -> execute(array(':ip' => $host, ':serveur' => $serveur));
							$countHote= $checkHoteSQL -> fetchColumn(0);
							if ($countHote == 0)
							{
								
								$checkServeurSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `serveur` = :serveur AND `time` + `date` > UNIX_TIMESTAMP()");
								$checkServeurSQL -> execute(array(':username' => $_SESSION['username'], ':serveur' => $serveur));
								$countServeur= $checkServeurSQL -> fetchColumn(0);
								if ($countServeur == 0)
								{								
								   $checkRunningSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP()");
								   $checkRunningSQL -> execute(array(':username' => $_SESSION['username']));
								   $countRunning = $checkRunningSQL -> fetchColumn(0);
								    if ($countRunning < $userInfo['nbr'] +$userInf['concu'])
								  {
									$SQLGetTime = $odb -> prepare("SELECT `plans`.`mbt` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
									$SQLGetTime -> execute(array(':id' => $_SESSION['ID']));
									$maxTime = $SQLGetTime -> fetchColumn(0);
								    if (!($time > $maxTime +$userInf['secs']))
									{
									    ini_set('default_socket_timeout', 1);
										$adresse = str_replace("%hote%", $host, $adresse);									
										$adresse = str_replace("%temps%", $time, $adresse);
										$adresse = str_replace("%port%", $port, $adresse);
										$adresse = str_replace("%type%", $method, $adresse);
										$adresse = str_replace("%user%", $_SESSION['username'], $adresse);
										APIinit($adresse, $odb);
										header('refresh: 2;');
										
                                        $insertLogSQL = $odb -> prepare("INSERT INTO `logs` VALUES(NULL, :user, :ip, :port, :time, :timerst, :method, :serveur, :note, '', UNIX_TIMESTAMP())");
										$insertLogSQL -> execute(array(':user' => $_SESSION['username'], ':ip' => $host, ':port' => $port, ':time' => $time, ':timerst' => $time, ':method' => $method, ':serveur' => $id, ':note' => 'Layer 4'));
										
										$updateServeur = $odb -> prepare("UPDATE `serveurs` SET `date` = UNIX_TIMESTAMP(NOW()) WHERE `ID` = :id");
										$updateServeur -> execute(array(':id' => $id));
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
</script>';
									} else {
									echo '<script type="text/javascript">
toastr["error"]("You do not have enough seconds, if you want to increase your sending time opt for a higher license or the purchase of additional seconds.")

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
									else
									{
										echo '<script type="text/javascript">
toastr["error"]("You have reached your maximum limit of simultaneous shipments.")

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
								else   
								{          
									echo '<script type="text/javascript">
toastr["error"]("You already have a shipment being processed from this server, please renew your request.")

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
						else{
						echo '<script type="text/javascript">
toastr["error"]("This address is already being processed from this server, please renew your request.")

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
</script>
';	}}
						}	
						}
						}
					}
					}
					}}
				}
				}
				}   }   }
				else{ 
				echo '   <script type="text/javascript">
toastr["error"]("No server is available or online at the moment, please renew your request within minutes.")

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
</script>
';
				}
				}
				?>

