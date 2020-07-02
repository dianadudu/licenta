<?php
$pageTitle = 'indicator.ro | Adaugă date';
// Initializare sesiune
session_start();
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
	$active_imobilizate=$_POST['active_imobilizate'];
	$imobilizari_necorporale=$_POST['imobilizari_necorporale'];
	$imobilizari_corporale=$_POST['imobilizari_corporale'];
	$imobilizari_financiare=$_POST['imobilizari_financiare'];
	$active_totale=$_POST['active_totale'];
	$rai=$_POST['rai'];
	$rin=$_POST['rin'];
	$ric=$_POST['ric'];
	$rif=$_POST['rif'];
	$an=$_POST['an'];

	$sql = $dbh->prepare('SELECT * FROM ind_rai WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_rai SET active_imobilizate=:active_imobilizate, imobilizari_necorporale=:imobilizari_necorporale, imobilizari_corporale=:imobilizari_corporale, imobilizari_financiare=:imobilizari_financiare,active_totale=:active_totale,rai=:rai,rin=:rin,ric=:ric,rif=:rif WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':active_imobilizate', $active_imobilizate, PDO::PARAM_STR);
		$query-> bindParam(':imobilizari_necorporale', $imobilizari_necorporale, PDO::PARAM_STR);
		$query-> bindParam(':imobilizari_corporale', $imobilizari_corporale, PDO::PARAM_STR);
		$query-> bindParam(':imobilizari_financiare', $imobilizari_financiare, PDO::PARAM_STR);
		$query-> bindParam(':active_totale', $active_totale, PDO::PARAM_STR);
		$query-> bindParam(':rai', $rai, PDO::PARAM_STR);
		$query-> bindParam(':rin', $rin, PDO::PARAM_STR);
		$query-> bindParam(':ric', $ric, PDO::PARAM_STR);
		$query-> bindParam(':rif', $rif, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_rai (id_companie,active_imobilizate,imobilizari_necorporale,imobilizari_corporale,imobilizari_financiare,active_totale,rai,rin,ric,rif,an) VALUES (:id_companie,:active_imobilizate,:imobilizari_necorporale,:imobilizari_corporale,:imobilizari_financiare,:active_totale,:rai,:rin,:ric,:rif,:an)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':active_imobilizate', $active_imobilizate, PDO::PARAM_STR);
		$query-> bindParam(':imobilizari_necorporale', $imobilizari_necorporale, PDO::PARAM_STR);
		$query-> bindParam(':imobilizari_corporale', $imobilizari_corporale, PDO::PARAM_STR);
		$query-> bindParam(':imobilizari_financiare', $imobilizari_financiare, PDO::PARAM_STR);
		$query-> bindParam(':active_totale', $active_totale, PDO::PARAM_STR);
		$query-> bindParam(':rai', $rai, PDO::PARAM_STR);
		$query-> bindParam(':rin', $rin, PDO::PARAM_STR);
		$query-> bindParam(':ric', $ric, PDO::PARAM_STR);
		$query-> bindParam(':rif', $rif, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
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
					<h4 class="page-title">Rata activelor imobilizate</h4>
					<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Rata activelor imobilizate
							<div class="actions"><a href="ind-rai.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
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
										<label class="text-uppercase text-sm">Active imobilizate (lei)</label>
										<input type="text" id="active_imobilizate" name="active_imobilizate" class="form-control mb" required>
									</div>
									<div class="col-md-2">
									<input type="hidden" name="id_companie" class="form-control mb" required value="<?php echo htmlentities($result->id_companie);?>">
										<label class="text-uppercase text-sm">Imobilizari necorporale (lei)</label>
										<input type="text" id="imobilizari_necorporale" name="imobilizari_necorporale" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Imobilizari corporale (lei)</label>
										<input type="text" id="imobilizari_corporale" name="imobilizari_corporale" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Imobilizari financiare (lei)</label>
										<input type="text" id="imobilizari_financiare" name="imobilizari_financiare" class="form-control mb" required>
									</div>
									<div class="col-md-2">
										<label class="text-uppercase text-sm">Active totale (lei)</label>
										<input type="text" id="active_totale" name="active_totale" class="form-control mb" required>
									</div>
									<div class="col-md-1">
									<input type="hidden" id="rai" name="rai" class="form-control">
									<input type="hidden" id="rin" name="rin" class="form-control">
									<input type="hidden" id="ric" name="ric" class="form-control">
									<input type="hidden" id="rif" name="rif" class="form-control">
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
						var active_imobilizate = document.getElementById('active_imobilizate').value;
						var imobilizari_necorporale = document.getElementById('imobilizari_necorporale').value;
						var imobilizari_corporale = document.getElementById('imobilizari_corporale').value;
						var imobilizari_financiare = document.getElementById('imobilizari_financiare').value;
						var active_totale = document.getElementById('active_totale').value;
						// Add them together and display
						var rai = (parseInt(active_imobilizate) / parseInt(active_totale)) * 100;
						var rin = (parseInt(imobilizari_necorporale) / parseInt(active_totale)) * 100;
						var ric = (parseInt(imobilizari_corporale) / parseInt(active_totale)) * 100;
						var rif = (parseInt(imobilizari_financiare) / parseInt(active_totale)) * 100;
						document.getElementById('rai').value = rai;
						document.getElementById('rin').value = rin;
						document.getElementById('ric').value = ric;
						document.getElementById('rif').value = rif;
					}
				</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>