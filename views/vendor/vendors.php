<?php
if (!session_start())
  session_start();

$_SESSION['ref']=$_SERVER['REQUEST_URI'];
$page=1;
$begin=($page*10)-10;
$msg="";

//p=*&s=*&page=*&q=*

if  (isLoggedIn())
   {
       $_SESSION['expiretime']=time();
      $user=getCustomerProfile($_SESSION['username']);
      $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'";>         
        </a>';
   }
   else
   {
      $dash='<a  data-action='.'"login"'.'class='.'"modalbtn"'.'href='.'"login"'.'>Login</a>'." 
      ".'<a data-action='.'"signup"'.'class='.'"modalbtn tablet"'.' href='.'"signup"'.'>Sign up</a>';
    }


if(isset($_REQUEST['page']))
  $page=$_REQUEST['page'];
if(isset($_REQUEST['p']))
  $prof=$_REQUEST['p'];
if(isset($_REQUEST['s']))
  $service=$_REQUEST['s'];
if(isset($_REQUEST['q']))
  $query=$_REQUEST['q'];  

echo d($query);


//$service=$match['params']['service'];
//if ($prof=="vendor")
//$vendors=getVendors(1,$page);
//else if($prof=="planner")
//$planners=getPlanners();
//else if($prof=="event")
//$events=getEvents();
//else
 // $search=searchDB();




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
  <title> Vendors | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/vendorpage.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>
    
    <script type="text/javascript">
          $(document).ready(
            function(){
              $('.filter-group').click(function(){
                $(this).find('.filter-subheader').toggle('1000');
              });
          });
    </script>
    <script type="text/javascript">
      function changePops()
      { 
        //var name = window.opener.getWindowName();
        var data=document.getElementById('vendorname');
        window.opener.document.getElementsByTagName('input')[name].value = data.innerHTML;
        window.opener.document.getElementsByTagName('input')[name].setAttribute('data-vendor',data.getAttribute('data-vendor'));
        window.close();
        //return false;

      }
   

    </script>
  </head>

<body class="not-home">

   <?php require __DIR__.'\..\header.php'; ?> 
  
        
  <h3 class="heading">Search Results</h3>

  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="side-nav">
          <h3 class="side-nav-header text-centered">Filters</h3>
            <div class="filter-group">
              <h3 class="filter-header text-left">Service</h3>
              <ul class="filter-subheader">
                <li>Cake</li>
                <li>Cake</li>
              </ul>
            </div>             
         
          <div class="filter-group">
              <h3 class="filter-header text-left">Location</h3>
              <ul class="filter-subheader">
                <li>Lagos</li>                
              </ul>
          </div>             
        </div>
      </div>
    
      <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
        <div class="search-results">
          <h5>Showing items</h5>
      <?php for ($i=$begin;$i<sizeof($event);$i++) {?>
            <div class="search-item">

              <div class="col-md-3">
                <div class="vlogo">
                <a href=""><img width="100" height="100" src=""></a>
                </div>
              </div>

              <div class="col-md-9">
               <div class="vratings">ratings
                  <p>please rate</p>
                  <ul class="list-inline">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                  </ul>
                </div>
                
                <div class="">
                <h4 class="vtitle">
                  <a data-vendor="<?php echo $vendors[0]['id']?>" id="vendorname" 
                    onclick="javascript:changePops('xx')" ><?php echo ucfirst($vendors[0]['name']);?></a></h4>
                </div>

                <div class="vcontact">
                <span>contact </span>
                </div>

                <div class="vservices">
                <p>services</p>
                </div>

                <div class="vsummary">
                  <a href="">reviews</a>
                </div>               
              </div>
            </div>
             <?php }  ?>
        </div>

        <nav class="col-md-12">
          <!-- <ul class="pagination">
            <li>
              <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
              <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul> -->
       

        
            <ul class="pager">
              <li><a aria-label="Previous" href="<?php echo $router->generate('search').'?page='.($page==1?1:$page-1); ?>">Previous</a></li>
              <li><a aria-label="Next" href="<?php echo $router->generate('search').'?page='.($page+1);?>">Next</a></li>
            </ul>
         </nav>
      </div>


    
  </div>
</div>

<!--  <div style="z-index:2000;position:absolute;top:500px"><?php d($vendors);?></div>
 -->  
  
  <?php require __DIR__.'\..\footer.php'; ?> 
  <?php require __DIR__.'\..\modal.php'; ?> 


</body>
</html>