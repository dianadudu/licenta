<?php
$pageTitle = 'indicator.ro | Rata rentabilității comerciale';
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
$sql = "SELECT * from ind_rcn WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Rata rentabilității comerciale</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Rata rentabilității comerciale
					<div class="actions"><a href="form-ind-rcn.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata rentabilității comerciale comensurează eficiența activității comerciale. În acest fel, rata de rentabilitate face legătura dintre profit și cifra de afaceri, așadar, cu cât profitul este mai mare, cu atât activitatea societății este mai eficientă. </h5>
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
									$.post("data-ind-rcn.php",
									function (data)
									{
										console.log(data);
										var rcn = [];
										var an = [];

										for (var i in data) {
											rcn.push(data[i].rcn);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata rentabilității comerciale',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rcn,
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
									<tr><th>Profit net (lei)</th></tr>
									<tr><th>Cifra de afaceri (lei)</th></tr>
									<tr><th>Rata rentabilității comerciale (%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->profit_net);?></td></tr>
										<tr><td><?php echo number_format($result->cifra_afaceri);?></td></tr>
										<tr><td><?php echo number_format($result->rcn, 2);?></td></tr>
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
