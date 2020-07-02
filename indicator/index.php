<?php
session_start();
include('utile/config.php');
if(isset($_POST['login']))
{
$stare='1';
$email=$_POST['utilizator'];
$parola=md5($_POST['parola']);
$sql ="SELECT email,parola FROM utilizatori WHERE email=:email and parola=:parola and stare=(:stare)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':parola', $parola, PDO::PARAM_STR);
$query-> bindParam(':stare', $stare, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['utilizator'];
echo "<script type='text/javascript'> document.location = 'bun-venit.php'; </script>";
} else{
  echo "<script>alert('Date introduse sunt invalide sau contul dvs. nu a fost confirmat');</script>";
}

}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	
	<link rel="stylesheet" href="utile/css/bootstrap.min.css">
	<link rel="stylesheet" href="utile/css/bootstrap-select.css">
	<link rel="stylesheet" href="utile/css/style.css">

</head>

<body>
	<div class="login-page bk-img">
		<div class="wrapper-page">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
					<img class="logo" src="utile/images/logo.svg"/>
						<div class="well row pt-2x pb-2x bk-light">
						<!-- <?php if($error){?><div class="errorWrap"><strong>EROARE</strong>:<?php echo htmlentities($error); ?> </div><?php } 
							else if($msg){?><div class="succWrap"><strong>SUCCES</strong>:<?php echo htmlentities($msg); ?> </div><?php }?> -->
							<div class="col-md-12">
							<h3 class="text-center text-bold mb-2x">Autentificare</h3>
							<form method="post">

								<label for="" class="text-uppercase text-sm">E-mail</label>
								<input type="text" placeholder="Introduceti adresa de E-mail" name="utilizator" class="form-control mb" required>

								<label for="" class="text-uppercase text-sm">Parola</label>
								<input type="password" placeholder="Introduceti parola" name="parola" class="form-control mb" required>
								<button class="btn btn-primary btn-block" name="login" type="submit">Autentificare</button>
							</form>
							<br>
							<p>Nu aveti cont ? <a href="inregistrare.php" >Inregistrare</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div
	
	<!-- Loading Scripts -->
	<script src="utile/js/jquery.min.js"></script>
	<script src="utile/js/bootstrap-select.min.js"></script>
	<script src="utile/js/bootstrap.min.js"></script>
	<script src="utile/js/main.js"></script>

</body>

</html>