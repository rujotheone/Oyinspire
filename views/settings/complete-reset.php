<?php
require_once('require.php');

if (!session_start())
  session_start();
       $msg='';
       $dash="";

       $ref= $_SESSION['ref'];
      $key=$_POST['key'];
      $password=$_POST['password'];
      $repeatpassword=$_POST['repeatpassword'];
      $auth = initialize();

      
 if (isLoggedIn())
  {
        header('Location: '.$router->generate('home'));      
  }     

   if ($_SERVER['REQUEST_METHOD']=='POST')
    {
      $return = $auth->resetPass($key, $password, $repeatpassword,NULL);

       if ($return['error'] == 0 )
      { 
        
         header('Location:'.$router->generate('login'));
      }
      else
      {
        $msg=$return['message'];
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
  <title> Complete Reset | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/loginpage.css">
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/parsley.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/parsley.min.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>

  </head>
<html>
<body class="not-home">

   <?php require __DIR__.'\..\header.php'; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <h3 class="text-centered">Enter the key</h3>        

      	<form class="set" action="complete-reset" method="post">      
            <input type="hidden" id="ref" name="ref" value="<?php echo $_SERVER['REQUEST_URI'];?>">

            <div class="form-group">        
               <input type="text" class="form-control" id="password" name="password" data-parsley-length="[6, 150]" required="" placeholder="Enter password">
            </div> 
            <div class="form-group">        
               <input type="text" class="form-control" id="repeatpassword" name="repeatpassword" data-parsley-length="[6, 150]" required="" placeholder="Repeat Password">
            </div> 
            <div class="form-group">        
               <input type="text" class="form-control" id="key" name="key" placeholder="Enter key">
            </div>            

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg">Submit</button>
            </div>
             
        </form>
      </div> 
    </div>
  </div>

 <?php require __DIR__.'\..\footer.php'; ?>
 <?php require __DIR__.'\..\modal.php'; ?>

 <script type="text/javascript">

    $(function(){
        $('.set').parsley().on('field:validate', function(formInstance) {

           var ok = formInstance.isValid({force:true});
          $('.error')
              .html(ok ? '' : 'Please fill all required fields')
              .toggleClass('hidden', ok);

               if (!ok)
              formInstance.validationResult = false;
        })
        
      });
</script>


</body>
</html>

