<?php
 if (!session_start())
  session_start();
$msg="";


$user=getCustomerProfile($_SESSION['username']);
 
	if (!isLoggedIn())
	  {
	    header('Location:'.$router->generate('login'));
	  }

 if ($_SERVER['REQUEST_METHOD']=='POST' && $_SERVER['HTTP_REFERER']=="https://localhost/oyinspire/event/ticket")
      {
          
            $return_e=createEvent($_SESSION['event_data'],$_SESSION['event_vendors'],$user['id']);
            if($return_e==false)
            {
                $msg="Sorry,there was a problem";
            }
            else
            {
              $return_i=createInvoice($return_e['ref'],$return_e['event_id'],$user['id']);
              $return_i==false?$msg="Sorry,there was a problem":$msg="CONGRATULATIONS,YOU HAVE MADE AN ORDER";
              $_SESSION['event_data']=NULL;
              $_SESSION['event_vendors']=NULL;
              header('Location: created');
            }
      }

 ?>

 <!DOCTYPE html>
<html>
  <head>
     <!--[if lt IE 9]>
<script src="dist/html5shiv.js"></script>
<![endif]-->

<!--[if lt IE 7]>
<script src="dist/html5shiv.js"></script>
<![endif]-->

<!--[if lte IE 8]><script src="js/libs/selectivizr.js"></script><![endif]-->
  <title> Created Events | Create Events and Search for vendors | oyinspire.me</title>
     <meta charset="utf-8" />
     <meta http-equiv="Content-Type" content="text/html" />
  <meta http-equiv="Content-Language" content="en" />
  <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="Oyinspire makes it easier for youto plan and organiz events by connecting you to a community of vendors that offer various services" />
  <meta name="keywords" content="events plan planners vendors cakes wedding conference services rentals venue organize">
  <meta property="og:url" content="http://www.oyinspire.me/">
  <meta property="og:site_name" content="oyinspire.me"/>
<meta name="robots" content="index,follow"/>
 <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@oyinspire">
    <link rel="shortcut icon" href="/oyinspire/assets/favicon.ico">


    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/bootstrap-3.3.1.css">
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/createpage.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>



  </head>

<body class="not-home">
  <?php require __DIR__.'\..\header.php'; ?> 

  <div class="container">
    <div class="row" style="margin-top:100px">
      <div class="col-md-9">

<?php  echo $msg;?>
<?php  echo "Your invoice number is ".$return_e['ref'];?>

<br>
<a href="<?php echo $router->generate('create'); ?>">Create another event</a>
<br>
<a href="<?php echo $router->generate('home'); ?>">Go Home</a>
<br>
<a href="<?php echo $router->generate('help'); ?>">Report a problem</a>
<br>

</div>
</div>
</div>

<?php require __DIR__.'\..\footer.php'; ?> 
</body>
</html>