<?php
// Initializare sesiune
session_start();
error_reporting(1);
require_once "../utile/config.php";
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	include('utile/header.php');
	if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=1;
	$sql = "UPDATE utilizatori SET stare=:stare WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':stare',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Schimbarea a fost salvata cu succes !";
	}
?>
<?php $title = "Indicator | Admin - Tablou de bord"; ?>


<?php include('utile/bara-sus.php');?>
<div class="ts-main-content">
<?php include('utile/meniu.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Tablou de bord</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
													<?php 
													$sql ="SELECT id_companie from utilizatori";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$bg=$query->rowCount();
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($bg);?></div>
													<div class="stat-panel-title text-uppercase">Utilizatori</div>
												</div>
											</div>
											<a href="utilizatori.php" class="block-anchor panel-footer text-center">Detalii <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
														<?php 
														$reciver = 'Admin';
														$sql1 ="SELECT id from sugestii where destinatar = (:destinatar)";
														$query1 = $dbh -> prepare($sql1);;
														$query1-> bindParam(':destinatar', $reciver, PDO::PARAM_STR);
														$query1->execute();
														$results1=$query1->fetchAll(PDO::FETCH_OBJ);
														$regbd=$query1->rowCount();
														?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($regbd);?></div>
													<div class="stat-panel-title text-uppercase">Sugestii</div>
												</div>
											</div>
											<a href="sugestii.php" class="block-anchor panel-footer text-center">Detalii &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-danger text-light">
												<div class="stat-panel text-center">
														<?php 
														$reciver = 'Admin';
														$sql12 ="SELECT * from notificari where destinatar = 'Admin'";
														$query12 = $dbh -> prepare($sql12);;
														$query12-> bindParam(':destinatar', $reciver, PDO::PARAM_STR);
														$query12->execute();
														$results12=$query12->fetchAll(PDO::FETCH_OBJ);
														$regbd2=$query12->rowCount();
														?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($regbd2);?></div>
													<div class="stat-panel-title text-uppercase">Notificări</div>
												</div>
											</div>
											<a href="notificari.php" class="block-anchor panel-footer text-center">Detalii &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
												<?php 
													$sql6 ="SELECT * from utilizatori_stersi";
													$query6 = $dbh -> prepare($sql6);;
													$query6->execute();
													$results6=$query6->fetchAll(PDO::FETCH_OBJ);
													$query=$query6->rowCount();
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($query);?></div>
													<div class="stat-panel-title text-uppercase">Conturi șterse</div>
												</div>
											</div>
											<a href="sterge-utilizator.php" class="block-anchor panel-footer text-center">Detalii &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
							
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Utilizatori Neconfirmati</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover table-padding" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Companie</th>
												<th>C.I.F.</th>
												<th>Nr.Reg.Com.</th>
                                                <th>Nume</th>
                                                <th>Email</th>
                                                <th>Telefon</th>
                                                <th>Cont</th>
											<th>Acțiuni</th>	
										</tr>
									</thead>
									
									<tbody>

										<?php $sql = "SELECT * from  utilizatori WHERE stare = 0";
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
											<td><?php echo htmlentities($result->companie);?></td>
											<td><?php echo htmlentities($result->cif);?></td>
											<td><?php echo htmlentities($result->nrregcom);?></td>
											<td><?php echo htmlentities($result->nume);?></td>
                                            <td><?php echo htmlentities($result->email);?></td>
											<td><?php echo htmlentities($result->telefon);?></td>
											<td>
                                            
                                            <?php if($result->stare == 0)
                                                    {?>
                                                   
                                                    <a href="tablou-bord.php?unconfirm=<?php echo htmlentities($result->id);?>" onclick="return confirm('Sigur doriți să confirmația acest cont?')">Confirmă <i class="fa fa-check"></i></a>
                                                    <?php } ?>
</td>
                                            </td>
											
<td>
<a href="utilizatori.php?del=<?php echo $result->id;?>&nume=<?php echo htmlentities($result->email);?>" onclick="return confirm('Sigur doriți să ștergeți ?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
</td>
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
	<?php } ?>
<?php include('utile/footer.php') ?>