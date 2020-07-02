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
	$profit_net=$_POST['profit_net'];
	$cifra_afaceri=$_POST['cifra_afaceri'];
	$rcn=$_POST['rcn'];
	$an=$_POST['an'];
	
	$sql = $dbh->prepare('SELECT * FROM ind_rcn WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_rcn SET profit_net=:profit_net, cifra_afaceri=:cifra_afaceri, rcn=:rcn WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':profit_net', $profit_net, PDO::PARAM_STR);
		$query-> bindParam(':cifra_afaceri', $cifra_afaceri, PDO::PARAM_STR);
		$query-> bindParam(':rcn', $rcn, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_rcn (id_companie,profit_net,cifra_afaceri,rcn,an) VALUES (:id_companie,:profit_net,:cifra_afaceri,:rcn,:an)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':profit_net', $profit_net, PDO::PARAM_STR);
		$query-> bindParam(':cifra_afaceri', $cifra_afaceri, PDO::PARAM_STR);
		$query-> bindParam(':rcn', $rcn, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost introduse cu succes !";
	}
  }
 ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<h4 class="page-title">Rata rentabilitatii comerciale</h4>
					<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Rata rentabilitatii comerciale
							<div class="actions"><a href="ind-rcn.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
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
										<label class="text-uppercase text-sm">Profit net (lei)</label>
										<input type="text" id="profit_net" name="profit_net" class="form-control mb" required>
									</div>
									<div class="col-md-4">
										<label class="text-uppercase text-sm">Cifra de afaceri (lei)</label>
										<input type="text" id="cifra_afaceri" name="cifra_afaceri" class="form-control mb" required>
									</div>
									<div class="col-md-2">
									<input type="hidden" id="rcn" name="rcn" class="form-control">
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
						var profit_net = document.getElementById('profit_net').value;
						var cifra_afaceri = document.getElementById('cifra_afaceri').value;
						// Add them together and display
						var rcn = (parseInt(profit_net) / parseInt(cifra_afaceri)) * 100;

						document.getElementById('rcn').value = rcn;
					}
				</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>