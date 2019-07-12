<?php
if (!session_start())
  session_start();

$_SESSION['ref']=$_SERVER['REQUEST_URI'];
$auth=initialize();
$msg='';


if (isLoggedIn())
{
   $_SESSION['expiretime']=time();
  $user=getCustomerProfile($_SESSION['username']);
   $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'";>         
        </a>';
}
else
$dash='<a  data-action='.'"login"'.'class='.'"modalbtn"'.'href='.'"login"'.'>Login</a>'." 
".'<a data-action='.'"signup"'.'class='.'"modalbtn tablet"'.' href='.'"signup"'.'>Sign up</a>';


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
  <title> How It Works | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/howitworks.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>
</head>

<body class="not-home">
<?php require 'header.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
        <section>
          <div class="bullet">1</div>
          <h3>Visit Oyinspire.me</h3>
        </section>
        <section>
          <div class="bullet">2</div>
          <h3>Login or Signup </h3>
        </section>
        <section>
          <div class="bullet">3</div>
          <h3>If you want to plan an event,click on the create event button </h3>
          <h3>If you are looking for an event planner go to the hire planner button and pick a planner of your choice</h3>
        </section>
        <section>
          <div class="bullet">4</div>
          <h1>Creating Events</h1>
          <h3>To create an event, fill in the details of the event in the first page</h3>
          <h3>Next,Pick a vendor for each service.If you want a vendor for all services,tick the option shown</h3>
          <h3>We will get in touch with you to confirm your order</h3>
          <h3>After confirmation,an invoice will be sent to your Email pending payment</h3>        
          <h3>Congratulations!!</h3>
        </section>
      </div>
		</div>
	</div>



<?php require 'footer.php'; ?>
<?php require 'modal.php'; ?>

</body>
</html>