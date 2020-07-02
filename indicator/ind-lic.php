<?php
$pageTitle = 'indicator.ro | Indicator lichiditate curenta';
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

$sql = "SELECT * from ind_lic WHERE id_companie = ($result->id_companie) ";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
mysqli_close($dbh);

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Lichiditate </h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
					Lichiditate 
					<div class="actions"><a href="form-ind-lic.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Lichiditatea generală este o expresie a echilibrului financiar pe termen scurt și reflectă capacitatea activelor curente disponibile de a se transforma în disponibilități bănești care să acopere datoriile scadente pe termen scurt. Valoarea minimă admisă variază între 1,2 – 1,8, variație influențată de sectorul de activitate. O valoare mai ridicată decât cele specificate anterior, permite entității achitarea obligațiilor curente, pe măsură ce acestea devin scadente. </h5>
				<h5 class="sub-title">Lichiditatea curentă reflectă capacitatea activelor circulante ale societății, concretizate în creanțe și trezorerie de a-și onora datoriile exigibile pe termen scurt. Valorile de referință ale lichidității curente sunt cuprinse între 0,8 și 1, nivel asiguratoriu, certificând faptul că societatea este capabilă să-și acopere datoriile pe termen scurt. </h5>
				<h5 class="sub-title">Lichiditatea imediată reflectă capacitatea societății de a-și onora obligațiile pe termen scurt pe baza disponibilităților bănești și a investițiilor financiare pe termen scurt. Se consideră că nivelul normal al lichidității imediate variază între 0,2 și 0,3. </h5>
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
									$.post("data-ind-lic.php",
									function (data)
									{
										console.log(data);
										var lichiditate_generala = [];
										var lichiditate_curenta = [];
										var lichiditate_imediata = [];
										var an = [];

										for (var i in data) {
											lichiditate_generala.push(data[i].lichiditate_generala);
											lichiditate_curenta.push(data[i].lichiditate_curenta);
											lichiditate_imediata.push(data[i].lichiditate_imediata);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Lichiditate generală',
													backgroundColor: 'rgb(126, 188, 137)',
													borderWidth: 3,
													borderColor: 'rgb(126, 188, 137)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: lichiditate_generala,
													fill: false,
													
												},
												{
													label: 'Lichiditate curentă',
													backgroundColor: 'rgb(72, 86, 150)',
													borderWidth: 3,
													borderColor: 'rgb(72, 86, 150)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: lichiditate_curenta,
													fill: false,
													
												},
												{
													label: 'Lichiditate imediată',
													backgroundColor: 'rgb(8, 178, 227)',
													borderWidth: 3,
													borderColor: 'rgb(8, 178, 227)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: lichiditate_imediata,
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
																ticks: {
																	// the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
																	suggestedMin: 10,

																	// the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
																	suggestedMax: 10
																},
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
									<tr><th>Active curente (lei)</th></tr>
									<tr><th>Stocuri (lei)</th></tr>
									<tr><th>Investiții pe termen scurt (lei)</th></tr>
									<tr><th>Disponibilități (lei)</th></tr>
									<tr><th>Datorii curente (lei)</th></tr>
									<tr><th>Lichiditate generală</th></tr>
									<tr><th>Lichiditate curentă</th></tr>
									<tr><th>Lichiditate imediată</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->active_curente);?></td></tr>
										<tr><td><?php echo number_format($result->stocuri);?></td></tr>
										<tr><td><?php echo number_format($result->invest_scurt);?></td></tr>
										<tr><td><?php echo number_format($result->disponibilitati);?></td></tr>
										<tr><td><?php echo number_format($result->datorii_curente);?></td></tr>
										<?php 
										if ($result->lichiditate_generala >= 2 ) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->lichiditate_generala, 2);
											echo "</td></tr>";
										} elseif ($result->lichiditate_generala >= 1.2 and $result->lichiditate_generala <= 1.8 ) {
											echo "<tr><td class=\"yellow\">";
											echo number_format($result->lichiditate_generala, 2);
											echo "</td></tr>";
										} else {
											echo "<tr><td class=\"red\">";
											echo number_format($result->lichiditate_curenta, 2);
											echo "</td></tr>";
										}
										?>
										<?php 
										if ($result->lichiditate_curenta >= 0.8) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->lichiditate_curenta, 2);
											echo "</td></tr>";
										} else {
											echo "<tr><td class=\"red\">";
											echo number_format($result->lichiditate_curenta, 2);
											echo "</td></tr>";
										}
										?>
										<?php 
										if ($result->lichiditate_imediata >= 0.2) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->lichiditate_imediata, 2);
											echo "</td></tr>";
										} else {
											echo "<tr><td class=\"red\">";
											echo number_format($result->lichiditate_imediata, 2);
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
