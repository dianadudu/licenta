<?php
$pageTitle = 'indicator.ro | Profil';
session_start();
error_reporting(0);

include('utile/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
		header('location: index.php');
	}
else{   
	include('utile/header.php');
	
if(isset($_POST['submit']))
  {	
	$companie=$_POST['companie'];
	$cif=$_POST['cif'];
	$nrregcom=$_POST['nrregcom'];
	$nume=$_POST['nume'];
	$email=$_POST['email'];
	$telefon=$_POST['telefon'];
	$idedit=$_POST['idedit'];

	$sql="UPDATE utilizatori SET nume=:nume, email=:email, telefon=:telefon, companie=:companie, cif=:cif, nrregcom=:nrregcom WHERE id=:idedit";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':companie', $companie, PDO::PARAM_STR);
	$query-> bindParam(':cif', $cif, PDO::PARAM_STR);
	$query-> bindParam(':nrregcom', $nrregcom, PDO::PARAM_STR);
	$query-> bindParam(':nume', $nume, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':telefon', $telefon, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query->execute();
	if ($query->execute() === TRUE) {
		$message = '<div class="succWrap"><strong>SUCCES</strong>: Datele au fost introduce cu succes !</div>';
	  } else {
		$message = '<div class="succWrap"><strong>EROARE</strong>: A aparut o eroare la intoriducerea datelor !</div>';
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

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">Actualizare Profil</div>

							<?php if(isset($message)) {?>
								<?php echo $message; ?>
							<?php }?>
							
							<div class="panel-body">
								<form method="post" class="form-horizontal" enctype="multipart/form-data" name="profileform">
									<div class="col-md-6">
										<h4 class="mb">Date Companie</h4>
										<label class="text-uppercase text-sm">Denumire Companie</label>
										<input type="text" name="companie" class="form-control mb" value="<?php echo htmlentities($result->companie);?>">

										<label class="text-uppercase text-sm">C.I.F.</label>
										<input type="text" name="cif" class="form-control mb" value="<?php echo htmlentities($result->cif);?>">

										<label class="text-uppercase text-sm">Nr. Reg. Com.</label>
										<input type="text" name="nrregcom" class="form-control mb" value="<?php echo htmlentities($result->nrregcom);?>">
									</div>
									<div class="col-md-6">
									<h4 class="mb">Date Utilizator</h4>
										<label class="text-uppercase text-sm">Name</label>
										<input type="text" name="nume" class="form-control mb" value="<?php echo htmlentities($result->nume);?>">

										<label class="text-uppercase text-sm">E-mail</label>
										<input type="text" name="email" class="form-control mb email" value="<?php echo htmlentities($result->email);?>">

										<label class="text-uppercase text-sm">Telefon</label>
										<input type="text" name="telefon" class="form-control mb" value="<?php echo htmlentities($result->telefon);?>">
										
										<input type="hidden" name="idedit" class="form-control mb" required value="<?php echo htmlentities($result->id);?>">
										<button class="btn btn-primary" name="submit" type="submit">Salveaza</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include('utile/footer.php'); ?>
<?php } ?>