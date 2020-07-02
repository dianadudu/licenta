<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title><?php echo $pageTitle ?></title>

	<!-- Font awesome -->
	<script src="https://kit.fontawesome.com/290f802096.js" crossorigin="anonymous"></script>
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="utile/css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="utile/css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="utile/css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="utile/css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="utile/css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="utile/css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="utile/css/style.css">
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
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>
</head>
<body>
    <div class="ts-main-content">
       

<?php $email = $_SESSION['alogin'];
$sql = "SELECT * from utilizatori where email = (:email);";
$query = $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);
$cnt=1;	?>
 <?php include('utile/bara-sus.php');?>
        <?php include('utile/meniu.php');?>
        <div class="content-wrapper">