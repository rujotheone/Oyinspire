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
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'">         
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
  <title> Services | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/parsley.css">


    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/parsley.min.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>

	</head>

  <body class="not-home">

<?php require 'header.php'; ?>

<div class="services-menu-con" style="display:block;margin-top:100px">
    <div class="text-centered" style="color:#000"><h2>Browse through vendors</h2></div>
    <div class="services-list">    
      <div class="cell">
        <div class="service" style="background-image: url('/oyinspire/assets/img/cake.jpg');"><a href="search?s=cake&p=vendor">Cake</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/decoration.jpg');"><a href="search?s=decoration&p=vendor">Decoration</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/food.jpg');"><a href="search?s=food&p=vendor">Food</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/designers.jpg');"><a href="search?s=designers&p=vendor">Designers</a></div>
      </div>
      <div class="cell">
        <div class="service" style="background-image: url('/oyinspire/assets/img/hair.jpg');"><a href="search?s=hair&p=vendor">Hair and Makeup</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/video.jpg');"><a href="search?s=video&p=vendor">Video</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/security.jpg');"><a href="search?s=security&p=vendor">Security</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/souveniers.jpg');"><a href="search?s=souveniers&p=vendor">Souveniers</a></div>
      </div>
      <div class="cell">
        <div class="service" style="background-image: url('/oyinspire/assets/img/ushers.jpg');"><a href="search?s=ushers&p=vendor">Ushers</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/photography.jpg');"><a href="search?s=photography&p=vendor">Photography</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/invites.jpg');"><a href="search?s=invites&p=vendor">Invites</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/drinks.jpg');"><a href="search?s=drinks&p=vendor">Drinks</a></div>
      </div>
      <div class="cell">
        <div class="service" style="background-image: url('/oyinspire/assets/img/fabrics.jpg');"><a href="search?s=fabrics&p=vendor">Fabrics and Wears</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/car.jpg');"><a href="search?s=cars&p=vendor">Car rentals</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/all.jpg');"><a href="search?s=all&p=vendor">all</a></div>
        <div class="service" style="background-image: url('/oyinspire/assets/img/all.jpg');"><a href="search?s=all&p=vendor">all</a></div>
      </div>
      </div>
    </div>

<?php require 'footer.php'; ?> 
 <?php require 'modal.php'; ?>


 <div class="page-loader"></div>

 
</body>


</html>
