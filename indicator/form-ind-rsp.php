<?php
$pageTitle = 'indicator.ro | Adaugă date';
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

if(isset($_POST['submit']))
  {	
	$id_companie=$_POST['id_companie'];
	$capital_propriu=$_POST['capital_propriu'];
	$credite_totale=$_POST['credite_totale'];
	$rsp=$_POST['rsp'];
	$an=$_POST['an'];


	$sql = $dbh->prepare('SELECT * FROM ind_rsp WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_rsp SET capital_propriu=:capital_propriu, credite_totale=:credite_totale, rsp=:rsp WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':capital_propriu', $capital_propriu, PDO::PARAM_STR);
		$query-> bindParam(':credite_totale', $credite_totale, PDO::PARAM_STR);
		$query-> bindParam(':rsp', $rsp, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_rsp (id_companie,capital_propriu,credite_totale,rsp,an) VALUES (:id_companie,:capital_propriu,:credite_totale,:rsp,:an)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':capital_propriu', $capital_propriu, PDO::PARAM_STR);
		$query-> bindParam(':credite_totale', $credite_totale, PDO::PARAM_STR);
		$query-> bindParam(':rsp', $rsp, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost introduse cu succes !";
	}
  }
 ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<h4 class="page-title">Rata rentabilității financiare globale</h4>
					<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Rata rentabilității financiare globale
							<div class="actions"><a href="ind-rsp.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
							<?php if(isset($msg)){?><div class="succWrap"><?php echo htmlentities($msg); ?> </div><?php }?>
							<div class="panel-body">
								<form method="post" class="form-horizontal" enctype="multipart/form-data">
								<div class="col-md-2">
									<label class="text-uppercase text-sm">Anul</label>
									<select class="form-control mb" name="an" required>
										<option value="">An</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
									</select>
									</div>
									<div class="col-md-4">
									<input type="hidden" name="id_companie" class="form-control mb" required value="<?php echo htmlentities($result->id_companie);?>">
										<label class="text-uppercase text-sm">Capital propriu (lei)</label>
										<input type="text" id="capital_propriu" name="capital_propriu" class="form-control mb" required>
									</div>
									<div class="col-md-4">
										<label class="text-uppercase text-sm">Credite totale (lei)</label>
										<input type="text" id="credite_totale" name="credite_totale" class="form-control mb" required>
									</div>
									<div class="col-md-2">
									<input type="hidden" id="rsp" name="rsp" class="form-control">
										<button class="btn btn-primary mt" name="submit" type="submit" onclick="doMath();">Trimite</button>
									</div>

							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					function doMath()
					{


						// Capture the entered values of two input boxes
						var capital_propriu = document.getElementById('capital_propriu').value;
						var credite_totale = document.getElementById('credite_totale').value;
						// Add them together and display
						var rsp = parseInt(capital_propriu) / (parseInt(capital_propriu) + parseInt(credite_totale));

						document.getElementById('rsp').value = rsp;
					}
				</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>