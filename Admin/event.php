<?php
 $page = 'Event';
 include"admin.php";
?>
<div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0 font-size-18">Event</h4><div class="ml-auto">
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
<?php
		if (isset($_POST['addBtn']))
		{
			$titleAdd = $_POST['titleAdd'];
			$detailAdd = $_POST['detailAdd'];
			$errors = array();
			if (empty($titleAdd) || empty($detailAdd))
			{
				$errors[] = 'S\'il vous plaît, vérifier tout les champs';
			}
			if (empty($errors))
			{
				$SQLinsert = $odb -> prepare("INSERT INTO `news` VALUES(NULL, :title, :detail, UNIX_TIMESTAMP())");
				$SQLinsert -> execute(array(':title' => $titleAdd, ':detail' => $detailAdd));
				echo '<center><div class="alert alert-success"><strong>Very good!</strong> This event was successfully added to the database.</div></center>';
				

				$SQLinsert = $odb -> prepare("INSERT INTO `admin_historique` VALUES(NULL, :username, :ip, :action, UNIX_TIMESTAMP())");
                $SQLinsert -> execute(array(':username' => $_SESSION['username'], ':ip' => $ip, ':action' => 'Adding a new event'));
			}
			else
			{
				echo '<center><div class="alert alert-danger"><strong>Incident !</strong> ';
				foreach($errors as $error)
				{
					echo ''.$error.'.';
				}
				echo '</div></center>';
			}
		}
		
		if (isset($_POST['deleteBtn']))
		{
			$deletes = $_POST['deleteCheck'];
			foreach($deletes as $delete)
			{
				$SQL = $odb -> prepare("DELETE FROM `news` WHERE `ID` = :id LIMIT 1");
				$SQL -> execute(array(':id' => $delete));
			}
			echo '<div class="alert alert-success"><strong>Very good!</strong> This event was successfully removed from the database.</div>';
		}
		?> <div class="row">
<div class="col-md-6">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Add Event                              </div>
                           </div>
                           <div class="card-body">
                  <form class="forms-sample" method="POST">
                    <div class="form-group row">
                      <label for="titleAdd" class="col-sm-3 col-form-label">Sujet</label>
                      <div class="col-sm-9">
                      <input type="text" id="titleAdd" name="titleAdd" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="detailAdd" class="col-sm-3 col-form-label">Content</label>
                      <div class="col-sm-9">
                      <textarea class="form-control" id="detailAdd" name="detailAdd" rows="3"></textarea>
                      </div>
              </div>
                    <div class="form-check form-check-flat form-check-primary">                      
                    </div>
                    <button type="submit" name="addBtn" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>


<div class="col-md-6">
    <div class="card" style="height: 95.2%;">
                           <div class="card-header">
                              <div class="card-title">Add Event                              </div>
                           </div>
                           <div class="card-body">
                  <form method="POST">
                  <div class="table-responsive">
                    <table class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Check</th>
                          <th>Sujet</th>
                          <th>Content</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
				<?php
				  $SQLSelect = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC");
				  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
				  {
					$titleShow = $show['title'];
					$detailShow = $show['detail'];
					$rowID = $show['ID'];
					$date = $show['date'];
					echo '
					<tr>
					<td>
<div class="form-check form-checkbox-outline form-check-success mb-3">
                                                    <input class="form-check-input" type="checkbox" name="deleteCheck[]" value="'.$rowID.'"></td>
					<td>'.$titleShow.'</td>
					<td>'.$detailShow.'</td>
					<td>'.strftime("%d %B - %H:%M", $show['date']).'</td>
					</tr>';
				  }
				  ?>	
                      </tbody>
                    </table>
                 
                <div class="form-check form-check-flat form-check-primary">                      
                    </div>
                	<button type="submit" name="deleteBtn" class="pull-right btn btn-danger  waves-effect"><i class="icon-trash menu-icon"></i> Delete</button>
                  </form>
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