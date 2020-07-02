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

if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from utilizatori WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Utilizatorul a fost sters cu succes !";
}

if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=1;
	$sql = "UPDATE utilizatori SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

	if(isset($_REQUEST['confirm']))
	{
	$aeid=intval($_GET['confirm']);
	$memstatus=0;
	$sql = "UPDATE utilizatori SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
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

						<h2 class="page-title">Sugestii</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading"></div>
							<div class="panel-body">
							<div id="chart-container">
						<canvas id="graphCanvas"></canvas>
					</div>
						<script>
							$(document).ready(function () {
								showGraph();
							});

							function showGraph() {
								{
									$.post("data-sugestii.php",
									function (data)
									{
										console.log(data);
										var pozitiv = [];
										var negativ = [];

										for (var i in data) {
											pozitiv.push(data[i].pozitiv);
											negativ.push(data[i].negativ);
										}

										var chartdata = {
											datasets: [
												{
													label: 'Pozitiv',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: pozitiv,
													fill: false,
													
												},
												{
													label: 'Negativ',
													backgroundColor: 'rgb(76, 30, 79)',
													borderWidth: 3,
													borderColor: 'rgb(76, 30, 79)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: negativ,
													fill: false,
													
												},
											]
										};

										var graphTarget = $("#graphCanvas");

										var barGraph = new Chart(graphTarget, {
											type: 'line',
											data: chartdata,
											options: {
														responsive: true,
														legend: {
															position: 'top',
														},
														tooltips: {
															mode: 'index',
															intersect: false,
														},
														hover: {
															mode: 'nearest',
															intersect: true
														},
														scales: {
															yAxes: [{
																
																type: 'linear',
																display: true,
																position: 'left',
																id: 'y-axis-1',
																}],
															}
														}
										});
									});
								}
							}
							</script>
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover table-padding" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Utilizator</th>
											<th>Tip</th>
											<th>Titlu</th>
											<th>Sugestie</th>
											<th>Actiune</th>	
										</tr>
									</thead>
									
									<tbody>

<?php 
$destinatar = 'Admin';
$sql = "SELECT * from sugestii where destinatar = (:destinatar)";
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
											<td><?php if ($result->tip_sugestie == "pozitiv") { echo '<i class="sugestie-icon pozitiv fa fa-thumbs-up"></li>'; } else { echo '<i class="sugestie-icon negativ fa fa-thumbs-down"></li>'; };?></td>
											<td><?php echo htmlentities($result->titlu);?></td>
                                            <td><?php echo htmlentities($result->descriere);?></td>
											
<td>
<a href="raspunde.php?reply=<?php echo $result->expeditor;?>">&nbsp; <i class="fa fa-mail-reply"></i></a>&nbsp;&nbsp;
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