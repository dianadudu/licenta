<?php
// Initializare sesiune
session_start();
header('Content-Type: application/json');
error_reporting(1);
require_once "../utile/config.php";
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$email = $_SESSION['alogin'];
$sql = "SELECT * from utilizatori where email = (:email);";
$query = $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_OBJ);
$cnt=1;	

$sql = "SELECT tip_sugestie FROM sugestii";
$query = $dbh -> prepare($sql);
$query -> execute();
$result=$query->fetchAll(PDO::FETCH_OBJ);

$data = array();
if($query->rowCount() > 0)
	{
		foreach($result as $row)
		{
		$data[] = $row;
		}
	}
mysqli_close($dbh);

echo json_encode($data);

}
?>