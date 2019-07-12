<?php
 if (!session_start())
  session_start();

  $_SESSION['ref']=$_SERVER['REQUEST_URI']; 
  $msg="";
  $thisuser="";
   $username = $match['params']['user'];
   $page=1;
   $begin=($page*10)-10;


  $user=getVendorProfile($username);  
  $event=getEvents($user['id'],$page,true);
  //$isavendor=isAVendor($username,$user['user_id']);
  $user==false?$isavendor=false:$isavendor=true;
  $gallery=explode(';',$user['gallery']);


 if  (isLoggedIn())
   {
         $_SESSION['expiretime']=time();
        $thisuser=getVendorProfile($_SESSION['username']);
        $thisuserimage=$thisuser['vendor_logo'];
        if (!isset($thisuserimage))
        {
            $t=getCustomerProfile($_SESSION['username']);
            $thisuserimage=$t['profile_image'];
        }

      if($username==$_SESSION['username'] && $isavendor==true)
         {
          //header('Location: '.$user['name']);
         }
        $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$thisuserimage.'">         
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
  <title> Vendor profile | Create Events and Search for vendors | oyinspire.me</title>
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
    <script type="text/javascript">

      $(document).ready(function(){

          $('.info').click(function(event){
            event.preventDefault();
            $('.nav.nav-tabs li').toggleClass('active');
            var info = $(this).data('info');
            if (info=="overview")
            {
                //$(this).load(url,postdata,function(data,status){});
                $('.user-info .vdata').toggle();
              
            }
            if (info=="gallery")
            {
              $('.user-info .vdata').toggle();
            }
          })

      })

    </script>
    
</head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?> 


  <div class="sub-header navbar navbar-default">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="vendor-profile text-centered">
        <div class="profile-pic"><img height="200" width="200" src="<?php echo $user['vendor_logo']; ?>"></div>
        <div class="vendor-profile-o">
          <h3 class="text-main-heading"><?php echo ucfirst($user['name']);?></h3>
          <div class="vendor-services">
                <p><a class="vendor_services" data-id="<?php echo $user['id']; ?>" href="#">View vendor services</a></p>
          </div>
           <h3 class="ratings" data-rate="<?php echo $user['ratings'];?>"> </h3> 
           <div class="ratebox text-left"> 
              <p id="rate" class="rate btn btn-sm">Rate</p>
              <ul class="list-inline">
                <li><a class="rate-btn" data-id="<?php echo $user['id']; ?>" data-type="vendors" data-val="1" href="">*</a></li>
                <li><a class="rate-btn" data-id="<?php echo $user['id']; ?>" data-type="vendors" data-val="2" href="">*</a></li>
                <li><a class="rate-btn" data-id="<?php echo $user['id']; ?>" data-type="vendors" data-val="3" href="">*</a></li>
                <li><a class="rate-btn" data-id="<?php echo $user['id']; ?>" data-type="vendors" data-val="4" href="">*</a></li>
                <li><a class="rate-btn" data-id="<?php echo $user['id']; ?>" data-type="vendors" data-val="5" href="">*</a></li>
              </ul> 
          </div>         
        </div>
        <div class="address-o">         
          <h5 class="contacts"> <?php echo $user['address'] ;?>  <?php echo $user['address2'] ;?></h5>
          <h5 class="contacts"> <?php echo $user['phone_number'] ;?></h5>
          <h5 class="contacts"> <?php echo $user['website'] ;?> </h5>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="container">
    <div class="row">

  <?php if (isLoggedIn() ) {  ?>
        
        <?php if (($isavendor==true) && ($thisuser['name']==$user['name'])) {  ?>
         
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="side-nav">
          <h3 class="side-nav-header text-centered">Settings</h3>
             <ul class="list-group">
              <li class="list-group-item"><a href="<?php echo $router->generate('vendoredit'); ?>">Edit</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('password'); ?>">Password</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('close-account'); ?>">Close Account</a></li>
            </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="vendor-tabs">
              <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a class="info" data-info="overview" href="">Overview</a></li>
                <li role="presentation" ><a class="" data-info="gallery" href="<?php echo $router->generate('vendorphotos'); ?>">Photos</a></li>
              </ul>
            </div> 


         <div class="user-info">
         <h3 class="text-left vdata" id="events">Your Events</h3>
        <div class="search-results vdata">
          <?php for ($i=0;$i<sizeof($event);$i++) { ?>
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
                      <h4 class="etitle"><a href=""><?php echo ucfirst($event[$i]['name']);?></a></h4>
                    </div>

                    <div class="evenue">
                      <div><b><?php echo $event[$i]['venue'];?></b></div>
                      <div><?php echo $event[$i]['address'];?> </div>
                      <div><?php echo $event[$i]['address2'];?></div>
                      <div><?php echo $event[$i]['state'];?></div>
                    </div>

                    <div class="edate text-centered">
                      <time><b>Starts:</b> <?php echo  date('g:iA d-m-Y',strtotime($event[$i]['starts']));  ?></time>
                      <span> - </span>
                      <time><b>Ends:</b> <?php echo date('g:iA d-m-Y',strtotime($event[$i]['ends']));?></time>
                    </div>

                    <!-- <div class="evendors text-centered">
                      <a href="">View other vendors who handled event</a>
                    </div>  -->              
            </div>
          <?php }  ?>
          <nav class="col-md-12">
            <ul class="pager">
              <li><a aria-label="Previous" href="<?php echo $router->generate('vendors').$_SESSION['username'].'?page='.($page==1?1:$page-1);?>">Previous</a></li>
              <li><a aria-label="Next" href="<?php echo $router->generate('vendors').$_SESSION['username'].'?page='.($page+1);?>">Next</a></li>
            </ul>
         </nav>
        </div>

                   
        </div>
       </div>

      </div>
    </div></div>

  <?php } else if (($isavendor==true) && !($thisuser['name']==$user['name'])) {  ?>
        
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="vendor-tabs">
              <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a class="info" data-info="overview" href="">Overview</a></li>
                <li role="presentation" ><a class="info" data-info="gallery" href="">Photos</a></li>
              </ul>
            </div> 

      
         <div class="user-info">
         <h3 class="text-left vdata" id="events">Events covered</h3>
          <div class="search-results vdata">

          <?php for ($i=$begin;$i<sizeof($event);$i++) {?>

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
                      <h4 class="etitle"><a href=""><?php echo ucfirst($event[$i]['name']);?></a></h4>
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

                    <div class="evendors text-centered">
                      <a href="">View Vendors who handled event</a>
                    </div>               
            </div>
          <?php }  ?>

          <nav class="col-md-12">
            <ul class="pager">
              <li><a aria-label="Previous" href="<?php echo $router->generate('vendors').$_SESSION['username'].'?page='.($page==1?1:$page-1);?>">Previous</a></li>
              <li><a aria-label="Next" href="<?php echo $router->generate('vendors').$_SESSION['username'].'?page='.($page+1);?>">Next</a></li>
            </ul>
         </nav>
        </div>
           
           <div class="vdata" style="display:none">
             
             <div class="gallery-con">
                <?php  for($i=0;$i<sizeof($gallery);$i++)  
                  {
                    echo '<div class="gallery-pic"><img height="" width="" src="'.$gallery[$i].'"></div>';
                    }
                ?>
             </div>
           </div>

        </div>



       </div>
       </div> </div>


      <?php } else {  ?>

        <div class="col-md-12"><h1 class="text-center">Vendor not found</h1></div></div> </div>

      <?php }?>      

 <?php } else {  ?>

        <?php if ($isavendor==true) {?>
        
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="vendor-tabs">
              <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a class="info" data-info="overview" href="">Overview</a></li>
                <li role="presentation" ><a class="info" data-info="gallery" href="">Photos</a></li>
              </ul>
            </div> 

      
         <div class="user-info">
         <h3 class="text-left vdata" id="events">Events covered</h3>
        <div class="search-results vdata">

          <?php for ($i=$begin;$i<sizeof($event);$i++) {?>

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
                      <h4 class="etitle"><a href=""><?php echo ucfirst($event[$i]['name']);?></a></h4>
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

                    <div class="evendors text-centered">
                      <a href="">View Vendors who handled event</a>
                    </div>               
            </div>
          <?php }  ?>

          <nav class="col-md-12">
            <ul class="pager">
              <li><a aria-label="Previous" href="<?php echo $router->generate('vendors').$_SESSION['username'].'?page='.($page==1?1:$page-1);?>">Previous</a></li>
              <li><a aria-label="Next" href="<?php echo $router->generate('vendors').$_SESSION['username'].'?page='.($page+1);?>">Next</a></li>
            </ul>
         </nav>
        </div>

        <div class="vdata" style="display:none">
             
             <div class="gallery-con">
                <?php  for($i=0;$i<sizeof($gallery);$i++)  
                  {
                    echo '<div class="gallery-pic"><img height="" width="" src="'.$gallery[$i].'"></div>';
                    }
                ?>
             </div>
           </div>
           
        </div>
       </div>
       </div> </div>

       <?php } else{ ?>
       
        <div class="col-md-12"><h1 class="text-center">Vendor not found</h1></div></div> </div>

    <?php }?>

    <?php } require __DIR__.'\..\footer.php';  require __DIR__.'\..\modal.php'; ?>

</body>
</html>