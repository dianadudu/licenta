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
	$active_curente=$_POST['active_curente'];
	$stocuri=$_POST['stocuri'];
	$disponibilitati=$_POST['disponibilitati'];
	$invest_scurt=$_POST['invest_scurt'];
	$datorii_curente=$_POST['datorii_curente'];
	$lichiditate_generala=$_POST['lichiditate_generala'];
	$lichiditate_curenta=$_POST['lichiditate_curenta'];
	$lichiditate_imediata=$_POST['lichiditate_imediata'];
	$an=$_POST['an'];

	$sql = $dbh->prepare('SELECT * FROM ind_lic WHERE id_companie=:id_companie AND an=:an');
	$sql->execute(array(':id_companie' => $id_companie, ':an' => $an));
	if ( $sql->rowCount() > 0)  {
		$sql="UPDATE ind_lic SET active_curente=:active_curente, stocuri=:stocuri, disponibilitati=:disponibilitati, invest_scurt=:invest_scurt,datorii_curente=:datorii_curente,lichiditate_generala=:lichiditate_generala,lichiditate_curenta=:lichiditate_curenta,lichiditate_imediata=:lichiditate_imediata WHERE id_companie=:id_companie AND an=:an";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query-> bindParam(':active_curente', $active_curente, PDO::PARAM_STR);
		$query-> bindParam(':stocuri', $stocuri, PDO::PARAM_STR);
		$query-> bindParam(':disponibilitati', $disponibilitati, PDO::PARAM_STR);
		$query-> bindParam(':invest_scurt', $invest_scurt, PDO::PARAM_STR);
		$query-> bindParam(':datorii_curente', $datorii_curente, PDO::PARAM_STR);
		$query-> bindParam(':lichiditate_generala', $lichiditate_generala, PDO::PARAM_STR);
		$query-> bindParam(':lichiditate_curenta', $lichiditate_curenta, PDO::PARAM_STR);
		$query-> bindParam(':lichiditate_imediata', $lichiditate_imediata, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost actualizate cu succes !";
	}else{
		$sql="INSERT into ind_lic (id_companie,an,active_curente,stocuri,disponibilitati,invest_scurt,datorii_curente,lichiditate_generala,lichiditate_curenta,lichiditate_imediata) VALUES (:id_companie,:an,:active_curente,:stocuri,:disponibilitati,:invest_scurt,:datorii_curente,:lichiditate_generala,:lichiditate_curenta,:lichiditate_imediata)";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':id_companie', $id_companie, PDO::PARAM_STR);
		$query-> bindParam(':an', $an, PDO::PARAM_STR);
		$query-> bindParam(':active_curente', $active_curente, PDO::PARAM_STR);
		$query-> bindParam(':stocuri', $stocuri, PDO::PARAM_STR);
		$query-> bindParam(':disponibilitati', $disponibilitati, PDO::PARAM_STR);
		$query-> bindParam(':invest_scurt', $invest_scurt, PDO::PARAM_STR);
		$query-> bindParam(':datorii_curente', $datorii_curente, PDO::PARAM_STR);
		$query-> bindParam(':lichiditate_generala', $lichiditate_generala, PDO::PARAM_STR);
		$query-> bindParam(':lichiditate_curenta', $lichiditate_curenta, PDO::PARAM_STR);
		$query-> bindParam(':lichiditate_imediata', $lichiditate_imediata, PDO::PARAM_STR);
		$query->execute();
		$msg="Informatiile au fost introduse cu succes !";
	}
  }
 ?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
	<h4 class="page-title">Indicator Lichiditate Curenta</h4>
	<h5 class="sub-title">Pentru calcularea indicatorului este nevoie să introduceți următoarele date din situațiile financiare ale companiei dumneavoastră:</h5>
		<!-- Zero Configuration Table -->
		<div class="panel panel-default">
			<div class="panel-heading">Indicator lichiditate curenta
			<div class="actions"><a href="ind-lic.php">Vezi indicatorul <i class="fa fa-eye"></i></a></div></div>
			<?php if(isset($msg)){?><div class="succWrap"><?php echo htmlentities($msg); ?> </div><?php }?>
			<div class="panel-body">
				<form method="post" class="form-horizontal" enctype="multipart/form-data" name="lichiditatecurentaform">
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
						<label class="text-uppercase text-sm">Active curente (lei)</label>
						<input type="text" id="active_curente" name="active_curente" class="form-control calculeaza mb">
					</div>
					<div class="col-md-2">
						<label class="text-uppercase text-sm">Datorii curente (lei)</label>
						<input type="text" id="datorii_curente" name="datorii_curente" class="form-control mb" required>
					</div>
					<div class="col-md-2">
						<label class="text-uppercase text-sm">Stocuri (lei)</label>
						<input type="text" id="stocuri" name="stocuri" class="form-control calculeaza mb">
					</div>
					<div class="col-md-2">
						<label class="text-uppercase text-sm">Investitii pe termen scurt (lei)</label>
						<input type="text" id="invest_scurt" name="invest_scurt" class="form-control mb" required>
					</div>
					<div class="col-md-2">
						<label class="text-uppercase text-sm">Disponibilitati (lei)</label>
						<input type="text" id="disponibilitati" name="disponibilitati" class="form-control mb" required>
					</div>
					<div class="col-md-1">
					
					<input type="hidden" id="lichiditate_generala" name="lichiditate_generala" class="form-control">
					<input type="hidden" id="lichiditate_curenta" name="lichiditate_curenta" class="form-control">
					<input type="hidden" id="lichiditate_imediata" name="lichiditate_imediata" class="form-control">
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
        var active_curente = document.getElementById('active_curente').value;
        var datorii_curente = document.getElementById('datorii_curente').value;
		var stocuri = document.getElementById('stocuri').value;
		var disponibilitati = document.getElementById('disponibilitati').value;
		var invest_scurt = document.getElementById('invest_scurt').value;
		// Add them together and display
		var lichiditate_generala = active_curente / datorii_curente;
		var lichiditate_curenta = (active_curente - stocuri) / datorii_curente;
		var lichiditate_imediata = (parseInt(disponibilitati) + parseInt(invest_scurt)) / datorii_curente;
		document.getElementById('lichiditate_generala').value = lichiditate_generala;
		document.getElementById('lichiditate_curenta').value = lichiditate_curenta;
		document.getElementById('lichiditate_imediata').value = lichiditate_imediata;
    }
</script>
	<?php include('utile/footer.php'); ?>
<?php } ?>