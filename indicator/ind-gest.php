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
$sql = "SELECT * from ind_gest WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Analiza indicatorilor de gestiune</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Analiza indicatorilor de gestiune
					<div class="actions"><a href="form-ind-gest.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Indicatorii ce caracterizează gestiunea măsoară viteza de transformare a activelor în lichidități, cât și cea de reînnoire a datoriilor. </h5>
				<h5 class="sub-title">Viteza de rotație a activelor circulante reprezintă un indicator de eficiență ce reflectă schimbările intervenite în activitatea firmei, mai exact în activitatea de exploatare. Cu cât viteza de rotație a activelor circulante este mai mare cu atât situația companiei este defavorizată. </h5>
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
									$.post("data-ind-gest.php",
									function (data)
									{
										console.log(data);
										var vrs = [];
										var vrc = [];
										var an = [];

										for (var i in data) {
											vrs.push(data[i].vrs);
											vrc.push(data[i].vrc);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Viteza de rotație a stocurilor',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: vrs,
													fill: false,
													
												},
												{
													label: 'Viteza de rotație a creanțelor',
													backgroundColor: 'rgb(126, 188, 137)',
													borderWidth: 3,
													borderColor: 'rgb(126, 188, 137)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: vrc,
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
									<tr><th>Cifra de afaceri (lei)</th></tr>
									<tr><th>Soldul mediu al activelor circulante (lei), din care: </th></tr>
									<tr><th>Stocuri (lei)</th></tr>
									<tr><th>Creanțe (lei)</th></tr>
									<tr><th>Viteza de rotație a activelor circulante, din care:</th></tr>
									<tr><th>Viteza de rotație a stocurilor</th></tr>
									<tr><th>Viteza de rotație a creanțelor</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->cifra_afaceri);?></td></tr>
										<tr><td><?php echo number_format($result->sold_mediu);?></td></tr>
										<tr><td><?php echo number_format($result->stocuri);?></td></tr>
										<tr><td><?php echo number_format($result->creante);?></td></tr>
										<tr><td><?php echo number_format($result->vr);?> zile</td></tr>
										<tr><td><?php echo number_format($result->vrs);?> zile</td></tr>
										<tr><td><?php echo number_format($result->vrc);?> zile</td></tr>
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
