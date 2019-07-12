<?php
 require 'require.php';
 if (!session_start())
  session_start(); 
  $msg="";  
  $username = $_SESSION['username'];
  $user=getCustomerProfile($_SESSION['username']);
  $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'";>         
        </a>';


  $isavendor=isAVendor($_SESSION['username'],$user['user_id']);

   if ($_SESSION['ref']!='/oyinspire/registration'  && !isLoggedIn() 
    && $_SESSION['ref']!='/oyinspire/vendor/registration' && $_SESSION['ref']!='/oyinspire/signup')
  {
    header('Location: '.$router->generate('signup'));
  }  

   else if ($_SERVER['REQUEST_METHOD']=='POST')
   {
      $_POST['image'] = uploadImage($_FILES['image'],$username);

      $_POST['service']=="all"?$services=range(1,13):$services=$_POST['service'];

     if (completeVendorProfile($_POST,$username,$services)===true)
      {
        header('Location: /oyinspire/vendor/profile');
      }
      else
      {
        $msg="Please fill all required fields";
      }
    }
    else if ($isavendor==true)
    {
     header('Location: '.$router->generate('vendoredit'));
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
  <title> Vendor Registration | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/registerpage.css">
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/parsley.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/parsley.min.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(
          function(){
                

            });
    </script>
 </head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?> 


<div class="container">
    <div class="row">

      <div class="usertype">
          <ul class="nav nav-tabs">
            <li role="presentation" ><a href="<?php echo $router->generate('Pregistration'); ?>">Customer</a></li>
            <li role="presentation" class="active"><a href="<?php echo $router->generate('PVregistration'); ?>">Vendor</a></li>
          </ul>
       </div> 
            
       <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
          </div>
          
               
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
         <h3 class="text-left">Details</h3>

        <form class="regform" action="" method="post" enctype="multipart/form-data" data-parsley-validate="">

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <label for="image">Vendor Logo</label>
            <div class="image-preview"> <img id="img-preview" height="200" width="200" src=""></div>
              <div class="form-group btn btn-primary">
                <label for="image">Select </label>
                <input type="file" class="form-control" id="image" name="image" placeholder="upload image">
            </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="Name">Name*</label>
            <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter Name">
          </div>
          </div>       

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <h3>Address</h3>
          <div class="form-group">        
            <label for="address">Address*</label>
             <input type="text" class="form-control" id="address" name="address"  required="" placeholder="Enter Address">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="Address2">Address2</label>
             <input type="text" class="form-control" id="address2" name="address2"  placeholder="Enter address">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="state">State*</label>
             <select class="form-control" id="state" name="state" required="">
                        <option value="0" selected="selected">Select State</option>
                                                    
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
                                                    
                            <option value="25">Lagos</option>
                                                    
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
             <input type="text" class="form-control" id="lga" name="lga" value="1" placeholder="Enter lga">
          </div>
          </div> -->
          <br/>          

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="phone">Phone number*</label>
             <input type="text" class="form-control" id="phone" name="phone" required="" placeholder="Enter phone">
          </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="form-group">        
            <label for="phone">Website</label>
             <input type="text" class="form-control" id="website" name="website" placeholder="Enter your website address">
          </div>
          </div>
          
          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="checkbox" id="addservice"> 
                  <label> 
                    <input type="checkbox" value="all" name="service"> Check this if you offer all services
                  </label> 
                </div>
                
                <div class="service-options">

                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="cake" name="service[]"  value="1">Cake
                    </label>
                  </div> 
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="decorations" name="service[]" value="2">Decorations
                    </label>
                  </div> 
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="Designers" name="service[]" value="3">Designers
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="hair" name="service[]" value="4">Hair and makeup
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="video" name="service[]" value="5">Video
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="security" name="service[]" value="6">Security
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="souveniers" name="service[]" value="7">Souveniers
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="ushers" name="service[]" value="8">Ushers
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="photography" name="service[]" value="9">Photography
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="invites" name="service[]" value="10">Invites
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="drinks" name="service[]" value="11">Drinks
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="fabrics" name="service[]" value="12">Fabrics and Wears
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label> 
                      <input type="checkbox"  id="car" name="service[]" required="" value="13">Car Rentals
                    </label>
                  </div>
                </div>
                
          </div> 

          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
          </div>

           <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
           <div class="form-group">
            <button type="submit" class="btn btn-lg">Register</button>
           </div>
         </div>

        </form>
      </div>
    </div>
  </div>


   <?php require __DIR__.'\..\footer.php'; ?>

   <script type="text/javascript">

    $(function(){

       $('#addservice :checkbox').click(function(){
                if($(this).prop("checked")==true)
                {
                  $('.service-options :checkbox').prop('checked', true);
                }

              });

       $('.service-options :checkbox').click(function(){
                if($('#addservice :checkbox').prop("checked")==true)
                {
                  $('#addservice :checkbox').prop('checked', false);
                }
               var t=$('.service-options :checked');
               if (t.length<13)
               {
                  $('#addservice :checkbox').prop('checked', false);
               }
               if (t.length==13)
               {
                  $('#addservice :checkbox').prop('checked', true);
               }

              });
       


        $('.regform').parsley().on('field:validate', function(formInstance) {

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

  