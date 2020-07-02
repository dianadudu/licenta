<?php
// Initializare sesiune
session_start();
error_reporting(0);
require_once "../utile/config.php";
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	include('utile/header.php');

if(isset($_POST['submit']))
  {	
	$name=$_POST['name'];
	$email=$_POST['email'];

	$sql="UPDATE admin SET username=(:name), email=(:email)";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$msg="Informatiile au fost actualizate cu succes !";
}    
?>

<body>
	<?php include('utile/bara-sus.php');?>
	<div class="ts-main-content">
	<?php include('utile/meniu.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Notificări</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Notificări</div>
									   <div class="panel-body">
									   <table id="zctb" class="display table table-striped table-bordered table-hover table-padding" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Data</th>
													<th>Tipul</th>
													<th>Utilizator</th>
												</tr>
											</thead>
											
											<tbody>
												<?php 
												$destinatar = 'Admin';
												$sql = "SELECT * from  notificari where destinatar = (:destinatar) order by timp DESC";
												$query = $dbh -> prepare($sql);
												$query-> bindParam(':destinatar', $destinatar, PDO::PARAM_STR);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
												foreach($results as $result) { ?>	
												<tr>
													<td><?php echo htmlentities($cnt);?></td>
													<td><?php echo htmlentities($result->timp);?></td>
													<td><?php echo htmlentities($result->tip);?></td>
													<td><?php echo htmlentities($result->expeditor);?></td>
												</tr>
												<?php $cnt=$cnt+1; }} ?>
											</tbody>
										</table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php } ?>
<?php include('utile/footer.php') ?>