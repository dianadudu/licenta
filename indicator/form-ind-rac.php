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
	$an=$_POST['an'];
	$active_circulante=$_POST['active_circulante'];
	$stocuri=$_POST['stocuri'];
	$creante=$_POST['creante'];
	$investitii_tscurt=$_POST['investitii_tscurt'];
	$disponibilitati=$_POST['disponibilitati'];
	$active_totale=$_POST['active_totale'];
	$rac=$_POST['rac'];
	$rst=$_POST['rst'];
	$rcr=$_POST['rcr'];
	$rits=$_POST['rits'];
	$rdisp=$_POST['rdisp'];

	$sql = $dbh->prepare('SELECT * FROM ind_rac WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_rac SET active_circulante=:active_circulante, stocuri=:stocuri, creante=:creante, investitii_tscurt=:investitii_tscurt,disponibilitati=:disponibilitati,active_totale=:active_totale,rac=:rac,rst=:rst,rcr=:rcr,rits=:rits,rdisp=:rdisp WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query-> bindParam(':active_circulante', $active_circulante, PDO::PARAM_STR);
		$query-> bindParam(':stocuri', $stocuri, PDO::PARAM_STR);
		$query-> bindParam(':creante', $creante, PDO::PARAM_STR);
		$query-> bindParam(':investitii_tscurt', $investitii_tscurt, PDO::PARAM_STR);
		$query-> bindParam(':disponibilitati', $disponibilitati, PDO::PARAM_STR);
		$query-> bindParam(':active_totale', $active_totale, PDO::PARAM_STR);
		$query-> bindParam(':rac', $rac, PDO::PARAM_STR);
		$query-> bindParam(':rst', $rst, PDO::PARAM_STR);
		$query-> bindParam(':rcr', $rcr, PDO::PARAM_STR);
		$query-> bindParam(':rits', $rits, PDO::PARAM_STR);
		$query-> bindParam(':rdisp', $rdisp, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_rac (id_companie,an,active_circulante,stocuri,creante,investitii_tscurt,disponibilitati,active_totale,rac,rst,rcr,rits,rdisp) VALUES (:id_companie,:an,:active_circulante,:stocuri,:creante,:investitii_tscurt,:disponibilitati,:active_totale,:rac,:rst,:rcr,:rits,:rdisp)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query-> bindParam(':active_circulante', $active_circulante, PDO::PARAM_STR);
		$query-> bindParam(':stocuri', $stocuri, PDO::PARAM_STR);
		$query-> bindParam(':creante', $creante, PDO::PARAM_STR);
		$query-> bindParam(':investitii_tscurt', $investitii_tscurt, PDO::PARAM_STR);
		$query-> bindParam(':disponibilitati', $disponibilitati, PDO::PARAM_STR);
		$query-> bindParam(':active_totale', $active_totale, PDO::PARAM_STR);
		$query-> bindParam(':rac', $rac, PDO::PARAM_STR);
		$query-> bindParam(':rst', $rst, PDO::PARAM_STR);
		$query-> bindParam(':rcr', $rcr, PDO::PARAM_STR);
		$query-> bindParam(':rits', $rits, PDO::PARAM_STR);
		$query-> bindParam(':rdisp', $rdisp, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost introduse cu succes !";
	}
  }
 ?>

<?php
		$email = $_SESSION['alogin'];
		$sql = "SELECT * from utilizatori where email = (:email);";
		$query = $dbh -> prepare($sql);
		$query-> bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<h4 class="page-title">Rata activelor circulante</h4>
					<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Rata activelor circulante
							<div class="actions"><a href="ind-rac.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
							<?php if(isset($msg)){?><div class="succWrap"><?php echo htmlentities($msg); ?> </div><?php }?>
							<div class="panel-body">
								<form method="post" class="form-horizontal" enctype="multipart/form-data">
								<div class="col-md-1">
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
										<label class="text-uppercase text-sm">Active circulante (lei)</label>
										<input type="text" id="active_circulante" name="active_circulante" class="form-control mb" required>
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
										<label class="text-uppercase text-sm">Investiții pe termen scurt (lei)</label>
										<input type="text" id="investitii_tscurt" name="investitii_tscurt" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Disponibilități (lei)</label>
										<input type="text" id="disponibilitati" name="disponibilitati" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Active totale (lei)</label>
										<input type="text" id="active_totale" name="active_totale" class="form-control mb" required>
									</div>
									<div class="col-md-1">
									<input type="hidden" id="rac" name="rac" class="form-control">
									<input type="hidden" id="rst" name="rst" class="form-control">
									<input type="hidden" id="rcr" name="rcr" class="form-control">
									<input type="hidden" id="rdisp" name="rdisp" class="form-control">
									<input type="hidden" id="rits" name="rits" class="form-control">
										<button class="btn btn-primary mt" name="submit" type="submit" onclick="doMath();">Trimite</button>
									</div>

							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					function doMath()
					{
						var active_circulante = document.getElementById('active_circulante').value;
						var stocuri = document.getElementById('stocuri').value;
						var creante = document.getElementById('creante').value;
						var investitii_tscurt = document.getElementById('investitii_tscurt').value;
						var disponibilitati = document.getElementById('disponibilitati').value;
						var active_totale = document.getElementById('active_totale').value;
						var rac = (parseInt(active_circulante) / parseInt(active_totale)) * 100;
						var rst = (parseInt(stocuri) / parseInt(active_totale)) * 100;
						var rcr = (parseInt(creante) / parseInt(active_totale)) * 100;
						var rits = (parseInt(investitii_tscurt) / parseInt(active_totale)) * 100;
						var rdisp = (parseInt(disponibilitati) / parseInt(active_totale)) * 100;
						document.getElementById('rac').value = rac;
						document.getElementById('rst').value = rst;
						document.getElementById('rcr').value = rcr;
						document.getElementById('rits').value = rits;
						document.getElementById('rdisp').value = rdisp;
					}
				</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>