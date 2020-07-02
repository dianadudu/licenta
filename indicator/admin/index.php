<?php
// Initializare sesiune
session_start();
require_once "../utile/config.php";
include('utile/header.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$parola=md5($_POST['parola']);
$sql ="SELECT UserName,Parola FROM admin WHERE UserName=:email and Parola=:parola";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':parola', $parola, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'tablou-bord.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<div class="login-page bk-img">
		<div class="wrapper-page">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
					<img class="logo" src="../utile/images/logo.svg"/>
						<div class="well row pt-2x pb-2x bk-light">
						<!-- <?php if($error){?><div class="errorWrap"><strong>EROARE</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCES</strong>:<?php echo htmlentities($msg); ?> </div><?php }?> -->
							<div class="col-md-12">
							<h3 class="text-center text-bold mb-2x">Autentificare Admin</h3>
								<form method="post">

									<label for="" class="text-uppercase text-sm">Utilizator</label>
									<input type="text" placeholder="Utilizator" name="username" class="form-control mb" required>

									<label for="" class="text-uppercase text-sm">Parola</label>
									<input type="password" placeholder="Introduceti parola" name="parola" class="form-control mb" required>
									<button class="btn btn-primary btn-block" name="login" type="submit">Autentificare</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('utile/footer.php') ?>