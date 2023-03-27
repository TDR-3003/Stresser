<?php
$page = "Ticket";
include'admin.php';

$instantidpub = $_GET['id'];

if(is_numeric($instantidpub) == false) {
header('Location: /support');
exit;
}
?>

    				<?php
	   $SQLGetTickets = $odb -> query("SELECT * FROM `tickets` WHERE `id` = $instantidpub");
	   while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
	   {
		$username = $getInfo['username'];
		$status = $getInfo['status'];
        $date = $getInfo['date'];
        $contentes = openssl_decrypt($getInfo['content'], "AES-128-ECB" ,$keykey);

        if ($getInfo['view'] == ''){
$SQLUpdate = $odb -> prepare("UPDATE `tickets` SET `view` = :view WHERE `id` = :id");
$SQLUpdate -> execute(array(':view' => time(), ':id' => $instantidpub));
}
 
		}
	   $SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :username");
	   $SQL -> execute(array(':username' => $username));
	   while ($getInf = $SQL -> fetch(PDO::FETCH_ASSOC))
	   {
		$avatt = $getInf['avatar'];
		}
        if ($avatt == '0'){
$usert = 'favicon.ico';}
else{
$usert = $getInf['avatar'];
   }
	   if (isset($_POST['closeBtn']))
	   {
$SQLupdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
$SQLupdate -> execute(array(':status' => 'Closed', ':id' => $instantidpub));
echo '<center><div class="alert alert-success"><strong>Very good!</strong> This ticket is no longer supported.</div></center>';


		$SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
        $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Closing the ticket '.$instantidpub.''));
 	   }
	   if (isset($_POST['updateBtn']))
	   {

			$errors = array();
			if (empty($_POST['content']))
			{
				$errors[] = 'An error has occurred, information is missing.';
			}
			if (empty($errors))
			{   
             $updatecontent = openssl_encrypt($_POST['content'], "AES-128-ECB" ,$keykey);
             $private = openssl_decrypt('Welcome', "AES-128-ECB" ,$keykey);
				$SQLinsert = $odb -> prepare("INSERT INTO `messages` VALUES(NULL, :ticketid, :content, :sender, :view, UNIX_TIMESTAMP())");
				$SQLinsert -> execute(array(':sender' => $_SESSION['username'], ':view' => '', ':content' => $updatecontent, ':ticketid' => $instantidpub));
                $SQL = $odb -> prepare("DELETE FROM `messages` WHERE `sender` = :sender AND `ticketid` = :ticketid AND `content` = :content LIMIT 1");
                $SQL -> execute(array(':sender' => 'Automatic System', ':ticketid' => $instantidpub, ':content' => $private));
			{
				$SQLUpdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
				$SQLUpdate -> execute(array(':status' => 'New message', ':id' => $instantidpub));
				echo '<center><div class="alert alert-success"><strong>Very good!</strong> Your response was successfully sent.</div></center>';
			{	
			    
			    $SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Response sent to ticket '.$instantidpub.''));
			}
			}
			}
			else
			{
				echo '<center><div class="alert alert-danger">';
				foreach($errors as $error)
				{
					echo '<strong>Incident !</strong> '.$error.'.';
				}
				echo '</div></center>';
			}
		}
?>
       <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Ticket</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Messages
                                    </div>
                                </div>
                                <div>
                                    <div class="chat-conversation p-3">
                                        <ul class="list-unstyled mb-0" data-simplebar="init" style="max-height: 486px;">
                                            <div class="simplebar-wrapper" style="margin: 0px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 0px;">




    
			<?php

			$SQLGetMessages = $odb -> prepare("SELECT * FROM `messages` WHERE `ticketid` = :ticketid ORDER BY `messageid` ASC");
			$SQLGetMessages -> execute(array(':ticketid' => $instantidpub));
			while ($getInfo = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC)){
			{
				$sender = $getInfo['sender'];
        $date = $getInfo['date'];
        $contente = openssl_decrypt($getInfo['content'], "AES-128-ECB" ,$keykey);

            if ($getInfo['view'] == ''){
$SQLUpdate = $odb -> prepare("UPDATE `messages` SET `view` = :view WHERE `ticketid` = :ticketid AND `sender` = :sender ORDER BY `messageid` ASC");
       $SQLUpdate -> execute(array(':view' => time(), ':ticketid' => $instantidpub, ':sender' => 'Client'));
}          

         if ($sender == 'Client'){
$senderz = $username;}
else{
$senderz = $sender;
	 }        

     if ($sender == 'Client'){
$li = '<li>';}
else{
$li = '<li class="right">';
   }
        if ($sender == 'Client'){
$avatar = '/assets/images/'.$usert.'';}
else{
$avatar = '/assets/images/Admin.png';
   } }
    echo '

		 '.$li.'
                                                                    <div class="conversation-list"><div class="ctext-wrap"><img class="rounded-circle header-profile-user" src="'.$avatar.'" alt="Header Avatar"><img/>
                                                                       <br>
                                                                            <div class="conversation-name">'.$senderz.'</div>
                                                                            <p>'.htmlspecialchars($contente).'</p>
                                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> '.strftime("%d %B", $getInfo['date']).' <span>'. strftime("%H:%M", $getInfo['date']).'</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
	
                                             ';

  
     }

  

?>
                                                    
                                                                                                                                <div id="scroll"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: auto; height: 639px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 369px; transform: translate3d(0px, 117px, 0px); display: block;"></div>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="p-3 chat-input-section">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <form method="POST">
                                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                                        <textarea name="content" type="text" class="form-control chat-input" placeholder="Enter Message..." style="margin-top: 0px; margin-bottom: 0px; height: 37px;"></textarea>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-auto"><form method="POST">
                                                <button type="submit" name="updateBtn" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                            </form></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                    Ticket <?php echo $instantidpub; ?>                                    </div>
                                </div>
                                <div class="card-box">
                                                                        <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td class="text-white" style="width: 50%"><span class="badge bg-danger"><?php echo $status; ?></span></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Last Update</th>
                                                <td class="text-white" style="width: 50%"><?php echo strftime("%d.%m.%Y", $date); ?> <span><?php echo strftime("%H:%M:%S", $date); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <form class="col-xl-12" method="POST" autocomplete="off" class="comment-area-box mb-3">
                                           <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
                                            <div class="form-group"><button name="closeBtn" type="submit" class="btn btn-danger w-sm waves-effect waves-light btn-block"><i class="far fa-times-circle"></i> Close</button></div>
                                        </form>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="/tickets" class="btn btn-light w-sm waves-effect waves-light btn-block"><i class="far fa-arrow-alt-circle-left"></i> Go back</a>
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

        <div class="rightbar-overlay"></div>
    </body>
</html>







