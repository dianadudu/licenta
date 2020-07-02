<?php
$pageTitle = 'indicator.ro | Schimbare parola';
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

// Code for change password	
if(isset($_POST['submit']))
	{
$parola=md5($_POST['parola']);
$parolanoua=md5($_POST['parolanoua']);
$utilizator=$_SESSION['alogin'];
$sql ="SELECT parola FROM utilizatori WHERE email=:utilizator and parola=:parola";
$query= $dbh -> prepare($sql);
$query-> bindParam(':utilizator', $utilizator, PDO::PARAM_STR);
$query-> bindParam(':parola', $parola, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update utilizatori set parola=:parolanoua where email=:utilizator";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':utilizator', $utilizator, PDO::PARAM_STR);
$chngpwd1-> bindParam(':parolanoua', $parolanoua, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Parola dvs. a fost schimbata cu succes.";
}
else {
$error="Parola curenta este incorecta.";	
}
}
?>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmaparola.value)
{
alert("Parola noua si Confirmarea Parolei noi nu sunt identice !!");
document.chngpwd.confirmaparola.focus();
return false;
}
return true;
}
</script>
	
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					

						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<div class="panel panel-default">
									<div class="panel-heading">Schimbare parola</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>EROARE</strong>: <?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCES</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
											<label for="" class="text-uppercase text-sm">Parola Curenta</label>
											<input type="password" class="form-control mb" name="parola" id="parola" required>

											<label for="" class="text-uppercase text-sm">Parola Noua</label>
											<input type="password" class="form-control mb" name="parolanoua" id="parolanoua" required>

											<label for="" class="text-uppercase text-sm">Confirmati Parola Curenta</label>
											<input type="password" class="form-control mb" name="confirmaparola" id="confirmaparola" required>
											
											<button class="btn btn-primary" name="submit" type="submit">Schimba Parola</button>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
					<?php include('utile/footer.php'); ?>
<?php } ?>