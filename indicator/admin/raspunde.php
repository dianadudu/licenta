<?php
// Initializare sesiune
session_start();
error_reporting(0);
require_once "../utile/config.php";
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	include('utile/header.php');

	if(isset($_GET['reply']))
	{
	$replyto=$_GET['reply'];
	}   

	if(isset($_POST['submit']))
  {	
	$reciver=$_POST['email'];
    $message=$_POST['message'];
	$notitype='Send Message';
	$sender='Admin';
	
    $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
    $querynoti = $dbh->prepare($sqlnoti);
	$querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
	$querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
    $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
    $querynoti->execute();

	$sql="insert into feedback (sender, reciver, feedbackdata) values (:user,:reciver,:description)";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':user', $sender, PDO::PARAM_STR);
	$query-> bindParam(':reciver', $reciver, PDO::PARAM_STR);
	$query-> bindParam(':description', $message, PDO::PARAM_STR);
    $query->execute(); 
	$msg="Feedback Send";
  }
?>

<?php
		$sql = "SELECT * from users;";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('utile/bara-sus.php');?>
	<div class="ts-main-content">
	<?php include('utile/meniu.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
                            <h2>Raspunde sugestiei</h2>
								<div class="panel panel-default">
									<div class="panel-heading">Formular</div>
<?php if($error){?><div class="errorWrap"><strong>EROARE</strong>: <?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCES</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
	<label class="col-sm-2 control-label">Catre<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="email" class="form-control" readonly required value="<?php echo htmlentities($replyto);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Mesaj<span style="color:red">*</span></label>
	<div class="col-sm-6">
	<textarea name="message" class="form-control" cols="30" rows="10"></textarea>
	</div>
</div>

<input type="hidden" name="editid" class="form-control" required value="<?php echo htmlentities($result->id);?>">

<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Trimite raspuns</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php include('utile/footer.php') ?>