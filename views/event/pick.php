<?php
 if (!session_start())
  session_start();
$msg="";
 $auth = initialize();  
 

if (!isLoggedIn())
  {
    header('Location:'.$router->generate('login'));
  }
else if ($_SERVER['REQUEST_METHOD']=='POST')
{
  
    $user=getCustomerProfile($_SESSION['username']);
    $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'";>         
        </a>';

    $data=array();

    $_POST['image'] = uploadImage($_FILES['image'],$user['id']);

    foreach($_POST as $name => $val)
    {
      $data[$name]=$val;
    }
    $_SESSION['event_data']=$data;
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
  <title> Pick Vendors | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/pickpage.css">
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/parsley.css">


    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/parsley.min.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>


<script  type="text/javascript">
        $(document).ready(
          function(){

              $('input[type="checkbox"]').click(function(){
                if($(this).prop("checked")==true)
                {
                  $("#service").fadeOut();
                }
                else if ($(this).prop("checked")==false)
                {
                  $("#service").fadeIn();
                }

              });


            });

             $('.inputs .result').click(function(){
                 $(this).fadeOut();
              });

               function openWindow(id)
               {
                  console.log(id);
                  mywindow = window.open("/oyinspire/search?p=vendor&s="+id,id,
                  "menubar=1,resizable=1,scrollbars=1,status=yes,toolbar=no,location=no,width=450,height=500");
                  mywindow.moveTo(500,50);
               }
        



    </script>
  </head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?>

  <div class="sub-header navbar navbar-default">
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <h3 class="text-main-heading">Pick a vendor</h3>
      </div>
    </div>
  </div>

<div class="container">
    <div class="row">
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <form class="create" action="ticket" method="post"  enctype="multipart/form-data" data-parsley-validate="">	

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12">
          	<div class="form-group">        
              <label for="Vendor">Pick a vendor</label>
             <div class="inputs all">
                <a class="addbtn" id="all" onclick="javascript:openWindow('all')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>            
            </div>
          </div> 

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-9 instruct" >
                <div class="checkbox"> 
                  <label> 
                    <input type="checkbox"  value="1" name="optionall" data-vendor="all">
                     Check this if you want one vendor for all services
                  </label> 
                </div>
          </div>               

          <div id="service">
          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Cake</label>
              <div class="inputs cake">
                <a class="addbtn" id="cake" onclick="javascript:openWindow('cake')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Decoration</label>
               <div class="inputs decoration">
                <a class="addbtn" id="decoration" onclick="javascript:openWindow('decoration')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Food</label>
               <div class="inputs food">
                <a class="addbtn" id="food" onclick="javascript:openWindow('food')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Designers</label>
               <div class="inputs designers">
                <a class="addbtn" id="designers" onclick="javascript:openWindow('designers')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Hair and Makeup</label>
              <div class="inputs hair" >
                <a class="addbtn" id="hair" onclick="javascript:openWindow('hair')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Video</label>
               <div class="inputs video">
                <a class="addbtn" id="video" onclick="javascript:openWindow('video')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Security</label>
               <div class="inputs security">
                <a class="addbtn" id="security" onclick="javascript:openWindow('security')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Souveniers</label>
               <div class="inputs souveniers">
                <a class="addbtn" id="souveniers" onclick="javascript:openWindow('souveniers')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Ushers</label>
              <div class="inputs ushers">
                <a class="addbtn" id="ushers" onclick="javascript:openWindow('ushers')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Photography</label>
               <div class="inputs photography">
                <a class="addbtn" id="photography" onclick="javascript:openWindow('photography')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Invites</label>
               <div class="inputs invites">
                <a class="addbtn" id="invites" onclick="javascript:openWindow('invites')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Drinks</label>
               <div class="inputs drinks">
                <a class="addbtn" id="drinks" onclick="javascript:openWindow('drinks')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Fabrics and Wears</label>
               <div class="inputs fabrics" >
                <a class="addbtn" onclick="javascript:openWindow('fabrics')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>

          <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group">        
              <label for="Vendor">Car Rentals</label>
               <div class="inputs cars" >
                <a class="addbtn" id="cars" onclick="javascript:openWindow('cars')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
          </div>

        <div class="col-lg-7 col-md-7 col-sm-9 col-xs-12" >
            <div class="form-group submit">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
      
       </form> 
     </div>
   </div>
  </div>


<?php require __DIR__.'\..\footer.php'; ?>

  <script type="text/javascript">

    $(function(){

       
        $('.create').parsley().on('field:validate', function(formInstance) {

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
