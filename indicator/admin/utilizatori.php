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

if(isset($_GET['del']) && isset($_GET['nume']))
{
$id=$_GET['del'];
$nume=$_GET['nume'];

$sql = "delete from utilizatori WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$sql2 = "insert into utilizatori_stersi (email) values (:nume)";
$query2 = $dbh->prepare($sql2);
$query2 -> bindParam(':nume',$nume, PDO::PARAM_STR);
$query2 -> execute();

$msg="Utilizatorul a fost sters cu succes !";
}

if(isset($_REQUEST['confirm']))
	{
	$aeid=intval($_GET['confirm']);
	$memstatus=1;
	$sql = "UPDATE utilizatori SET stare=:stare WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':stare',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

	if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=0;
	$sql = "UPDATE utilizatori SET stare=:stare WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':stare',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}
 ?>
	<?php include('utile/bara-sus.php');?>

	<div class="ts-main-content">
		<?php include('utile/meniu.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

					<h3 class="page-title">Administrare Utilizatori</h3>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Lista utilizatori</div>
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
											<th>Actiuni</th>	
										</tr>
									</thead>
									
									<tbody>

										<?php $sql = "SELECT * from  utilizatori ";
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
                                            
                                            <?php if($result->stare == 1)
                                                    {?>
                                                    <a href="utilizatori.php?unconfirm=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Un-Confirm the Account')">Confirmat <i class="fa fa-check-circle"></i></a> 
                                                    <?php } else {?>
                                                    <a href="utilizatori.php?confirm=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm the Account')">Neconfirmat <i class="fa fa-times-circle"></i></a>
                                                    <?php } ?>
</td>
                                            </td>
											
<td>
<a href="utilizatori.php?del=<?php echo $result->id;?>&nume=<?php echo htmlentities($result->email);?>"data-confirm="Are you sure you want to delete?"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
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

<?php } ?>
<?php include('utile/footer.php') ?>