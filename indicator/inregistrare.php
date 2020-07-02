<?php
include('utile/config.php');
error_reporting(1);

if(isset($_POST['submit']))
{

$nume=$_POST['nume'];
$email=$_POST['email'];
$parola=md5($_POST['parola']);
$telefon=$_POST['telefon'];
$companie=$_POST['companie'];
$cif=$_POST['cif'];
$nrregcom=$_POST['nrregcom'];

$tip='Cont nou';
$destinatar='Admin';
$expeditor=$companie;

$sqlnoti="INSERT INTO notificari (expeditor,destinatar,tip) VALUES (:expeditor,:destinatar,:tip)";
$querynoti = $dbh->prepare($sqlnoti);
$querynoti-> bindParam(':expeditor', $expeditor, PDO::PARAM_STR);
$querynoti-> bindParam(':destinatar',$destinatar, PDO::PARAM_STR);
$querynoti-> bindParam(':tip', $tip, PDO::PARAM_STR);
$querynoti->execute();    
    
$sql ="INSERT INTO utilizatori (nume,email,parola,telefon,companie,cif,nrregcom,stare) VALUES (:nume,:email,:parola,:telefon,:companie,:cif,:nrregcom,0)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':nume', $nume, PDO::PARAM_STR);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':parola', $parola, PDO::PARAM_STR);
$query-> bindParam(':telefon', $telefon, PDO::PARAM_STR);
$query-> bindParam(':companie', $companie, PDO::PARAM_STR);
$query-> bindParam(':cif', $cif, PDO::PARAM_STR);
$query-> bindParam(':nrregcom', $nrregcom, PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script type='text/javascript'>alert('Contul dvs. a fost inregistrat cu succes !');</script>";
echo "<script type='text/javascript'> document.location = 'inregistrare-reusita.php'; </script>";
}
else 
{
$error="Something went wrong. Please try again";
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

	
	<link rel="stylesheet" href="utile/css/font-awesome.min.css">
	<link rel="stylesheet" href="utile/css/bootstrap.min.css">
	<link rel="stylesheet" href="utile/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="utile/css/bootstrap-social.css">
	<link rel="stylesheet" href="utile/css/bootstrap-select.css">
	<link rel="stylesheet" href="utile/css/fileinput.min.css">
	<link rel="stylesheet" href="utile/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="utile/css/style.css">
    <script type="text/javascript">

        
</script>
</head>

<body>
	<div class="register-page bk-img">
        <div class="wrapper-page">
            <div class="form-content">
                <div class="container">
                    <div class="row">
					<div class="col-md-8 col-md-offset-2">
                    <img class="logo" src="utile/images/logo.svg"/>
						<div class="well row pt-2x pb-3x bk-light">
                            <h3 class="text-center text-bold mb-2x">Inregistrare</h3>
                         <form method="post" class="form-horizontal" id="formular"enctype="multipart/form-data" name="regform">
                            <div class="col-md-6">
                                <h4>Date companie</h4>
                            <!-- Date firma -->
                            
                                <label for="companie" class="text-uppercase text-sm">Denumire companie</label>
                                <input type="text" name="companie" class="form-control mb" placeholder="S.C. Companie S.R.L." required>
                                <label for="cif" class="text-uppercase text-sm">C.I.F.</label>
                                <input type="text" name="cif" class="form-control mb" placeholder="RO12345678" required>
                                <label for="nrregcom" class="text-uppercase text-sm">Nr. Reg. Com.</label>
                                <input type="text" name="nrregcom" class="form-control mb" placeholder="J00/000/2020" required>
                            <!-- Date firma Stop -->
                            <!-- Date utilizator -->
                            </div>
                            <div class="col-md-6">
                                <h4>Date utilizator</h4>
                                <label for="" class="text-uppercase text-sm">Nume</label>
                                <input type="text" name="nume" class="form-control mb" placeholder="Ion Popescu" required>
                                <label for="" class="text-uppercase text-sm">Telefon</label>
                                <input type="tel" name="telefon" class="form-control mb" placeholder="0723456789" required>
                                <label for="" class="text-uppercase text-sm">E-mail</label>
                                <input type="text" name="email" class="form-control mb" placeholder="email@domeniu.com" required>
                                <label for="" class="text-uppercase text-sm">Parola</label>
                                <input type="password" name="parola" class="form-control mb" id="parola" placeholder="************" required >
                                <button class="btn btn-primary mb" name="submit" type="submit">Inregistrare</button>
								<p>Ai cont ? <a href="index.php" >Autentifica-te</a></p>
                            </div>
                            </form>
							</div>
						</div>
				</div>
			</div>
        </div>
    </div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="utile/js/jquery.min.js"></script>
	<script src="utile/js/bootstrap-select.min.js"></script>
	<script src="utile/js/bootstrap.min.js"></script>
	<script src="utile/js/jquery.dataTables.min.js"></script>
	<script src="utile/js/dataTables.bootstrap.min.js"></script>
	<script src="utile/js/Chart.min.js"></script>
	<script src="utile/js/fileinput.js"></script>
	<script src="utile/js/chartData.js"></script>
	<script src="utile/js/main.js"></script>

</body>
</html>