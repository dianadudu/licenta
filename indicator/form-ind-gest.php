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
	$cifra_afaceri=$_POST['cifra_afaceri'];
	$sold_mediu=$_POST['sold_mediu'];
	$stocuri=$_POST['stocuri'];
	$creante=$_POST['creante'];
	$vr=$_POST['vr'];
	$vrs=$_POST['vrs'];
	$vrc=$_POST['vrc'];
	$an=$_POST['an'];

	$sql = $dbh->prepare('SELECT * FROM ind_gest WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_gest SET cifra_afaceri=:cifra_afaceri, sold_mediu=:sold_mediu, stocuri=:stocuri, creante=:creante, vr=:vr, vrs=:vrs, vrc=:vrc WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':cifra_afaceri', $cifra_afaceri, PDO::PARAM_STR);
		$query-> bindParam(':sold_mediu', $sold_mediu, PDO::PARAM_STR);
		$query-> bindParam(':stocuri', $stocuri, PDO::PARAM_STR);
		$query-> bindParam(':creante', $creante, PDO::PARAM_STR);
		$query-> bindParam(':vr', $vr, PDO::PARAM_STR);
		$query-> bindParam(':vrs', $vrs, PDO::PARAM_STR);
		$query-> bindParam(':vrc', $vrc, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_gest (id_companie,cifra_afaceri,sold_mediu,stocuri,creante,vr,vrs,vrc,an) VALUES (:id_companie,:cifra_afaceri,:sold_mediu,:stocuri,:creante,:vr,:vrs,:vrc,:an)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':cifra_afaceri', $cifra_afaceri, PDO::PARAM_STR);
		$query-> bindParam(':sold_mediu', $sold_mediu, PDO::PARAM_STR);
		$query-> bindParam(':stocuri', $stocuri, PDO::PARAM_STR);
		$query-> bindParam(':creante', $creante, PDO::PARAM_STR);
		$query-> bindParam(':vr', $vr, PDO::PARAM_STR);
		$query-> bindParam(':vrs', $vrs, PDO::PARAM_STR);
		$query-> bindParam(':vrc', $vrc, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost introduse cu succes !";
	}
  }
 ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<h4 class="page-title">Analiza indicatorilor de gestiune</h4>
					<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Analiza indicatorilor de gestiune
							<div class="actions"><a href="ind-gest.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
							
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
										<label class="text-uppercase text-sm">Cifra de afaceri (lei)</label>
										<input type="text" id="cifra_afaceri" name="cifra_afaceri" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Stocuri (lei)</label>
										<input type="text" id="stocuri" name="stocuri" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Creanțe (lei)</label>
										<input type="text" id="creante" name="creante" class="form-control mb" required>
									</div>
									<div class="col-md-2">
									<input type="hidden" id="sold_mediu" name="sold_mediu" class="form-control">
									<input type="hidden" id="vr" name="vr" class="form-control">
									<input type="hidden" id="vrs" name="vrs" class="form-control">
									<input type="hidden" id="vrc" name="vrc" class="form-control">
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
						var cifra_afaceri = document.getElementById('cifra_afaceri').value;
						var stocuri = document.getElementById('stocuri').value;
						var creante = document.getElementById('creante').value;
						// Add them together and display
						var sold_mediu = parseInt(stocuri) + parseInt(creante);
						var vrs = (parseInt(stocuri) / parseInt(cifra_afaceri)) * 365;
						var vrc = (parseInt(creante) / parseInt(cifra_afaceri)) * 365;
						var vr = Number(vrs) + Number(vrc);
						document.getElementById('sold_mediu').value = sold_mediu;
						document.getElementById('vrs').value = vrs;
						document.getElementById('vrc').value = vrc;
						document.getElementById('vr').value = vr;
					}
				</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>