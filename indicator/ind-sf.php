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
$sql = "SELECT * from ind_sf WHERE id_companie = ($result->id_companie) ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">Analiza structurii surselor de finanțare</h4>
			<!-- Zero Configuration Table -->
			<div class="panel panel-default">
				<div class="panel-heading">
				Analiza structurii surselor de finanțare
					<div class="actions"><a href="form-ind-sf.php">Adaugă date <i class="fa fa-plus"></i></a></div>
				</div>
				<div class="panel-body">
				<h5 class="sub-title">Rata stabilității financiare reflectă ponderea surselor pe care le are compania pentru o perioadă mai mare de un an, în totalul surselor de acoperire a activelor economice. Valoarea minimă care oferă o stabilitate acceptabilă este de 50%, deși se consideră normală daca oscilează în jurul valorii de 66%. </h5>
				<h5 class="sub-title">Rata autonomiei globale evidențiază cât din patrimoniul întreprinderii este finanțat pe seama resurselor proprii. Nivelul optim al acestei rate înregistrează valori în jur de 66%, ceea ce reflectă autonomie financiară ridicată, prezentând garanții certe pentru eventualii creditori.</h5>
				<h5 class="sub-title">Rata îndatorării globale măsoară ponderea datoriilor totale față de terți, indiferent de natura lor, în totalul surselor de finanțare. O valoare situată în jurul a 66% este considerată normală pentru această rată. </h5>
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
									$.post("data-ind-sf.php",
									function (data)
									{
										console.log(data);
										var rsf = [];
										var rag = [];
										var ri = [];
										var an = [];

										for (var i in data) {
											rsf.push(data[i].rsf);
											rag.push(data[i].rag);
											ri.push(data[i].ri);
											an.push(data[i].an);
										}

										var chartdata = {
											labels: an,
											datasets: [
												{
													label: 'Rata stabilității financiare',
													backgroundColor: 'rgb(254, 93, 38)',
													borderWidth: 3,
													borderColor: 'rgb(254, 93, 38)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rsf,
													fill: false,
													
												},
												{
													label: 'Rata autonomiei globale',
													backgroundColor: 'rgb(126, 188, 137)',
													borderWidth: 3,
													borderColor: 'rgb(126, 188, 137)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: rag,
													fill: false,
													
												},
												{
													label: 'Rata de îndatorare globală',
													backgroundColor: 'rgb(72, 86, 150)',
													borderWidth: 3,
													borderColor: 'rgb(72, 86, 150)',
													hoverBackgroundColor: '#f0ce8a',
													hoverBorderColor: '#666666',
													data: ri,
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
									<tr><th>Datorii pe termen lung (lei)</th></tr>
									<tr><th>Capital propriu (lei)</th></tr>
									<tr><th>Datorii totale (lei)</th></tr>
									<tr><th>Pasiv total (lei)</th></tr>
									<tr><th>Rata stabilității financiare (%)</th></tr>
									<tr><th>Rata autonomiei globale (%)</th></tr>
									<tr><th>Rata de îndatorare globală (%)</th></tr>
									</table>
								</td>
								<?php 
									foreach($results as $result) {
								?>	
								<td>
									<table class="display table table-striped table-hover">
										<tr><th><?php echo $result->an;?></th></tr>
										<tr><td><?php echo number_format($result->datorii_tlung);?></td></tr>
										<tr><td><?php echo number_format($result->capital_propriu);?></td></tr>
										<tr><td><?php echo number_format($result->datorii_totale);?></td></tr>
										<tr><td><?php echo number_format($result->pasiv_total);?></td></tr>
										<?php 
										if ($result->rsf >= 60) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->rsf, 2);
											echo "</td></tr>";
										} elseif ($result->rsf >= 50 and $result->rsf <= 59){ 
											echo "<tr><td class=\"yellow\">";
											echo number_format($result->rsf, 2);
											echo "</td></tr>";
										} else { 
											echo "<tr><td class=\"red\">";
											echo number_format($result->rsf, 2);
											echo "</td></tr>";
										}
										?>
										<?php 
										if ($result->rag >= 60) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->rag, 2);
											echo "</td></tr>";
										} elseif ($result->rag >= 30 and $result->rag <= 50){ 
											echo "<tr><td class=\"yellow\">";
											echo number_format($result->rag, 2);
											echo "</td></tr>";
										} else { 
											echo "<tr><td class=\"red\">";
											echo number_format($result->rag, 2);
											echo "</td></tr>";
										}
										?>
										<?php 
										if ($result->ri >= 50 and $result->ri <= 66) {
											echo "<tr><td class=\"green\">";
											echo number_format($result->ri, 2);
											echo "</td></tr>";
										} else { 
											echo "<tr><td class=\"red\">";
											echo number_format($result->ri, 2);
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
