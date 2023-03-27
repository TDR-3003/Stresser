<?php
 $page = 'Tickets';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Tickets</h4><div class="ml-auto">
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
                              <div class="card-title">Tickets under study                              </div>
                           </div>
                           <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">

                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>

  







				<?php 
			$SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `status` = :status OR `status` = :status2 ORDER BY `id` DESC");
			$SQLGetTickets -> execute(array(':status' => 'Waiting for admin response', ':status2' => '<span class="label label-success">En cours d\'étude</span>'));
			while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['id'];
				$username = $getInfo['username'];
				$date = $getInfo['date'];

                  $getInfod = $odb -> query("SELECT * FROM `messages` WHERE `ticketid` = '$id' ORDER BY `messageid` DESC LIMIT 1");
      while ($show = $getInfod -> fetch(PDO::FETCH_ASSOC))
     {
				
				echo '
				<tr>
				<td><a href="t?id='.$id.'"><code><u>'.$username.'</u></code></a></td>
				<td>'.strftime("%d %B - %H:%M", $show['date']).'</td>
				</tr>';
			}}
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




