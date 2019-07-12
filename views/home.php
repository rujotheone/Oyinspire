<?php
 if (!session_start())
  session_start();

$_SESSION['ref']=$_SERVER['REQUEST_URI'];
$auth=initialize();
$msg='';


if (isLoggedIn())
{
  
  $_SESSION['expiretime']=time();
  dd(isLoggedIn());
  $user=getCustomerProfile($_SESSION['username']);
  $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'">         
        </a>';
}
else
{
  $dash='<a  data-action='.'"login"'.'class='.'"modalbtn"'.'href='.'"login"'.'>Login</a>'." 
  ".'<a data-action='.'"signup"'.'class='.'"modalbtn tablet"'.' href='.'"signup"'.'>Sign up</a>';
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
  <title> Home | Create Event and Search vendors | oyinspire.me</title>
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

  <frame id="loader" src="<?php echo $router->generate('loader'); ?>">
    <html>
      <head> 
         
      </head>
      <body>
      </body>
    </html>
  </frame>

<body class="home">

<?php require 'header.php'; ?>

<section id="wrapper">
    <article id="main">
      <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
          </ol>

            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="/oyinspire/assets/js/party-1.jpg" height="780" alt="Chania">
              </div>               

              <div class="item">
                <img src="/oyinspire/assets/js/party-2.jpg" height="780" alt="Chania">
              </div>

              <div class="item">
                <img src="/oyinspire/assets/js/party-3.jpg" height="780" alt="Flower">
              </div>

              <div class="item">
                <img src="/oyinspire/assets/js/party-4.jpg" height="780" alt="Flower">
              </div>
            </div>

            
           <!--  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a> -->
            </div> -->

        <div class="horizontal">
          <div class="row">
            <div id="Captionbig">
               
              <div style="margin: 0 auto;width:100%;color:rgba(54, 18, 75, 0.9);">
                <h1>PLAN AND ORGANIZE AN EVENT QUICKLY</h1>
                <div class="caption">                 
                  <div class="word">INSPIRED</div>
                  <div class="word">TIMED</div>
                  <div class="word">SWEET</div>
                  <div class="word">FAST</div>
                </div>
              </div>
              <h4>Create and manage events</h4>
            </div>       
              <div class="actions">        
                <a  class="create-btn btn btn-large"  href="<?php echo $router->generate('create'); ?>" >Create Event</a>  
                <div class="search">
                  <form class="searchform" role="form" action="search" method="post" data-parsley-validate="">
                    <div class="input-group  input-group-lg">
                      <input type="text" class="form-control" id="search" name="q" data-parsley-group="block1" placeholder="Search"> 
                     </div>
                     <div class="input-group  input-group-lg">
                      <select class="form-control" id="p" name="p" data-parsley-group="block2">
                        <option value="" >Select a quick search option</option>
                        <option value="vendor" >Vendors</option>
                        <option value="planner">Planners</option>
                        <!-- <option value="event">Events</option> -->
                      </select>                     
                      </div> 
                       <div class="error"></div>             
                      <span class="input-group-btn ">
                        <button type="submit"  class="search-btn btn btn-default btn-lg">Search</button>
                      </span>                   
                  </form>
                 </div> 
              </div>              
          </div>
        </div>
      
   </article>
</section>
<section>
  <div class="extra-info-header">
    <div class="extra-info">
      OYINSPIRE.ME IS THE QUICKEST WAY TO PLAN AN EVENT.
      <br>
      WE CONECT YOU TO THE BEST VENDORS
    </div>
  </div>
</section>

<section class="overlay"></section>

 <div class="services-menu-con">
    <div class="text-centered" style="color:#000">Browse through vendors
      <span class="close_button" style=""></span>
    </div>
    <div class="services-list">    
      <div class="cell">
        <a href="search?s=cake&p=vendor">          
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/cake.jpg');">
              <div class="name">Cake</div>
            </div>            
          </div>
        </a>
       <a href="search?s=decoration&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/decoration.jpg');">
              <div class="name">Decoration</div>
            </div>  
          </div>
        </a><a href="search?s=designers&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/designers.jpg');">
              <div class="name">Designers</div>
            </div>
            
          </div>
        </a><a href="search?s=hair&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/hair.jpg');">
              <div class="name">Hair and Makeup</div>
            </div>            
          </div>
        </a>
      </div>
     <div class="cell">
        <a href="search?s=video&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/video.jpg');">
              <div class="name">Video</div>
            </div>            
          </div>
        </a>
       <a href="search?s=security&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/security.jpg');">
              <div class="name">Security</div>
            </div>            
          </div>
        </a>
        <a href="search?s=souveniers&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/souveniers.jpg');">
              <div class="name">Souveniers</div>
            </div>            
          </div>
        </a>
         <a href="search?s=ushers&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/ushers.jpg');">
              <div class="name">Ushers</div>
            </div>
          </div>
        </a>
      </div>
      <div class="cell">       
       <a href="search?s=photography&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/photography.jpg');">
              <div class="name">Photography</div>
            </div>            
          </div>
        </a>
        <a href="search?s=invites&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/invites.jpg');">
              <div class="name">Invites</div>
            </div>            
          </div>
        </a>
        <a href="search?s=drinks&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/drinks.jpg');">
              <div class="name">Drinks</div>
            </div>            
          </div>
        </a>
         <a href="search?s=fabrics&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/fabrics.jpg');">
              <div class="name">Fabrics and Wears</div>
            </div>            
          </div>
        </a>
      </div>
      <div class="cell">       
       <a href="search?s=cars&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/cars.jpg');">
              <div class="name">Car</div>
            </div>            
          </div>
        </a>
        <!-- <a href="search?s=cake&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/party1.jpg');">
              <div class="name">Cake</div>
            </div>            
          </div>
        </a>
        <a href="search?s=cake&p=vendor">
          <div class="service">
            <div class="service-image" style="background-image: url('/oyinspire/assets/img/party1.jpg');">
              <div class="name">Cake</div>
            </div>
          </div>
        </a> -->
      </div>
      </div>
    </div>
    
</div>
<?php require 'footer.php'; ?> 
 <?php require 'modal.php'; ?>


 <div class="page-loader"></div>

 
</body>


</html>
