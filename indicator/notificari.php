<?php
$pageTitle = 'indicator.ro | Notificări';
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
?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Notificări</div>
									   <div class="panel-body">
										<?php 
										$destinatar = $_SESSION['alogin'];
										$sql = "SELECT * from  notificari where destinatar = (:destinatar) order by timp DESC";
										$query = $dbh -> prepare($sql);
										$query-> bindParam(':destinatar', $destinatar, PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{				?>	
        <h5 style="background:#ededed;padding:20px;"><i class="fa fa-bell text-primary"></i>&nbsp;&nbsp;<b class="text-primary"><?php echo htmlentities($result->timp);?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($result->expeditor);?> -----> <?php echo htmlentities($result->tip);?></h5>
                       <?php $cnt=$cnt+1; }} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
	<?php include('utile/footer.php'); ?>
<?php } ?>