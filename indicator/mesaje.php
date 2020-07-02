<?php
$pageTitle = 'indicator.ro | Mesaje';
// Initializare sesiune
session_start();
error_reporting(0);
require_once "utile/config.php";
if(strlen($_SESSION['alogin'])==0)
	{	
	header('location:index.php');
	}
else{   
	include('utile/header.php');
?>

			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Mesaje</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th>#</th>
												<th>Utilizator</th>
												<th>Mesaj</th>
										</tr>
									</thead>
									
									<tbody>

											<?php 
											$destinatar = $_SESSION['alogin'];
											$sql = "SELECT * from  sugestii where destinatar = (:destinatar)";
											$query = $dbh -> prepare($sql);
											$query-> bindParam(':destinatar', $destinatar, PDO::PARAM_STR);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->expeditor);?></td>
											<td><?php echo htmlentities($result->descriere);?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php include('utile/footer.php'); ?>
<?php } ?>