<?php
$pageTitle = 'indicator.ro | Rata rentabilității economice';
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
$sql = "SELECT * from ind_roa WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Rata rentabilității economice</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Rata rentabilității economice
					<div class="actions"><a href="form-ind-roa.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata rentabilității economice exprimă eficiența utilizării activelor, respectiv contribuția acestora la obținerea rezultatelor. </h5>
					<?php if($query->rowCount() > 0) { ?>
					<div id="chart-container">
						<canvas id="graphCanvas"></canvas>
					</div>
						<script>
							$(document).ready(function () {
								showGraph();
							});

							function showGraph() {
								{
									$.post("data-ind-roa.php",
									function (data)
									{
										console.log(data);
										var roa = [];
										var an = [];

										for (var i in data) {
											roa.push(data[i].roa);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata rentabilității economice',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: roa,
													fill: false,
													
												}
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
							<table id="zctb a" class="ind-table display table table-striped table-bordered table-hover">
							<tbody>
							<tr>
								<td>

									<table class="display table table-striped table-hover">
									<tr><th>An</th></tr>
									<tr><th>Profit brut (lei)</th></tr>
									<tr><th>Active totale (lei)</th></tr>
									<tr><th>Rata rentabilității economice (%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->profit_brut);?></td></tr>
										<tr><td><?php echo number_format($result->active_totale);?></td></tr>
										<tr><td><?php echo number_format($result->roa, 2);?></td></tr>
								</table>
								</td>
								<?php } ?>
							</tr>
						</tbody>
					</table>
				<?php } else { ?>
					<p class="no-data"><i class="fa fa-info-circle"></i>Nu există date pentru generarea indicatorului. Folosiți butonul <strong>Adaugă date</strong> și introduceți datele din situațiile financiare anuale ale companiei dumneavoastră.</p>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</body>
</html>
<?php } ?>
