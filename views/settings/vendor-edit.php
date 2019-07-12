<?php
 require 'require.php';
 if (!session_start())
  session_start();

 $_SESSION['ref']=$_SERVER['REQUEST_URI']; 
 $user=getVendorProfile($_SESSION['username']);
  $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['vendor_logo'].'";>         
        </a>';

  
  $isavendor=isAVendor($_SESSION['username'],$user['user_id']);


   if (!isLoggedIn())
   	{
      header('Location: '.$router->generate('login'));
    }
    else if ($_SERVER['REQUEST_METHOD']=='POST')
    {
      $_POST['image'] = uploadImage($_FILES['image'],$_SESSION['username']);
      if (updateVendorProfile($_POST,$_SESSION['username'])===true)
        { 
          $user=getVendorProfile($_SESSION['username']);
          $msg="Successful";
        }
        else
        {
          $msg="Please fill all required fields";
        }
    }
     else
     {
        if($isavendor==false)
        {
          header('Location: '.$router->generate('edit'));
        }
         $_SESSION['expiretime']=time();
        $msg="";
        $user=getVendorProfile($_SESSION['username']);
        
    
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
  <title> Edit | Create Events and Search for vendors | oyinspire.me</title>
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
              <li class="list-group-item"><a href="<?php echo $router->generate('vendoredit'); ?>">Edit</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('password'); ?>">Password</a></li>
              <li class="list-group-item"><a href="<?php echo $router->generate('close-account'); ?>">Close Account</a></li>            
            </ul>
        </div>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
         <h3 class="text-left">Update your account Information</h3>
        <form class="updateform" action="" method="post" enctype="multipart/form-data" data-parsley-validate="">

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <label for="image">Logo</label>
            <div class="image-preview">
              <img id="img-preview" height="200" width="200" src="<?php echo $user['vendor_logo']; ?>">
             </div>
              <div class="form-group btn btn-primary">                 
                <label for="image">Select</label>                 
                <input type="file" class="form-control" id="image" name="image" placeholder="upload image">
            </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="Name">Name*</label>
            <input type="text" class="form-control" id="name" value="<?php echo ucfirst($user['name']);?>" name="name" required="" placeholder="Enter Name">
          </div>
          </div>       

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <h3>Address</h3>
          <div class="form-group">        
            <label for="address">Address*</label>
             <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']?>" required="" placeholder="Enter Address">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="Address2">Address2</label>
             <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $user['address2']?>" placeholder="Enter address">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="state">State*</label>
            <select class="form-control" id="state" name="state" required="">
                        <option value="0" >Select State</option>
                                                    
                            <option value="1">Abia</option>
                                                    
                            <option value="2">Adamawa</option>
                                                    
                            <option value="3">Akwa Ibom</option>
                                                    
                            <option value="4">Anambra </option>
                                                    
                            <option value="5">Bauchi</option>
                                                    
                            <option value="6">Bayelsa </option>
                                                    
                            <option value="7">Benue</option>
                                                    
                            <option value="8">Borno</option>
                                                    
                            <option value="9">Cross River  </option>
                                                    
                            <option value="10">Delta </option>
                                                    
                            <option value="11">Ebonyi </option>
                                                    
                            <option value="12">Edo</option>
                                                    
                            <option value="13">Ekiti</option>
                                                    
                            <option value="14">Enugu  </option>
                                                    
                            <option value="15">FCT</option>
                                                    
                            <option value="16">Gombe </option>
                                                    
                            <option value="17">Imo</option>
                                                    
                            <option value="18">Jigawa</option>
                                                    
                            <option value="19">Kaduna</option>
                                                    
                            <option value="20">Kano</option>
                                                    
                            <option value="21">katsina</option>
                                                    
                            <option value="22">Kebbi</option>
                                                    
                            <option value="23">Kogi</option>
                                                    
                            <option value="24">Kwara</option>
                                                    
                            <option value="25" selected="selected">Lagos</option>
                                                    
                            <option value="26">Nasarawa</option>
                                                    
                            <option value="27">Niger</option>
                                                    
                            <option value="28">Ogun </option>
                                                    
                            <option value="29">Ondo</option>
                                                    
                            <option value="30">Osun</option>
                                                    
                            <option value="31">Oyo</option>
                                                    
                            <option value="32">Plateau</option>
                                                    
                            <option value="33">Rivers</option>
                                                    
                            <option value="34">Sokoto</option>
                                                    
                            <option value="35">Taraba   </option>
                                                    
                            <option value="36">Yobe</option>
                                                    
                            <option value="37">Zamfara  </option>
            </select>
          </div>
          </div>

          <!-- <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="lga">L.G.A</label>
             <input type="text" class="form-control" id="lga" name="lga"  placeholder="Enter lga">
          </div>
          </div> -->
          <br/>          

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="phone">Phone number*</label>
             <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone_number']?>" required="" placeholder="Enter phone">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="phone">Website</label>
             <input type="text" class="form-control" id="website" name="website" value="<?php echo $user['website']?>" placeholder="Enter your website address">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
          </div>

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
           <div class="form-group">
            <button type="submit" class="btn btn-lg">Update</button>
           </div>
         </div>

        </form>
      </div>
    </div>
  </div>

<?php require __DIR__.'\..\footer.php'; ?>

 <script type="text/javascript">

    $(function(){
        $('.updateform').parsley().on('field:validate', function(formInstance) {

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