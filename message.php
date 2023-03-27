<?php
$page = "Message";
include'header.php';
$hdejnedi = $userInf['message'];
$SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `tickets` WHERE `id` = :id AND `username` = :username");
$SQLCheckLogin -> execute(array(':id' => $hdejnedi, ':username' => $_SESSION['username']));
$countLogin = $SQLCheckLogin -> fetchColumn(0);
if ($countLogin == 0)
{
header('Location: /support');
}
?>
<?php
$SQLGetTickets = $odb -> query("SELECT * FROM `tickets` WHERE `id` = $hdejnedi");
while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
{
$username = $getInfo['username'];
$status = $getInfo['status'];
$date = $getInfo['date'];
}
$getInfod = $odb -> query("SELECT * FROM `messages` WHERE `ticketid` = '$hdejnedi' ORDER BY `messageid` DESC LIMIT 1");
$getInfod -> execute(array(':username' => $_SESSION['username']));
while ($show = $getInfod -> fetch(PDO::FETCH_ASSOC))
{
$datelast = $show['date']; 
}
?>
<script type="text/javascript">
function nbrCara(cara,nbrcara) {
  var nombre = document.getElementById(cara).value.length;
  document.getElementById(nbrcara).innerHTML = nombre;
}
</script>
<script type="text/javascript">
element = document.getElementById('scroll');
element.scrollTop = element.scrollHeight;
</script>

    
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




			<a id="ticket"></a>

                                                    
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
                                                    <form method="POST" action="request/ticket">
                                                        <input type="hidden" id="__csrf" name="__csrf" value="<?php echo $_SESSION['token']; ?>">
<textarea id="count" name="content" type="text" class="form-control chat-input" cols="50" rows="5" onkeyup="nbrCara('count','nbrcara');" onkeydown="nbrCara('count','nbrcara');" onmouseout="nbrCara('count','nbrcara');" placeholder="Enter Message..." style="margin-top: 0px; margin-bottom: 0px; height: 37px;"></textarea>
 <strong>Number of characters : <span id="nbrcara">0</span>/100Max</strong>
                                                </div>
                                            </div>
                                            <div class="col-auto">

                                                <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
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
                                    Panel                                    </div>
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
                                                <td style="width: 50%"><?php echo strftime("%d.%m.%Y", $datelast); ?> <span><?php echo strftime("%H:%M:%S", $datelast); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="/support" class="btn btn-light w-sm waves-effect waves-light btn-block"><i class="far fa-arrow-alt-circle-left"></i> Go back</a>
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









