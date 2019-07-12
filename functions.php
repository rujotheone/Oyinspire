<?php


function initialize()
{
	include "PHPAuth-master/languages/en_GB.php";
	require_once('PHPAuth-master/Auth.php');
	require_once("PHPAuth-master/languages/en_GB.php");
	 require_once("PHPAuth-master/Config.php");
	
	  //$dbh = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
      $config = new PHPAuth\Config($GLOBALS['dbh']);
      $auth   = new PHPAuth\Auth($GLOBALS['dbh'], $config, $lang);
      return $auth;
}

function isLoggedIn(){

	$auth= initialize();
	if(isset($_SESSION['expiretime']))
	{
		if(time()>($_SESSION['expiretime']+1440))
		  {
		  	//unset($_SESSION['sid']);
			unset($_SESSION['loggedIn']);
		     return false;
		  }
	}
	return isset($_SESSION['sid']) && isset($_SESSION['username']) && isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn']===true) && $auth->isLogged();
}

function Loggedin($email, $username,$hash,$time){

	session_regenerate_id(true);
	session_id($hash);
	$_SESSION['sid'] = $hash;
	$_SESSION['username'] = $username;
	$_SESSION['loggedIn'] = true;
	$_SESSION['expiretime']=time();
	setcookie('oyme_us' ,$hash,$time);

	//setcookie('authID' , $hash,$time) ;

	
}

function LoginFail($uid, $username, $ulogin){
	// Note, in case of a failed login, $uid, $username or both
	// might not be set (might be NULL).
	echo 'login failed<br>';
	
}

function Logout(){
  
	$auth= initialize();
	$auth->logout($_SESSION['sid']);
	unset($_SESSION['sid']);
	unset($_SESSION['username']);
	unset($_SESSION['loggedIn']);
	$_SESSION = array();


// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) 
	{
		//setcookie('PHPSESSID' , $_COOKIE["PHPSESSID"], "1970-01-01T00:00:01.000Z");
		//session_destroy();

	    $params = session_get_cookie_params();
	    setcookie('oyme_us', $_SESSION['sid'], time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	session_destroy();
}

function uploadImage($image,$username)
{

	if(isset($image))
    {
      try {
        $isUploaded = imageUploader::upload();
      } catch (Exception $e) {
        return "Please upload a picture";//echo '<pre>'; var_dump($e); die;
      }

      if($isUploaded===true)
        return imageUploader::$imagepath;
    }

	// $image_type=explode('.',  $image['name']);
	// $image_type=$image_type[sizeof($image_type)-1];
	// $image_dest =  __DIR__.'/uploads/'.$username.'.'.$image_type;
	//  if(!move_uploaded_file($image['tmp_name'], $image_dest))
	// 	return "error";
	//  else 
	// 	 return '/oyinspire/uploads/'.$username.'.'.$image_type;;
}

function completeCustomerProfile($cred,$username){

	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);
	$query = $GLOBALS['dbh']->prepare("INSERT INTO  customers (user_id, firstname, lastname, profile_image, address, address2, state, country, phone_number, sex ) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

   if(!$query->execute(array($uid, $cred['firstname'],$cred['lastname'],$cred['image'],
   								$cred['address'],$cred['address2'],$cred['state'],1, $cred['phone'],$cred['sex'])))
	    {
	   		return false;
	   	}
	   else 
  		 	return true;	
}

function updateCustomerProfile($cred,$username){

	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);

	$query = $GLOBALS['dbh']->prepare("UPDATE  customers SET  firstname=?, lastname=?, profile_image=?, 
		address=?, address2=?, state=?, country=?, phone_number=?, sex=? WHERE user_id=?");

	 if(!$query->execute(array($cred['firstname'],$cred['lastname'],$cred['image'],
   								$cred['address'],$cred['address2'],$cred['state'],1, $cred['phone'],$cred['sex'],$uid)))
	    {
	   		return false;
	   	}
	   else 
  		 	return true;

}

function getCustomerProfile($username){

	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);
	$query=$GLOBALS['dbh']->prepare("SELECT * FROM customers where user_id= ?");
	$query->execute(array($uid));
		if($query->rowCount() == 0)
	 	{
			return false;
		}
	 return $query->fetch(\PDO::FETCH_ASSOC);

}

function isUser($owner,$visitor)
{
	if ($owner===$visitor)
		return true;
	else
		return false;
}

function isAVendor($name,$vendor_userid)
{
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($name);
	if ($uid===$vendor_userid)
		return true;
	else
	{
		$query=$GLOBALS['dbh']->prepare("SELECT * FROM vendors where name LIKE  ?");
	    $query->execute(array($name));
	     if ($query->rowCount()==0)
	        	return false;
	       if($query->fetch(\PDO::FETCH_ASSOC)['user_id']==$vendor_userid)
	       	return true;
	}
}

function isACustomer($username)
{
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);

	$query=$GLOBALS['dbh']->prepare("SELECT * FROM customers where id=?");
    $query->execute(array($uid));
     if ($query->rowCount()==0)
        	return false;

        return true;  
	
}

