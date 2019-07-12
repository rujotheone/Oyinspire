<?php
  if (!session_start())
  session_start();
  $_SESSION['ref']=$_SERVER['REQUEST_URI']; 
  $msg="";
  // $thisuser="";
  // $username = $match['params']['user'];
  $page=1;
  $begin=($page*10)-10;


  $user=getVendorProfile($_SESSION['username']);  
//$isavendor=isAVendor($username,$user['user_id']);
  $user==false?$isavendor=false:$isavendor=true;
  $gallery=explode(';',$user['gallery']);


 if  (isLoggedIn() && $isavendor==true)
   {
        
        $_SESSION['expiretime']=time();
        $dash='<a onclick="javascript:accountMenu()">
               <img class="dp" height="30" width="30" src="'.$user['vendor_logo'].'">         
       			</a>';

   }
   else
   {
     $dash='<a  data-action='.'"login"'.' class='.'"modalbtn"'.' href='.'"login"'.'>Login</a>'." 
           ".'<a data-action='.'"signup"'.' class='.'"modalbtn tablet"'.' href='.'"signup"'.'>Sign up</a>';
           //header('Location: ');
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
  <title> Gallery | Create Events and Search for vendors | oyinspire.me</title>
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
   <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/vphoto.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>
    <script type="text/javascript">

      $(document).ready(function(){

      		function readURL(e) {
				    if (this.files && this.files[0]) {
				        var reader = new FileReader();
				        var n=($('.gallery-pic').length)+1;
				        console.log(n);
				        $('.gallery-con').prepend
				        ('<div class="gallery-pic"><img id="img-preview'+n+'" height="" width="" src=""></div>');
				        $('form').append
				        ('<div class="form-group"><button type="submit" class="btn btn-lg">Upload</button></div>');

				        $(reader).load(function(e) { $('#img-preview'+n).attr('src', e.target.result); });
				        reader.readAsDataURL(this.files[0]);
				    }}

				$(".upload").change(readURL);
         

      })

    </script>
    
</head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?> 

  	<h3 class="heading"><div class="text-centered"><?php echo $user['name']; ?> - Gallery</div></h3>

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >

			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	            <div class="vendor-tabs">
	              <ul class="nav nav-tabs">
	                <li role="presentation" ><a class="info" data-info="overview" href="<?php echo $router->generate('vendors').$_SESSION['username']?>">Overview</a></li>
	                <li role="presentation" class="active"><a class="info" data-info="gallery" href="">Photos</a></li>
	              </ul>
	            </div> 
			</div>

				<div  class="fileUpload btn">					
	               <b>Add</b>
	               <form>
	               <input type="file" class="upload">
	               </form>
				</div>
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



 <?php  require __DIR__.'\..\footer.php';  require __DIR__.'\..\modal.php'; ?>



</body>
</html>