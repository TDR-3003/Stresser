<?php
 $page = 'Send';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Send</h4><div class="ml-auto">
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
                              <div class="card-title">Daily history                              </div>
                           </div>
                           <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                      <thead>
                        <tr>
                    <th>Username</th>
					<th>Ser target information</th>
					<th>Saling time</th>
					<th>Method</th>
					<th>Server</th>
					<th>Date sent</th>
					<th>Type</th>
					<th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
				<?php	
$SQLGetLogs = $odb -> query('SELECT * FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP()');
while($ArrayInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC)){

$id = $ArrayInfo['id'];		
$name = $ArrayInfo['user'];	
$port = $ArrayInfo['port'];
$time = $ArrayInfo['time'];
$IP = $ArrayInfo['ip'];
$note = $ArrayInfo['note'];
$method = $ArrayInfo['method'];
$serveur = $ArrayInfo['serveur'];
$date = strftime("%d %B - %H:%M" ,$ArrayInfo['date']);

$cible = $ArrayInfo['date']+$ArrayInfo['time'];
	
$now = time();

$seconde = $cible - $now;

if(isset($_POST[''.$id.'']))
{
$SQLSelect = $odb -> prepare("SELECT * FROM `serveurs` WHERE `ID` = :nom");
$SQLSelect -> execute(array(':nom' => $serveur));
while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
{
$adresse = $show['adresse'];										
ini_set('default_socket_timeout', 1);
$adresse = str_replace("%hote%", $IP, $adresse);
$adresse = str_replace("%temps%", "60", $adresse);
$adresse = str_replace("%port%", "80", $adresse);
$adresse = str_replace("%type%", "STOP", $adresse);
$adresse = str_replace("%user%", $name, $adresse);
$adresse = str_replace("%src%", "", $adresse);
@file_get_contents($adresse); 
}
$ip = getRealIpAddr();
$SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
$SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Cancellation of the shipment '.$id.' launched by '.$name.''));

$SQLUpdate = $odb -> prepare("UPDATE `logs` SET `time` = 0 WHERE `user` = :user AND `id` = :id AND `time` + `date` > UNIX_TIMESTAMP()");
$SQLUpdate -> execute(array(':user' => $name, ':id' => $id));
echo '<meta http-equiv="refresh" content="0;">';

}

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
     return;
  }
document.getElementById("stress<?php echo $id; ?>").innerHTML=count<?php echo $id; ?>;
}
</script>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo htmlspecialchars($IP); ?>:<?php echo $port; ?></td>
<td><span id="stress<?php echo $id; ?>"></span></td>
<td><?php echo $method; ?></td>
<td><?php echo $serveur; ?></td>
<td><?php echo $date; ?></td>
<td><?php echo $note; ?></td>
<td>
<button class="btn btn-danger btn-sm" type="submit" name="<?php echo $id; ?>">Stop</button></td>
</tr>
<?php

}
?> 
                      </tbody>
                    </table>
                 

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