function getVendorProfile($name)
{
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($name);
	$query=$GLOBALS['dbh']->prepare("SELECT * FROM vendors where user_id= ?");
	$query->execute(array($uid));
		if($query->rowCount() == 0)
	 	{
			$query=$GLOBALS['dbh']->prepare("SELECT * FROM vendors where name LIKE  ?");
	        $query->execute(array($name));
	        if ($query->rowCount()==0)
	        	return false;
	       return $query->fetch(\PDO::FETCH_ASSOC);
		}
	 return $query->fetch(\PDO::FETCH_ASSOC);
}

function updateVendorProfile($cred,$username){

	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);

	$query = $GLOBALS['dbh']->prepare("UPDATE vendors SET name=?, vendor_logo=?, address=?, address2=?, state=?, phone_number=?, website=?
							WHERE user_id=?");

	 if(!$query->execute(array($cred['name'],$cred['image'],
   								$cred['address'],$cred['address2'],$cred['state'],$cred['phone'],$cred['website'],$uid)))
	    {
	   		return false;
	   	}
	   else 
  		 	return true;

}

function getVendorServices($username,$servid=NULL){

	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$v=getVendorProfile($username);
	$vid=$v['id'];

	if($servid!=NULL){

		$query=$GLOBALS['dbh']->prepare("SELECT * FROM vendor_services where vendor= ? AND service=?");
		$query->execute(array($vid,$servid));
		if($query->rowCount() != 0)
		 	{
				return true;
			}
	}

	$query=$GLOBALS['dbh']->prepare("SELECT * FROM vendor_services where vendor= ? ");
	$query->execute(array($vid));
	if($query->rowCount() == 0)
	 	{
			return false;
		}
	 return $query->fetch(\PDO::FETCH_ASSOC);

}

 function updateVendorServices($services,$username){

 	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);

 	$query=$GLOBALS['dbh']->prepare("SELECT id FROM vendors WHERE user_id =?");
   	$query->execute(array($uid));
   	$vid=$query->fetch(\PDO::FETCH_ASSOC)['id'];


   	for($i=1;$i<=sizeof($services);$i++)
   	{
   		if(getVendorServices($username,$services[$i])==true)
   			continue;
	   	$query=$GLOBALS['dbh']->prepare("INSERT INTO  vendor_services (vendor,service) VALUES (?,?)");
	   	$query->bindValue(1,$vid,PDO::PARAM_INT);
	   	$query->bindValue(1,$services[$i],PDO::PARAM_INT);
	   	if (!$query->execute())
	   	return false;
   	}
   	return true;

}

