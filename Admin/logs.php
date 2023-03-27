<?php
 $page = 'Logs';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Logs</h4><div class="ml-auto">
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
  <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">List of users</h4>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                    <th>Username</th>
                    <th>IP Address</th>
                    <th>Statue</th>
                    <th>Connection Date</th>
                                        </tr>
                                    </thead>


                                    <tbody>
         <?php
        $SQLGetLogs = $odb -> query("SELECT * FROM `loginlogs` ORDER BY `date` DESC");
        while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
        {
          $usert = $getInfo['username'];
          $IP = $getInfo['status'];
          $Statue = $getInfo['ip'];

          echo '
          <tr>
          <td>'.$usert.'</td>
          <td>'.$Statue.'</td>          
          <td>'.$IP.'</td>
          <td>'.strftime("%d %B %Y à %Hh%M" ,$getInfo['date']).'</td>
      </tr>';
        } 
                  
        ?> 
                                    
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
             






<?php include'footer.php'; ?> 

            </div>
        </div>

        <div class="rightbar-overlay"></div>
    </body>
</html>

