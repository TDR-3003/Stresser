<?php
 $page = 'Transactions';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Transactions</h4><div class="ml-auto">
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
                              <div class="card-title">Transactions of the month                              </div>
                           </div>
                           <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                      <thead>
                        <tr>
                    <th>Username</th>									 
					<th>Licence/Option</th>
					<th>Statut</th>
					<th>Date of purchase</th>
                        </tr>
                      </thead>
                      <tbody>
				<?php 
				  $SQLSelect = $odb -> prepare("SELECT * FROM `historique` WHERE `statut` = :statut ORDER BY `date` DESC");
				  $SQLSelect -> execute(array(':statut' => '<span class="label label-success">Payé</span>'));
				  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $show['id'];
				$username = $show['username'];
				$licence = $show['licence'];
				$statut = $show['statut'];

				echo '<tr>      <td>'.htmlspecialchars($username).'</td>
				                <td>'.$licence.'</td>
								<td>'.$statut.'</span>
								<td>'.strftime("%d %B - %H:%M", $show['date']).'</td>
				</tr>';
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


