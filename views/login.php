<?php
if (!session_start())
  session_start();

       $msg='';       
       $dash="";      
     
      $ref= $_SESSION['ref'];

      if (isLoggedIn())
      {
        header('Location:'.$ref.'');       

      }
      else if ($_SERVER['REQUEST_METHOD']=='POST')
      {
        $_POST['autologin']==="1"?$autologin=true:$autologin=false;
        $auth = initialize();
        $uid = $auth->getUIDFromUsername($_POST['username']);
        $email=$auth->getUser($uid)['email'];
        $_POST['autologin']=="1"?$autologin=1:$autologin=0;
        $return = $auth->login($email, $_POST['password'],$autologin);

        if ($return['error'] == 0 )
        { 
           Loggedin($email, $_POST['username'], $return['hash'], $return['expire']);
           header('Location:'.$ref.'');

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
  <title> Login | Create Events and Search for vendors | oyinspire.me</title>
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

<body class="not-home">

  <?php require 'header.php'; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <h3 class="text-centered">Please Login</h3>
        <p class="text-centered" ><a  href="signup" >Or, signup</a></p>

      	<form class="signform" action="login" method="post" data-parsley-validate="">

            <input type="hidden" id="nonce" name="nonce" value="">
            <input type="hidden" id="ref" name="ref" value="<?php echo $_SERVER['REQUEST_URI'];?>">

            <div class="form-group">        
              <label for="username">Username</label>
               <input type="text" class="form-control" id="username" name="username" data-parsley-length="[4, 20]" required="" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" data-parsley-length="[6, 150]" required="" placeholder="Enter password">
            </div>

            <input type="checkbox" name="autologin" value="1"> Remember me 
            <a class="navbar-right "href="">Forgot Password?</a>

            <div class="error"><?php echo $msg;?></div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg">Login</button>
            </div>
             
        </form>
      </div> 
    </div>
  </div>

<?php require 'footer.php'; ?>

<script type="text/javascript">

    $(function(){
        $('.signform').parsley().on('field:validate', function(formInstance) {

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

