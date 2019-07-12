<?php
 require 'require.php';
 session_start();
  $_SESSION['ref']=$_SERVER['REQUEST_URI'];  
  $auth = initialize(); 
  $user=getCustomerProfile($_SESSION['username']);
  $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'";>         
        </a>';



    if (!isLoggedIn())
      {
        header('Location:'.$router->generate('login'));
      }
    else if ($_SERVER['REQUEST_METHOD']=='POST')
    {

      $return=$auth->changePassword($user['user_id'], $_POST['opassword'], $_POST['npassword'], $_POST['confirmnpassword']);
      
      if ($return['error']==0)
        { 
          
          $msg=$return['message'];
          //header('Location: '.$router->generate('home'));
        }
        else
        {
          $msg="Please fill all required fields";
        }
    }
     else
     {       
        $msg="";
        $_SESSION['expiretime']=time();
              

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
  <title> Password | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/editpage.css">
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/parsley.css">


    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/parsley.min.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>
 </head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?>


  <div class="sub-header navbar navbar-default">
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <h3 class="text-main-heading">Account</h3>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="side-nav">
          <h3 class="side-nav-header text-centered">Settings</h3>
             <ul class="list-group">
              <li class="list-group-item"><a href="<?php echo $router->generate('edit'); ?>">Edit</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('password'); ?>">Password</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('close-account'); ?>">Close Account</a></li>              
            </ul>
        </div>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
         <h3 class="text-left">Change Password</h3>
        <form class="set" action="" method="post" data-parsley-validate="">

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="Username">Username</label>
            <input type="text" class="form-control" id="username" name="username" data-parsley-length="[4, 20]" required="" value="<?php echo $_SESSION['username']?>" >
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="OldPassword">Old Password</label>
            <input type="password" class="form-control" id="opassword" name="opassword" data-parsley-length="[6, 150]" required="" placeholder="Enter current password">
          </div>
          </div>  

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="NewPassword">New Password</label>
            <input type="password" class="form-control" id="npassword" name="npassword" data-parsley-length="[6, 150]" required="" placeholder="Enter new password">
          </div>
          </div>  

             <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="ConfirmNewPassword">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmnpassword" name="confirmnpassword" data-parsley-length="[6, 150]" required="" placeholder="Confirm new password">
          </div>
          </div> 

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
            </div>

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
           <div class="form-group">
            <button type="submit" class="btn btn-lg">Change</button>
           </div>
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