function completeVendorProfile($cred,$username,$services=array())
{	
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$auth= initialize();
	$uid= $auth->getUIDFromUsername($username);

	$query = $GLOBALS['dbh']->prepare("INSERT INTO  vendors (user_id, name, vendor_logo, address, address2, state,lga, phone_number, website) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

   if(!$query->execute(array($uid, $cred['name'], $cred['image'], $cred['address'], $cred['address2'],$cred['state'], 1, $cred['phone'],$cred['website'])))
   return false; 

   if(updateVendorServices($services,$username)==true)
   	return true;
   else 
    return false;
   		
   
}

function getVendors($location=1,$page=1,$service=NULL){
	
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$begin=($page*10)-10;
	$end=10;
	$rating=1;
	

	if ($service===NULL)
	{
		$query = $GLOBALS['dbh']->prepare("SELECT * FROM vendors WHERE state=? ORDER BY ratings DESC LIMIT ?, ?");
		$query->bindValue(1,$location,PDO::PARAM_INT);
		$query->bindValue(2,$begin,PDO::PARAM_INT);
		$query->bindValue(3,$end,PDO::PARAM_INT);
		$query->execute();
		if($query->rowCount() == 0) 
		{
			return false;
		}

		return $query->fetchAll(\PDO::FETCH_ASSOC);
	}
    else 
    {
   	    $query = $GLOBALS['dbh']->prepare("SELECT * FROM vendors AS v INNER JOIN  
   	    						(SELECT * FROM ( SELECT * FROM vendor_services INNER JOIN services WHERE vendor_services.service = services.id) 
   	    						AS a WHERE a.types LIKE ?) AS t ON v.id= t.vendor WHERE v.state=? ORDER BY ratings DESC LIMIT ?, ? ");
   	    $query->bindValue(1,$service,PDO::PARAM_STR);
   	    $query->bindValue(2,$location,PDO::PARAM_INT);
		$query->bindValue(3,$begin,PDO::PARAM_INT);
		$query->bindValue(4,$end,PDO::PARAM_INT);
				
   	    $query->execute();
   	    
   	    if($query->rowCount() == 0) 
		{
			return false;
		}

		return $query->fetchAll(\PDO::FETCH_ASSOC);
		

		
	}

}

function getPlanners($name,$location,$page=1)
{
		$begin=($page*10)-10;
		$end=10;
		//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");

		if($name="all")
		{
			$query=$GLOBALS['dbh']->prepare("SELECT * FROM planners WHERE  state=? ORDER BY ratings DESC LIMIT ?, ?");
			$query->execute(array($location,$begin,$end));
			  if($query->rowCount() == 0)
			 	{
					return false;
				}
				return true;
		}
		else
		{
			$query=$GLOBALS['dbh']->prepare("SELECT * FROM planners WHERE name LIKE ? AND state=? ORDER BY ratings DESC LIMIT ?, ?");
			$query->execute(array($name,$location,$begin,$end));
			if($query->rowCount() == 0)
			 	{
					return false;
				}
				return true;
		}
}

function getEvents($id,$page=1,$vendor=false)
{
		$begin=($page*10)-10;
		$end=10;	
		//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");

		if($vendor==true)
		{
			$query=$GLOBALS['dbh']->prepare("SELECT * FROM events INNER JOIN event_vendors WHERE events.id=event_vendors.event AND vendor=?");
			$query->bindValue(1,$id,PDO::PARAM_STR);
			$query->execute();

			if($query->rowCount() == 0) 
			{
				return false;
			}

		return $query->fetchAll(\PDO::FETCH_ASSOC);
		}

		
		$query=$GLOBALS['dbh']->prepare("SELECT * FROM events WHERE customer =? ORDER BY starts DESC LIMIT ?, ?");
		$query->bindValue(1,$id,PDO::PARAM_STR);
		$query->bindValue(2,$begin,PDO::PARAM_INT);
		$query->bindValue(3,$end,PDO::PARAM_INT);

   	    $query->execute();
   		
		if($query->rowCount() == 0) 
		{
			return false;
		}

		return $query->fetchAll(\PDO::FETCH_ASSOC);


}

function createEvent($event_data,$event_vendors,$customer)
{
	$event_data['social']=implode(";",$event_data['social']);
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");

	$query=$GLOBALS['dbh']->prepare("SELECT id FROM event_types WHERE types LIKE ?");
	$query->execute(array($event_data['type']));
	if ($query->rowCount()==0){
		$query=$GLOBALS['dbh']->prepare("INSERT INTO  event_types (types) VALUES (?)");
	    $query->execute(array($event_data['type']));
		$type=1;
	}
	else 
		$type=$query->fetchAll(\PDO::FETCH_ASSOC)['id'];


		$query=$GLOBALS['dbh']->prepare("INSERT INTO  venues (name,state) VALUES (?,?)");
	    $query->execute(array($event_data['venue'],$event_data['state']));

	    $starts=date('Y-m-d H:i:s',strtotime($event[$i]['starts']));
	    $ends=date('Y-m-d H:i:s',strtotime($event[$i]['endss']));


	$query=$GLOBALS['dbh']->prepare("INSERT INTO  events (types,name,customer,state,starts,ends,venue,address,address2,image,description,social_media) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	 if(!$query->execute(array($type, $event_data['name'], intval($customer), intval($event_data['state']), 
	 				$starts,$ends,$event_data['venue'],$event_data['address'],$event_data['address2'],
	 				$event_data['image'],$event_data['description'],$event_data['social'])))
       return $query->errorInfo();
       else
       {
       		$query=$GLOBALS['dbh']->prepare("SELECT id FROM events ORDER BY id DESC");
	    	$query->execute();
	    	$event_id=$query->fetch(\PDO::FETCH_ASSOC)['id'];
       } 
       

   		foreach($event_vendors as $service => $vendor)
   		{
   			for ($i=0;$i<sizeof($vendor);$i++)
   			{
   				$query=$GLOBALS['dbh']->prepare("INSERT INTO  event_vendors (event,vendor,service_done) 
					VALUES (?,?,?)");
   				if(!$query->execute(array(intval($event_id),intval(strstr($vendor[$i],';',true)),$service)))
   					return $query->errorInfo();
   			}
   		}
       	
       	$query=$GLOBALS['dbh']->prepare("SELECT * FROM invoices ") ;
       	$query->execute();
       	$return['ref']= $query->rowCount()+1;
       	$return['event_id']=$event_id;
   		return $return;
}

function createInvoice($ref,$event,$customer)
{
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	$query=$GLOBALS['dbh']->prepare("INSERT INTO  invoices (reference,customer,event) 
					VALUES (?,?,?)");
	$query->bindValue(1,$ref,PDO::PARAM_INT);
	$query->bindValue(2,$customer,PDO::PARAM_INT);
	$query->bindValue(3,$event,PDO::PARAM_INT);
	if(!$query->execute())
	{
		return false;
	}
	else 
		return true;
}

function searchDB($q,$page)
{
	$begin=($page*10)-10;
	$end=10;
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");
	// $query=$GLOBALS['dbh']->prepare("SELECT * FROM vendors INNER JOIN planners INNER JOIN customers 
	// 						INNER JOIN events INNER JOIN state INNER JOIN venues WHERE ")

	$search='%'.$q.'%';
	$query = $GLOBALS['dbh']->prepare("SELECT * FROM vendors WHERE state=1 OR
							name LIKE :search1 OR address LIKE :search2 OR address2 LIKE :search3
							 OR phone_number LIKE :search4	OR website  LIKE :search5 OR gallery LIKE :search6
							  /*ORDER BY name DESC */LIMIT :b, :e");
		$query->bindParam(':search1',$search,PDO::PARAM_STR);
		$query->bindParam(':search2',$search,PDO::PARAM_STR);
		$query->bindParam(':search3',$search,PDO::PARAM_STR);
		$query->bindParam(':search4',$search,PDO::PARAM_STR);
		$query->bindParam(':search5',$search,PDO::PARAM_STR);
		$query->bindParam(':search6',$search,PDO::PARAM_STR);
		//$query->bindParam(7,$q,PDO::PARAM_STR);
		$query->bindParam(':b',$begin,PDO::PARAM_INT);
		$query->bindParam(':e',$end,PDO::PARAM_INT);
		$query->execute(/*array(':search'=>'%'.$q.'%',':search'=>'%'.$q.'%',':search'=>'%'.$q.'%',
								':search'=>'%'.$q.'%',':search'=>'%'.$q.'%',':search'=>'%'.$q.'%',':b'=>$begin,':e'=>$end)*/);

		if($query->rowCount()==0)
		{
			return "Sorry we could not find anything matching your query";
		}
		else 
			return $query->fetchAll(\PDO::FETCH_ASSOC);

}

function getLocation($state=NULL,$country=NULL)
{
	//$GLOBALS['dbh'] = new PDO("mysql:host=localhost;dbname=oyinspire", "", "");

	if($state!=NULL)
	{
		$query=$GLOBALS['dbh']->prepare("SELECT name FROM state WHERE id= ?");
		$query->execute(array(intval($state)));
		if ($query->rowCount()==0)
		{
			return "State not found";
		}
		else 
			$return['state']=$query->fetch(\PDO::FETCH_ASSOC)['name'];
	}
	if($country!=NULL)
	{
		$query=$GLOBALS['dbh']->prepare("SELECT name FROM country WHERE id= ?");
		$query->execute(array(intval($country)));
		if ($query->rowCount()==0)
		{
			return "Country not found";
		}
		else 
			$return['country']=$query->fetch(\PDO::FETCH_ASSOC)['name'];
	}

 	return $return['state'];
}
?>