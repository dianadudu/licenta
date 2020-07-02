<?php
$pageTitle = 'indicator.ro | Rata solvabilității generale';
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

$sql = "SELECT * from ind_rsg WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
						
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Rata solvabilității generale</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Rata solvabilității generale
					<div class="actions"><a href="form-ind-rsg.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata solvabilității generale indică măsura în care activele totale ale firmei pot acoperi datoriile totale ale acesteia. Valoarea critică a indicatorului este de 1,5. O valoare mai mare decât 1,5 a indicatorului evidențiază faptul că firma are capacitatea de a achita obligațiile bănești față de terți. În cazul unei valori situate sub 1,5 a indicatorului, este evidențiat riscul de insolvabilitate pe care și l-au asumat furnizorii sau creditorii de fonduri puse la dispoziția întreprinderii. </h5>
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
									$.post("data-ind-rsg.php",
									function (data)
									{
										console.log(data);
										var rsg = [];
										var an = [];

										for (var i in data) {
											rsg.push(data[i].rsg);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata solvabilității generale',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rsg,
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
									<tr><th>Total activ (lei)</th></tr>
									<tr><th>Datorii totale (lei)</th></tr>
									<tr><th>Rata solvabilității generale(%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->total_activ);?></td></tr>
										<tr><td><?php echo number_format($result->datorii_totale);?></td></tr>
										<?php 
										if ($result->rsg >= 1.5 ) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->rsg, 2);
											echo "</td></tr>";
										} else {
											echo "<tr><td class=\"red\">";
											echo number_format($result->rsg, 2);
											echo "</td></tr>";
										}
										?>
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
