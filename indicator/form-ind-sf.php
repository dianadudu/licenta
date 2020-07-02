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
	$datorii_tlung=$_POST['datorii_tlung'];
	$capital_propriu=$_POST['capital_propriu'];
	$datorii_totale=$_POST['datorii_totale'];
	$pasiv_total=$_POST['pasiv_total'];
	$rsf=$_POST['rsf'];
	$rag=$_POST['rag'];
	$ri=$_POST['ri'];
	$an=$_POST['an'];

	$sql = $dbh->prepare('SELECT * FROM ind_sf WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_sf SET datorii_tlung=:datorii_tlung, capital_propriu=:capital_propriu, datorii_totale=:datorii_totale, pasiv_total=:pasiv_total, rsf=:rsf, rag=:rag, ri=:ri WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':datorii_tlung', $datorii_tlung, PDO::PARAM_STR);
		$query-> bindParam(':capital_propriu', $capital_propriu, PDO::PARAM_STR);
		$query-> bindParam(':datorii_totale', $datorii_totale, PDO::PARAM_STR);
		$query-> bindParam(':pasiv_total', $pasiv_total, PDO::PARAM_STR);
		$query-> bindParam(':rsf', $rsf, PDO::PARAM_STR);
		$query-> bindParam(':rag', $rag, PDO::PARAM_STR);
		$query-> bindParam(':ri', $ri, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_sf (id_companie,datorii_tlung,capital_propriu,datorii_totale,pasiv_total,rsf,rag,ri,an) VALUES (:id_companie,:datorii_tlung,:capital_propriu,:datorii_totale,:pasiv_total,:rsf,:rag,:ri,:an)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':datorii_tlung', $datorii_tlung, PDO::PARAM_STR);
		$query-> bindParam(':capital_propriu', $capital_propriu, PDO::PARAM_STR);
		$query-> bindParam(':datorii_totale', $datorii_totale, PDO::PARAM_STR);
		$query-> bindParam(':pasiv_total', $pasiv_total, PDO::PARAM_STR);
		$query-> bindParam(':rsf', $rsf, PDO::PARAM_STR);
		$query-> bindParam(':rag', $rag, PDO::PARAM_STR);
		$query-> bindParam(':ri', $ri, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost introduse cu succes !";
	}
  }
 ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<h4 class="page-title">Analiza structurii surselor de finanțare</h4>
					<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Analiza structurii surselor de finanțare
							<div class="actions"><a href="ind-sf.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
							
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
									<div class="col-md-2">
									<input type="hidden" name="id_companie" class="form-control mb" required value="<?php echo htmlentities($result->id_companie);?>">
										<label class="text-uppercase text-sm">Datorii pe termen lung (lei)</label>
										<input type="text" id="datorii_tlung" name="datorii_tlung" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Capital propriu (lei)</label>
										<input type="text" id="capital_propriu" name="capital_propriu" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Datorii totale (lei)</label>
										<input type="text" id="datorii_totale" name="datorii_totale" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Pasiv total (lei)</label>
										<input type="text" id="pasiv_total" name="pasiv_total" class="form-control mb" required>
									</div>
									<div class="col-md-2">
									<input type="hidden" id="rsf" name="rsf" class="form-control">
									<input type="hidden" id="rag" name="rag" class="form-control">
									<input type="hidden" id="ri" name="ri" class="form-control">
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
						var datorii_tlung = document.getElementById('datorii_tlung').value;
						var capital_propriu = document.getElementById('capital_propriu').value;
						var datorii_totale = document.getElementById('datorii_totale').value;
						var pasiv_total = document.getElementById('pasiv_total').value;
						// Add them together and display
						var rsf = (parseInt(datorii_tlung) + parseInt(capital_propriu)) / parseInt(pasiv_total) * 100;
						var rag = (parseInt(capital_propriu) / parseInt(pasiv_total)) * 100;
						var ri = (parseInt(datorii_totale) / parseInt(pasiv_total)) * 100;
						document.getElementById('rsf').value = rsf;
						document.getElementById('rag').value = rag;
						document.getElementById('ri').value = ri;
					}
				</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>