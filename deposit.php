     <?php
$page = "Deposit";
include'header.php';
    $url = "https://www.blockonomics.co/api/";
    
    $options = array( 
        'http' => array(
            'header'  => 'Authorization: Bearer '.$apikey,
            'method'  => 'POST',
            'content' => '',
            'ignore_errors' => true
        )   
    );

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




function generateAddress(){
    global $apikey;
    global $url;
    $options = array( 
        'http' => array(
            'header'  => 'Authorization: Bearer 8NKHIcDJ0zEdJy9lU97OY3ZhxW1UGaGvqKtDped7m4M',
            'method'  => 'POST',
            'content' => '',
            'ignore_errors' => true
        )   
    );  
    
    $context = stream_context_create($options);
    $contents = file_get_contents($url."new_address", false, $context);
    $object = json_decode($contents);
    
    // Check if address was generated successfully
    if (isset($object->address)) {
      $address = $object->address;
    } else {
      // Show any possible errors
      $address = $http_response_header[0]."\n".$contents;
    }
    return $address;
}

function createInvoice($sold){
    global $odb;
    $getIp = file_get_contents("https://api.ipify.org");
    $code = generateRandomString(25);
    $address = generateAddress();
    $status = -1;
    $username = $_SESSION['username'];
                        $insertUser = $odb -> prepare("INSERT INTO `invoices` VALUES(NULL, :code, :address, :sold, :status, :username, :ip, UNIX_TIMESTAMP())");
                        $insertUser -> execute(array(':code' => $code, ':address' => $address, ':sold' => $sold, ':status' => $status, ':username' => $username, ':ip' => $getIp));
    return $code;
}

?>
           <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Deposit</h4><div class="ml-auto">
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
                                       Deposit Balance
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                    <div class="form-group"><label class="form-label">Sold</label> 

 <input class="form-range" step="1" min="20" max="200" value="0" oninput="this.form.amonde.value=this.value" type="range"><input class="form-control" required="" name="amonde" type="number" placeholder="Min: 20$, Max: 200$" value="20">

                          </div>
                                    
                                      

                       <div class="form-group"><label class="form-label">Type amonde</label>            
                        <select class="form-control" name="to" title="to" disabled="">
                        <option>BTC</option>
                        </select>
              
                                 
                                </div> </div>

                                <div class="card-footer text-right"><button type="submit" name="Depose" class="btn btn-primary">Depose</button></div></form>
                            </div>
                </div>
         <div class="col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Current price
                                      </div>
                              </div>
                              <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class="table ">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Balance</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Last reply</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
      $SQLGetTickets = $odb -> prepare("SELECT * FROM `invoices` WHERE `username` = :username ORDER BY `id` DESC");
      $SQLGetTickets -> execute(array(':username' => $_SESSION['username']));
      while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
      {
        $id = $getInfo['id'];
       $code = $getInfo['code'];
        $sold = htmlspecialchars($getInfo['sold']);
        $status = $getInfo['status'];
        $date = $getInfo['date'];

        if($status == 0){
    $status = "PENDING";
    $info = "You payment has been received. Invoice will be marked paid on two blockchain confirmations.";
}else if($status == 1){
    $status = "<span style='color: orangered' id='status'>PENDING</span>";
    $info = "You payment has been received. Invoice will be marked paid on two blockchain confirmations.";
}else if($status == 2){
    $status = "PAID";
}else if($status == -1){
    $status = "UNPAID";
}else if($status == -2){
    $status = "Too little paid, please pay the rest.";
}else {
    $status = "Error, expired";
}
           ?>
       
  
                                                                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td>$<?php echo $sold; ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td><?php echo strftime("%d %B - %H:%M", $date); ?></td>
                                                    <td><a class="btn btn-outline-primary btn-sm btn-block" href="invoice.php?code=<?php echo $code; ?>" type="button"><i class="mdi mdi-pencil"></i></a></td>
                                                </tr>
                                                            <?php } ?>                                     </tbody>
                                        </table> 


                                        <div class="d-flex gap-2 flex-wrap">
                                            <div class="btn-group">
                                                <div class="dropdown-menu">
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
       if (isset($_POST['Depose']))
       {
       
    
            $sold = ($_POST['amonde']);  
                     if ($info["deposit"] != 0)
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
            if (empty($sold))
            {
  echo'<script type="text/javascript">
toastr["error"]("Please fill all.")

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
        if ($sold < 20)
    {
    echo'   <script type="text/javascript">
toastr["error"]("Please choose a correct sold.")

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
}else{        if ($sold < 20)
    {
    echo'   <script type="text/javascript">
toastr["error"]("Please choose a correct Sold.")

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
}else{        if ($sold > 200)
    {
    echo'   <script type="text/javascript">
toastr["error"]("Please choose a correct Sold.")

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
      $SQLCount = $odb -> prepare("SELECT COUNT(*) FROM `invoices` WHERE `username` = :username AND `status` = '-1'");
$SQLCount -> execute(array(':username' => $_SESSION['username']));
if ($SQLCount -> fetchColumn(0) > 1)
{
  echo'   <script type="text/javascript">
toastr["error"]("you already have a pending deposit.")

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
$code = createInvoice($sold);

echo "<script>window.location='invoice?code=".$code."'</script>";
{

            }}

            }
        
             }  
     } }}
    }
       ?>