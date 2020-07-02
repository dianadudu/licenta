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
$sql = "SELECT * from ind_rac WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Rata activelor circulante și a elementelor componente</h4>
			<h5 class="sub-title"> </h5>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Rata activelor circulante și a elementelor componente
					<div class="actions"><a href="form-ind-rac.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata activelor circulante reflectă ponderea activelor cu caracter temporar din total activ și caracterizează flexibilitatea financiară în măsura în care evidențiază importanța relativă a activelor ușor de transformat în bani.</h5>
			<h5 class="sub-title">Rata stocurilor reflectă ponderea activelor circulante cel mai puțin lichide în total active. Un nivel echilibrat al ratei ar fi de aproximativ 30% în ramurile industriale și de 40-45% în construcții și comerț. </h5>
			<h5 class="sub-title">Rata creanțelor măsoară ponderea creanțelor pe care le are entitatea în total activ. Valorile normale ale ratei creanțelor sunt cuprinse între 20 și 30% în cazul întreprinderilor industriale și între 10 și 15% în cazul unităților de construcții și de desfacere cu ridicata.</h5>
			<h5 class="sub-title">Rata investițiilor pe termen scurt reflectă ponderea investițiior pe termen scurt în total active.</h5>
			<h5 class="sub-title">Rata disponibilităților reflectă ponderea disponibilităților în total active și măsoară lichiditatea internă a întreprinderii. Un nivel ridicat înseamnă echilibru financiar consolidat.</h5>
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
									$.post("data-ind-rac.php",
									function (data)
									{
										console.log(data);
										var rac = [];
										var rst = [];
										var rcr = [];
										var rits = [];
										var rdisp = [];
										var an = [];

										for (var i in data) {
											rac.push(data[i].rac);
											rst.push(data[i].rst);
											rcr.push(data[i].rcr);
											rits.push(data[i].rits);
											rdisp.push(data[i].rdisp);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata activelor circulante',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rac,
													fill: false,
													
												},
												{
													label: 'Rata stocurilor',
													backgroundColor: 'rgb(76, 30, 79)',
													borderWidth: 3,
													borderColor: 'rgb(76, 30, 79)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rst,
													fill: false,
													
												},
												{
													label: 'Rata creanțelor',
													backgroundColor: 'rgb(126, 188, 137)',
													borderWidth: 3,
													borderColor: 'rgb(126, 188, 137)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rcr,
													fill: false,
													
												},
												{
													label: 'Rata investițiilor pe termen scurt',
													backgroundColor: 'rgb(72, 86, 150)',
													borderWidth: 3,
													borderColor: 'rgb(72, 86, 150)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rits,
													fill: false,
													
												},
												{
													label: 'Rata disponibilităților',
													backgroundColor: 'rgb(8, 178, 227)',
													borderWidth: 3,
													borderColor: 'rgb(8, 178, 227)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rdisp,
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
									<tr><th>Stocuri (lei)</th></tr>
									<tr><th>Creanțe (lei)</th></tr>
									<tr><th>Investiții pe termen scurt (lei)</th></tr>
									<tr><th>Disponibilități (lei)</th></tr>
									<tr><th>Active totale (lei)</th></tr>
									<tr><th>Rata activelor circulante (%)</th></tr>
									<tr><th>Rata stocurilor (%)</th></tr>
									<tr><th>Rata creanțelor (%)</th></tr>
									<tr><th>Rata investițiilor pe termen scurt (%)</th></tr>
									<tr><th>Rata disponibilităților (%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->stocuri);?></td></tr>
										<tr><td><?php echo number_format($result->creante);?></td></tr>
										<tr><td><?php echo number_format($result->investitii_tscurt);?></td></tr>
										<tr><td><?php echo number_format($result->disponibilitati);?></td></tr>
										<tr><td><?php echo number_format($result->active_totale);?></td></tr>
										<tr><td><?php echo number_format($result->rac, 2);?></td></tr>
										<tr><td><?php echo number_format($result->rst, 2);?></td></tr>
										<tr><td><?php echo number_format($result->rcr, 2);?></td></tr>
										<tr><td><?php echo number_format($result->rits, 2);?></td></tr>
										<tr><td><?php echo number_format($result->rdisp, 2);?></td></tr>
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
