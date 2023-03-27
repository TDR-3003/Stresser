<?php
 $page = 'Users';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Users</h4><div class="ml-auto">
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
                    <th>ID</th>
                    <th>User</th>
                    <th>Subscription</th>
                    <th>Statue</th>
                    <th>Rank</th>
                                        </tr>
                                    </thead>


                                    <tbody>
        <?php
                $SQLGetUsers = $odb -> query("SELECT * FROM `users` ORDER BY `ID` DESC");
                while ($getInfo = $SQLGetUsers -> fetch(PDO::FETCH_ASSOC))
                {
                  $id = $getInfo['ID'];
                  $usert = $getInfo['username'];
                  $membership = ($getInfo['membership'] == 0) ? '<span class="label label-default">Not membership</span>' : '<span class="label label-info">membership</span>';
                  $status = ($getInfo['status'] == 1) ? '<span class="label label-danger">Banned</span>' : '<span class="label label-success">Active</span>';
                  $rank = ($getInfo['rank'] == 1) ? 'Admin' : 'Users';
                  echo '
                  <tr>
                  <td>'.$id.'</td>
                  <td><u><a style="color:blu" href="user?id='.$id.'">'.$usert.'</a></u></td>
                  <td>'.$membership.'</td>
                  <td>'.$status.'</td>
                  <td>'.$rank.'</td>
                  </tr>';
                }
                ?>
                                    
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
             
     <!-- partial:partials/_footer.html -->
<?php include'footer.php'; ?> 

            </div>
        </div>

        <div class="rightbar-overlay"></div>
    </body>
</html>

