<?php
$pageTitle = 'indicator.ro | Rata solvabilității patrimoniale';
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

$sql = "SELECT * from ind_rsp WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Rata solvabilității patrimoniale</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Rata solvabilității patrimoniale
					<div class="actions"><a href="form-ind-rsp.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata solvabilității patrimoniale este calculată, de cele mai multe ori, de bănci, în studiile de bonitate efectuate în cazul solicitării de credite. Valoarea critică a acestei ratei trebuie să se încadreze în limitele 0,3 – 0,5, pentru a nu fi apreciată de către finanțatori ca fiind riscantă. </h5>
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
									$.post("data-ind-rsp.php",
									function (data)
									{
										console.log(data);
										var rsp = [];
										var an = [];

										for (var i in data) {
											rsp.push(data[i].rsp);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata solvabilității patrimoniale',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rsp,
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
									<tr><th>Capital propriu (lei)</th></tr>
									<tr><th>Credite totale (lei)</th></tr>
									<tr><th>Rata solvabilității patrimoniale (%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->capital_propriu);?></td></tr>
										<tr><td><?php echo number_format($result->credite_totale);?></td></tr>
										<?php 
										if ($result->rsp >= 0.30 ) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->rsp, 2);
											echo "</td></tr>";
										} else {
											echo "<tr><td class=\"red\">";
											echo number_format($result->rsp, 2);
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
