<?php
$pageTitle = 'indicator.ro | Sugestii';
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
	$tip_sugestie=$_POST['tip_sugestie'];
	$titlu=$_POST['titlu'];
    $descriere=$_POST['descriere'];
	$expeditor=$_POST['expeditor'];
	$destinatar= 'Admin';
    $notitype='Trimitere sugestie';

	$sqlsugestii="INSERT INTO sugestii (expeditor,destinatar,tip_sugestie,titlu,descriere) VALUES (:expeditor,:destinatar,:tip_sugestie,:titlu,:descriere)";
	$querysugestii = $dbh->prepare($sqlsugestii);
	$querysugestii-> bindParam(':expeditor', $expeditor, PDO::PARAM_STR);
	$querysugestii-> bindParam(':destinatar', $destinatar, PDO::PARAM_STR);
	$querysugestii-> bindParam(':tip_sugestie', $tip_sugestie, PDO::PARAM_STR);
	$querysugestii-> bindParam(':titlu', $titlu, PDO::PARAM_STR);
	$querysugestii-> bindParam(':descriere', $descriere, PDO::PARAM_STR);
    $querysugestii->execute(); 
	$msg1="Sugestie Trimisa";

    $sqlnoti="INSERT INTO notificari (expeditor,destinatar,tip) VALUES (:expeditor,:destinatar,:tip)";
    $querynoti = $dbh->prepare($sqlnoti);
	$querynoti-> bindParam(':expeditor', $expeditor, PDO::PARAM_STR);
	$querynoti-> bindParam(':destinatar', $destinatar, PDO::PARAM_STR);
    $querynoti-> bindParam(':tip', $notitype, PDO::PARAM_STR);
	$querynoti->execute();
	$msg2="Notificare Trimisa";

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
				<div class="panel-heading">Trimite o sugestie</div>
				<div class="panel-body">
				<?php if(isset($msg1)){?><div class="succWrap"><?php echo htmlentities($msg1); ?> </div><?php }?>
				<?php if(isset($msg2)){?><div class="succWrap"><?php echo htmlentities($msg2); ?> </div><?php }?>

					<form method="post" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="expeditor" value="<?php echo htmlentities($result->email); ?>">
						<label class="text-uppercase text-sm">Tipul sugestiei</label>
						<select class="form-control mb" name="tip_sugestie" required>
							<option value="">Selectați tipul sugestiei</option>
							<option value="pozitiv">Pozitiv</option>
							<option value="negativ">Negativ</option>
						</select>
						<label for="titlu" class="text-uppercase text-sm">Titlu</label>
						<input type="text" name="titlu" class="form-control mb" required>
						<label for="descriere" class="text-uppercase text-sm">Descriere</label>
						<textarea class="form-control mb" rows="5" name="descriere" required></textarea>
						<button class="btn btn-primary" name="submit" type="submit">Trimite</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php include('utile/footer.php'); ?>
<?php } ?>