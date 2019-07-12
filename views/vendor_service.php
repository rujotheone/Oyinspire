<?php
require_once('require.php');

$dbh = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
$auth = initialize();
$vid= $_REQUEST['data'];
$return="";

	
$query=$dbh->prepare("SELECT service FROM vendor_services where vendor= ? ");
$query->execute(array($vid));
if($query->rowCount() == 0)
 	{
		$return ="Vendor does not offer services";
	}
 $service_ids= $query->fetchAll(\PDO::FETCH_ASSOC);
 

foreach($service_ids as $key => $value)
{
	
	$query=$dbh->prepare("SELECT types FROM services where id=?");
	$query->bindValue(1,$value['service'],PDO::PARAM_INT);
	$q=$query->execute();
	

	if($query->rowCount() == 0)
	 	{
			$return ="Service is not availiable";
		}
	 $return[$key]= $query->fetch(\PDO::FETCH_ASSOC)['types'];
}


 if ($return=="Service is not availiable")
 {
    echo "Service is not availiable";
 }
 else if ($return=="Vendor does not offer services")
 {
 	echo "Vendor does not offer services";
 }
 else 
 {
    while($term=each($return))
	{
		echo $term['value'].' ';
	}
}







?>