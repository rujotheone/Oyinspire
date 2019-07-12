<?php
if (!session_start())
  session_start();

$_SESSION['ref']=$_SERVER['REQUEST_URI'];
$page=1;
$begin=($page*10)-10;
$msg="";
$service=NULL;
$location=1;
$result=NULL;


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
if(isset($_POST['q']))
  $query=$_POST['q'];  

if($_SERVER['REQUEST_METHOD']=='GET')
{
  if ($prof=="vendor")
  {
    if ($service=="all")
      $service=NULL;
  $vendors=getVendors($location,$page,$service);
  $result=$vendors;
  $result['type']='vendors';

  }
  else if($prof=="planner")
  {
  $planners=getPlanners("all",$location,$page);
  $result=$planners;
  $result['type']='planners';

  }

  else if($prof=="event")
  {
  $events=getEvents();
  $result=$events;
  $result['type']='events';
  }
}
else if ($_SERVER['REQUEST_METHOD']=='POST')
{
  
 $search=searchDB($query,$page);
 $result=$search;
//$result['type']='query';
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
  <title> Search Results | Create Events and Search for vendors | oyinspire.me</title>
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
          
          var vendors=document.getElementsByClassName('vendorname');
          for(var i=0;i<vendors.length;i++)
          {
            vendors[i].addEventListener('click',changePops,false);
          }
          
                
    });
        function changePops()
        { 
          var name=window.name;
          var hInputs=window.opener.document.getElementsByClassName('addbtn');
          var vInputs=window.opener.document.getElementsByClassName('inputs '+ name);

          var inp=document.createElement('input')
          inp.type="hidden";
          inp.name=name+'[]';
          //name+(hInputs[name].childNodes.length);
          inp.setAttribute('value',this.getAttribute('data-vendor')+';'+this.innerHTML);

          var div=document.createElement('div');
          div.className="result";
          div.innerHTML = this.innerHTML;
          div.title="remove this vendor";

           for(var i=0;i<hInputs.length;i++)
          {
            hInputs[name].appendChild(inp);
             vInputs[0].appendChild(div);
            
          }
         
          //window.opener.document.getElementsByTagName('input')[name].setAttribute('data-vendor',name.getAttribute('data-vendor'));
          window.close();
          //return false;

        }
   

    </script>
  </head>

<body class="not-home">

<?php  require 'header.php'; ?>
  
        
  <h3 class="heading">Search Results</h3>

  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="side-nav">
          <h3 class="side-nav-header text-centered">Filters</h3>
            <div class="filter-group">
              <h3 class="filter-header text-left">Service<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></h3>

              <ul class="filter-subheader">
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=cake">Cake</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=decorations">Decoration</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=designers">Designers</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=hair">Hair and Makeup</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=video">Video</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=security">Security</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=souveniers">Souveniers</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=ushers">Ushers</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=photography">Photographers</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=invites">invites</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=drinks">Drinks</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=fabrics">Fabrics</a></li>
                <li><a href="?p=<?php if (isset($prof))echo$prof;else echo 'vendor'; ?>&s=car">Car rentals</a></li>
              </ul>
            </div>             
         
          <div class="filter-group">
              <h3 class="filter-header text-left">Location<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></h3>
              <ul class="filter-subheader">
                <li><a href="#">Lagos</a></li>               
              </ul>
          </div>             
        </div>
      </div>
    
      <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
        <div class="search-results">
          <h5>Showing items</h5>
          <b><?php if($result==NULL) echo "Sorry we do not have any results"; ?></b>
      <?php for ($i=0;$i<sizeof($result)-1;$i++) {  ?>
      
            <div class="search-item">

              <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="vlogo">
                <a href=""><img width="100" height="100" src="<?php echo $result[$i]['vendor_logo']; ?>"></a>
                </div>
              </div>

              <div class="col-md-9 col-lg-9 col-sm-9">
               <div class="vratings">
                <p class="ratings" data-rate="<?php echo $result[$i]['ratings'];?>"> </p>
                  <p id="rate" class="rate btn btn-sm">Rate</p>
                  <ul class="list-inline">
                    <li><a class="rate-btn" data-id="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" data-type="<?php echo $result['type'];?>" data-val="1" href="">*</a></li>
                    <li><a class="rate-btn" data-id="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" data-type="<?php echo $result['type'];?>" data-val="2" href="">*</a></li>
                    <li><a class="rate-btn" data-id="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" data-type="<?php echo $result['type'];?>" data-val="3" href="">*</a></li>
                    <li><a class="rate-btn" data-id="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" data-type="<?php echo $result['type'];?>" data-val="4" href="">*</a></li>
                    <li><a class="rate-btn" data-id="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" data-type="<?php echo $result['type'];?>" data-val="5" href="">*</a></li>
                  </ul>
                </div>
                
                <div class="">
                <h4 class="vtitle">
                  <a data-vendor="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" class="vendorname" href="<?php echo $router->generate('vendors').$result[$i]['name']; ?>">
                    <?php echo ucfirst($result[$i]['name']);?>
                  </a>
                </h4>
                </div>

                <div class="vcontact">
                <div><?php echo ucfirst($result[$i]['address']);?>    
                <?php echo ucfirst($result[$i]['address2']);?></div>
                </div>

                <div class="vservices">
                <p><a class="vendor_services" data-id="<?php echo isset($service)?$result[$i]['vendor']:$result[$i]['id'];?>" href="#">View vendor services</a></p>
                </div>

               <!--  <div class="vsummary">
                  <a href="">reviews</a>
                </div> -->               
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
              <li>
                <a aria-label="Previous" href="<?php echo $router->generate('search').'?p='.$prof.'&page='.($page==1?1:$page-1); ?>">
                  Previous
                </a>
              </li>
              <li>
                <a aria-label="Next" href="<?php echo $router->generate('search').'?p='.$prof.'&page='.($page+1);?>">
                  Next
                </a>
              </li>
            </ul>
         </nav>
      </div>


    
  </div>
</div>

<!--  <div style="z-index:2000;position:absolute;top:500px"><?php d($vendors);?></div>
 -->  
  
<?php require 'footer.php'; ?>
<?php require 'modal.php'; ?>

</body>
</html>