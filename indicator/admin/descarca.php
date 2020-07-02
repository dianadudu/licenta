<?php 
// Initializare sesiune
session_start();
//error_reporting(0);
session_regenerate_id(true);
require_once "../utile/config.php";

if(strlen($_SESSION['alogin'])==0)
	{	
	header("Location: index.php"); //
	}
	else{?>
<table border="1">
	<thead>
		<tr>
		<th>#</th>
			<th>Companie</th>
			<th>C.I.F.</th>
			<th>Nr.Reg.Com.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Telefon</th>
			
		</tr>
	</thead>
	<tbody>
<?php 

$filename="Raport";
$sql = "SELECT * from utilizatori";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-conturi.xls");
header("Pragma: no-cache");
header("Expires: 0");
if($query->rowCount() > 0)
{
foreach($results as $result)
{				

echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$Company= $result->companie.'</td> 
<td>'.$CIF= $result->cif.'</td> 
<td>'.$Nrregcom= $result->nrregcom.'</td> 	
<td>'.$Name= $result->nume.'</td> 
<td>'.$Email= $result->email.'</td> 
<td>'.$Phone= $result->telefon.'</td> 
				
</tr>  
';

			$cnt++;
			}
	}
?>
</tbody>
</table>
<?php } ?>