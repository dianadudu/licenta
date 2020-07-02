<?php
$pageTitle = 'indicator.ro | Rata activelor imobilizate';
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
$sql = "SELECT * from ind_rai WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Rata activelor imobilizate și a elementelor componente</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Rata activelor imobilizate și a elementelor componente
					<div class="actions"><a href="form-ind-rai.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata activelor imobilizate urmărește evoluția ponderii elementelor patrimoniale utilizate permanent în total activ, reflectând gradul de investire a capitalului în enitate. Este cunoscut faptul că nivelul normal al ratei activelor imobilizate diferă de la o societate la alta, în funcție de ramura sau sectorul de activitate din care face parte, dar cel mai frecvent nivel este situat în jurul valorii de 40-60%.</h5>
			<h5 class="sub-title">Rata imobilizărilor necorporale măsoară ponderea activelor intangibile în cadrul patrimoniului firmei. O rată înaltă a imobilizărilor necorporale înseamnă fie o activitate de cercetare-dezvoltare semnificativă, fie interesul pentru achiziția de astfel de imobilizări în scopul exploatării lor. </h5>
			<h5 class="sub-title">Rata imobilizărilor corporale reflectă ponderea imobilizărilor corporale în cadrul activelor totale ale entității. Aceasta înregistrează un nivel mai ridicat în cazul unităților cu un proces tehnologic complex, ce necesită o infrastructură importantă sau echipamente costisitoare, și un nivel mai scăzut în cazul societăților de comerț și prestări servicii</h5>
			<h5 class="sub-title">Rata imobilizărilor financiare evidențiază ponderea imobilizărilor financiare în total activ. Indicatorul evidențiază dimensiunea relațiilor strategice și financiare pe care o anumită firmă le are cu alte entități economice în vederea obținerii efectelor de sinergie sau susținere a creșterii externe </h5>
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
									$.post("data-ind-rai.php",
									function (data)
									{
										console.log(data);
										var rai = [];
										var rin = [];
										var ric = [];
										var rif = [];
										var an = [];

										for (var i in data) {
											rai.push(data[i].rai);
											rin.push(data[i].rin);
											ric.push(data[i].ric);
											rif.push(data[i].rif);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata activelor imobilizate',
													backgroundColor: 'rgb(255, 159, 64)',
													borderWidth: 3,
													borderColor: 'rgb(255, 159, 64)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rai,
													fill: false,
													
												},
												{
													label: 'Rata imobilizarilor necorporale',
													backgroundColor: 'rgb(255, 99, 132)',
													borderWidth: 3,
													borderColor: 'rgb(255, 99, 132)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rin,
													fill: false,
													
												},
												{
													label: 'Rata imobilizarilor corporale',
													backgroundColor: 'rgb(54, 162, 235)',
													borderWidth: 3,
													borderColor: 'rgb(54, 162, 235)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: ric,
													fill: false,
													
												},
												{
													label: 'Rata imobilizarilor financiare',
													backgroundColor: 'rgb(75, 192, 192)',
													borderWidth: 3,
													borderColor: 'rgb(75, 192, 192)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rif,
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
									<tr><th>Active imobilizate (lei)</th></tr>
									<tr><th>Imobilizari necorporale (lei)</th></tr>
									<tr><th>Imobilizari corporale (lei)</th></tr>
									<tr><th>Imobilizari financiare (lei)</th></tr>
									<tr><th>Active totale (lei)</th></tr>
									<tr><th>Rata activelor imobilizate (%)</th></tr>
									<tr><th>Rata imobilizarilor necorporale (%)</th></tr>
									<tr><th>Rata imobilizarilor corporale (%)</th></tr>
									<tr><th>Rata imobilizarilor financiare (%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->active_imobilizate);?></td></tr>
										<tr><td><?php echo number_format($result->imobilizari_necorporale);?></td></tr>
										<tr><td><?php echo number_format($result->imobilizari_corporale);?></td></tr>
										<tr><td><?php echo number_format($result->imobilizari_financiare);?></td></tr>
										<tr><td><?php echo number_format($result->active_totale);?></td></tr>
										<?php 
										if ($result->rai >= 40 and $result->rai <= 60) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->rai, 2);
											echo "</td></tr>";
										} else {
											echo "<tr><td class=\"red\">";
											echo number_format($result->rai, 2);
											echo "</td></tr>";
										}
										?>
										<tr><td><?php echo number_format($result->rin, 2);?></td></tr>
										<tr><td><?php echo number_format($result->ric, 2);?></td></tr>
										<tr><td><?php echo number_format($result->rif, 2);?></td></tr>
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
