<?php
 
 session_start();
$_SESSION['ref']=$_SERVER['REQUEST_URI']; 
 $username = $match['params']['user'];
 //$auth=initialize();
 if(!isset($_REQUEST['page']))
 $page=1;
else
  $page=$_REQUEST['page'];

 $begin=($page*10)-10;
 

 if  (isLoggedIn())
   {
       $_SESSION['expiretime']=time();
      $user=getCustomerProfile($username);
      $thisuser=getCustomerProfile($_SESSION['username']);
      $event=getEvents($thisuser['id'],$page);
      $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$thisuser['profile_image'].'";>         
        </a>';

   }
   else
   {
     $dash='<a  data-action='.'"login"'.' class='.'"modalbtn"'.' href='.'"login"'.'>Login</a>'." 
      ".'<a data-action='.'"signup"'.' class='.'"modalbtn tablet"'.' href='.'"signup"'.'>Sign up</a>';
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
  <title> Profile | Create Events and Search for vendors | oyinspire.me</title>
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
   <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/profilepage.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>
</head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?> 


  <div class="sub-header navbar navbar-default">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="user-profile text-centered">
        <div class="profile-pic"><img height="100" width="100" src="<?php echo $user['profile_image']; ?>"></div>
        <h3 class="text-main-heading"><?php echo ucfirst($username);?></h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">

      <?php if (isLoggedIn() && isUser($_SESSION['username'],$username)) { ?>
        

      <div class="col-lg-3 col-md-3 col-sm-9 col-xs-12">
        <div class="side-nav">
          <h3 class="side-nav-header text-centered">Settings</h3>
             <ul class="list-group">
              <li class="list-group-item"><a href="<?php echo $router->generate('edit'); ?>">Edit</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('password'); ?>">Password</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('close-account'); ?>">Close Account</a></li>
            </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
         <div class="user-info">
         <h3 class="text-left" id="events">Your Events</h3>
        <div class="search-results">
          <?php for ($i=0;$i<sizeof($event);$i++) {?>
            <div class="search-item">

                  <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                    <div class="elogo">
                    <a href=""><img height="100" width="100"  src=""></a>
                    </div>
                  </div>

                 <!--  <div class="col-md-9">
                   <div class="eratings">ratings
                      <p>please rate</p>
                      <ul class="list-inline">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                      </ul>
                    </div> -->
                    
                    <div class="" >
                      <h4 class="etitle"><a href=""><?php echo $event[$i]['name'];?></a></h4>
                    </div>

                    <div class="evenue">
                      <div><?php echo $event[$i]['venue'];?> </div>
                      <div><?php echo $event[$i]['address'];?> </div>
                      <div><?php echo $event[$i]['address2'];?></div>
                      <div><?php echo $event[$i]['state'];?></div>
                    </div>

                    <div class="edate text-centered">
                      <time><b>Starts:</b> <?php echo  date('g:iA d-m-Y',strtotime($event[$i]['starts']));  ?></time>
                      <span> - </span>
                      <time><b>Ends:</b> <?php echo date('g:iA d-m-Y',strtotime($event[$i]['ends']));?></time>
                    </div>

                   <!--  <div class="evendors text-centered">
                      <a href="">View Vendors who handled event</a>
                    </div>  -->              
            </div>
          <?php }  ?>
          <nav class="col-md-12">
            <ul class="pager">
              <li><a aria-label="Previous" href="<?php echo $router->generate('profile').$_SESSION['username'].'?page='.($page==1?1:$page-1);?>">Previous</a></li>
              <li><a aria-label="Next" href="<?php echo $router->generate('profile').$_SESSION['username'].'?page='.($page+1);?>">Next</a></li>
            </ul>
         </nav>
        </div>
           
        </div>
       </div>        
      </div>
    </div>
  </div>
   <?php } else { ?>

         <div class="col-md-12"><h1 class="text-center">This user is private</h1></div></div> </div>
 
    <?php } require __DIR__.'\..\footer.php';  require __DIR__.'\..\modal.php'; ?>

</body>
</html>