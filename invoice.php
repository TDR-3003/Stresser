<?php
$page = 'Create Ticket';
include'header.php';


// Check code
if(!isset($_GET['code'])){
    exit();
}
$code = $_GET['code'];

$SQLGetInfo = $odb -> prepare("SELECT * FROM `invoices` WHERE `code` = :code AND `username` = :username");
$SQLGetInfo -> execute(array(':username' => $_SESSION['username'],':code' => $code));
$userInfssz = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
// Get invoice information
$address = $userInfssz['address'];

$status = $userInfssz['status'];

$price = $userInfssz['sold'];

// Status translation

$statusval = $status;
$info = "";
if($status == 0){
    $status = "<span style='color: orangered' id='status'>PENDING</span>";
    $info = "<p>You payment has been received. Invoice will be marked paid on two blockchain confirmations.</p>";
}else if($status == 1){
    $status = "<span style='color: orangered' id='status'>PENDING</span>";
    $info = "<p>You payment has been received. Invoice will be marked paid on two blockchain confirmations.</p>";
}else if($status == 2){
    $status = "<span style='color: green' id='status'>PAID</span>";
}else if($status == -1){
    $status = "<span style='color: red' id='status'>UNPAID</span>";
}else if($status == -2){
    $status = "<span style='color: red' id='status'>Too little paid, please pay the rest.</span>";
}else {
    $status = "<span style='color: red' id='status'>Error, expired</span>";
}

$cours=file_get_contents("https://blockchain.info/tobtc?currency=USD&value=".$price."");
echo $cours;

            
            // QR code generation using google apis
            $cht = "qr";
            $chs = "300x300";
            $chl = $address;
            $choe = "UTF-8";

            $qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;
            ?>


    <!-- Invoice -->
    
         <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"></h4>
                            </div>
                        </div>
                    </div>
              
       <div class="row">
          <div class="col-lg-9">

                        <div class="card border border-primary">
                            <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary"><div class="spinner-border text-primary me-3" role="status"><span class="sr-only"></span></div> Awaiting payment...</h5>
                            </div>
                            <div class="card-body">
                          
                                    <p><span class="text-danger"><i class="fas fa-exclamation-triangle"></i></span> Your payment will be accepted after 1 confirmation.</p>
                                    <p><span class="text-primary"><i class="fas fa-credit-card"></i></span> Address:
                                    <input type="text" class="form-control" value="<?php echo $address; ?>" placeholder="" onclick="this.select();document.execCommand('copy');toastr['success']('Successfully copied!', '');">
                                    <p><span class="text-primary"><i class="fab fa-bitcoin"></i></span> Amount (BTC): <b>0.00069985</b></p><br>
                                    <p>Pay strictly according to the specified details! Otherwise you will not receive your package.</p>
                                    <form method="post">
                                        <button id="doClose" name="doClose" type="submit" class="btn waves-effect waves-light btn-primary">Close Invoice</button>
                                    </form>
                                </div>
                            </div>
                         </div>
    
<div class="col-lg-3">
                        <div class="card border border-primary">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary">QR code:</h5>
                            </div>
                            <div class="card-body">
                                <div class="qr-hold">
                 <center><img src="<?php echo $qrcode ?>" alt="My QR code" style="width:150px;">
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
    <script>
        var status = <?php echo $statusval; ?>
        
        // Create socket variables
        if(status < 2 && status != -2){
        var addr =  document.getElementById("address").innerHTML;
        var wsuri2 = "wss://www.blockonomics.co/payment/"+ addr;
        // Create socket and monitor
        var socket = new WebSocket(wsuri2, "protocolOne")
            socket.onmessage = function(event){
                console.log(event.data);
                response = JSON.parse(event.data);
                //Refresh page if payment moved up one status
                if (response.status > status)
                  setTimeout(function(){ window.location=window.location }, 1000);
            }
        }
        
    </script>

    </body>
</html>
