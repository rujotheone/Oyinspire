<?php 
if (!session_start())
  session_start();

 if (!isLoggedIn())
 {
 	$return ='<a href="'.$router->generate("login").'">Please login</a>';
 }
 else
 {
$dbh = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
$auth = initialize();
$return="";
$rating= $_REQUEST['data'];
$type= $_REQUEST['prof'];
$id=$_REQUEST['pid'];

//echo  $rating.$type.$id;


if ($type=="vendors")
{
	$query=$dbh->prepare("SELECT ratings,voters_number FROM vendors WHERE id=?");
	$query->execute(array($id));
	if($query->rowCount() == 0)
 	{
		$return ="Vendor does not exist";
	}
 	$result= $query->fetchAll(\PDO::FETCH_ASSOC);
    $number=$result[0]['voters_number'];
    $oldrating=$result[0]['ratings'];
    $newrating=(($oldrating*$number)+$rating)/($number+1);

	$query=$dbh->prepare("UPDATE  vendors SET  ratings=? ,voters_number=? WHERE id=?");
	if(!$query->execute(array($newrating,intval($number+1),$id)))
	    {
	   		$return ="There was a problem";
	   	}
	 else
	 	$return ="Rated";

}

}

echo $return;

?>