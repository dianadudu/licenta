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

 ?>
	<?php include('utile/bara-sus.php');?>

	<div class="ts-main-content">
		<?php include('utile/meniu.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Utilizatori șterși</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading"></div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover table-padding" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th>#</th>
												<th>Email</th>
												<th>Data</th>
										</tr>
									</thead>
									
									<tbody>

<?php $sql = "SELECT * from  utilizatori_stersi";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->email);?></td>
											<td><?php echo htmlentities($result->deltime);?></td>
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
<?php } ?>
<?php include('utile/footer.php') ?>