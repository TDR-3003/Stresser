<?php 

include 'includes/configuration.php'; 


$user = $_GET['user'];
$api_key = $_GET['api_key'];
$host = $_GET['stopper'];

$SQLCheck = $odb -> prepare("SELECT COUNT(*) FROM `apiplus` WHERE `apikey` = :key AND `user` = :user");
$SQLCheck -> execute(array(':key' => $api_key, ':user' => $user));
$countClef = $SQLCheck -> fetchColumn(0);
if ($countClef == 0)
{
echo'Your Key or your User ID is invalid .';
exit();
} else {

$SQLGetInfo = $odb -> prepare("SELECT * FROM `users` WHERE `ID` = :id");
$SQLGetInfo -> execute(array(':id' => $user));
$userInf = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);

$utilisateur = $userInf['username'];
$IDacc = $userInf['ID'];
$concu = $userInf['concu'];

$SQLGetIn = $odb -> prepare('SELECT * FROM `apiplus` WHERE `apikey` = :key');
$SQLGetIn -> execute(array(':key' => $api_key));
$userIn = $SQLGetIn -> fetch(PDO::FETCH_ASSOC);

$userIP = $userIn['ip'];
$usertimeapi = $userIn['timeapi'];

//if ($userIP != $_SERVER["REMOTE_ADDR"]){
//echo'Your iP address is not authorized to use this API.';
//exit();
//} else {




					if (empty($user) || empty($api_key) || empty($host))
					{
					echo 'Please verify all fields. Try: stop?user=IDuser&api_key=key&host=1.1.1.1';
					}
		            else
		            {


$SQL = $odb -> prepare("SELECT * FROM `logs` WHERE `id` = :id AND `user` = :user  AND `time` + `date` < UNIX_TIMESTAMP()");
$SQL -> execute(array(':user' => $utilisateur, ':id' => $id));
$result = $SQL -> fetchColumn(0);
if ($result != 0)
{
echo 'This shipment is already complete.'; 
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
$adresse = str_replace("%user%", $utilisateur, $adresse);
APIinit($adresse, $odb);
}
$SQLUpdate = $odb -> prepare("UPDATE `logs` SET `time` = 0 WHERE `user` = :user AND `id` = :id AND `time` + `date` > UNIX_TIMESTAMP()");
$SQLUpdate -> execute(array(':user' => $utilisateur, ':id' => $id));

}}}