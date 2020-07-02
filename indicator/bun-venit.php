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
							<div class="panel-heading">Bine ai venit !</div>
							<div class="panel-body">
								<div class="col-md-5">
									<img src="utile/images/logo-colored.svg" class="img-fluid" alt="indicator"/>
								</div>
								<div class="col-md-7">
									<h3>Bună <?php echo htmlentities($result->nume);?>, bine ai venit pe indicator !</h3>
									<br/>
									<p>Datorită schimbărilor la care suntem supuși odată cu evoluția tehnologiei și datorită situației neplăcute și neașteptate prin care tocmai am trecut, proiectarea unei aplicații web care să răspundă unei evaluări amănunțite a întreprinderii, reprezintă un instrument util în „viața” fiecărei companii.</p> <p>Aplicația oferă posibilitatea agenților economici de a-și urmări rezultatele afacerii lor, mai mult decât profitul final sau cash-ul înregistrat în casierie sau bancă. Indicatorii sunt prezentați ca date numerice și sunt integrați într-un grafic ilustrativ.</p> <p> Aplicația web prezintă explicații referitoare la fiecare indicator calculat, pentru ca utilizatorul să își afle punctele tari și cele slabe ale firmei pe care o conduce, pentru elaborarea strategiilor pe termen scurt, dar mai ales pe termen mediu și lung.</p>
									<p>Începe prin a selecta din meniu indicatorul pe care doresti sa-l generezi și apoi adaugă date din situațiile financiare.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include('utile/footer.php'); ?>
<?php } ?>