<?php

 if (!session_start())
  session_start();
  $_SESSION['ref']=$_SERVER['REQUEST_URI'];
  $msg='';

  $auth = initialize();  


if (!isLoggedIn())
  {
    header('Location: '.$router->generate('login'));
  }
else
{
    $user=getCustomerProfile($_SESSION['username']); 
    $dash='<a onclick="javascript:accountMenu()">
            <img class="dp" height="30" width="30" src="'.$user['profile_image'].'";>         
        </a>';

       if ($_POST['optionall']=="1")
        {
          foreach($_POST as $name => $val)
          {
            if($name="all")
            {
              $data[$name]=$val; 
              break; 
            }           
          } 
        }
       else
       {
          foreach($_POST as $name => $val)
          {            
            $data[$name]=$val;               
          } 
            
        }  
      $_SESSION['event_vendors']=$data;
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
  <title> Ticket | Create Events and Search for vendors | oyinspire.me</title>
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
    <link rel="stylesheet" type="text/css" href="/oyinspire/assets/css/createpage.css">

    <script src="/oyinspire/assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src="/oyinspire/assets/js/bootstrap-3.3.1.min.js" type="text/javascript"></script>    
    <script src="/oyinspire/assets/js/scripts.js" type="text/javascript"></script>



  </head>

<body class="not-home">

  <?php require __DIR__.'\..\header.php'; ?> 

<div class="sub-header navbar navbar-default">
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <h3 class="text-main-heading">INVOICE</h3>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-9">

          <div class="image-preview text-right" >
              <img height="200" width="200" src="<?php echo $_SESSION['event_data']['image']; ?>">
             </div>

             <h4>Invoice</h4>
      <table class="table">
          <tr>
            <th>Option</th>
            <th>Your Input</th>
          </tr>        
        <?php 

            foreach($_SESSION['event_data'] as $name => $val)
            {
                $table_data[$name]=$val;                
            } 
            echo '<tr><td>Event Name</td><td>'.$table_data['name'].'</td></tr>';
            echo '<tr><td>Starts</td><td>'.$table_data['starts'].'</td></tr>';
            echo '<tr><td>Ends</td><td>'.$table_data['ends'].'</td></tr>';
            echo '<tr><td>Name of venue</td><td>'.$table_data['venue'].'</td></tr>';
            echo '<tr><td>Address</td><td>'.$table_data['address']."  ".$table_data['address2'].'</td></tr>';
            echo '<tr><td>State</td><td>'.ucfirst(getLocation($table_data['state'])).'</td></tr>';
            echo '<tr><td>Event type</td><td>'.$table_data['type'].'</td></tr>';
            echo '<tr><td>Description</td><td>'.$table_data['description'].'</td></tr>';
            echo '<tr><td>Social</td><td>'.$table_data['social'][0]."\n".$table_data['social'][1]."\n".$table_data['social'][2].'</td></tr>';
           // echo '<tr><td>Picture</td><td><img height="200" width="200" src="'.$table_data['social'].'"></td></tr>';

        ?>
    </table>

     <table class="table">
          <tr>
            <th>Service</th>
            <th>Vendor(s)</th>
          </tr> 
        <?php 

            foreach($_SESSION['event_vendors'] as $name => $val)
            {
                               
                echo '<tr><td>'.ucfirst($name).'</td><td>';
                for($i=0;$i<sizeof($val);$i++)
                echo substr(strstr($val[$i],';'), 1) ."\n";
                echo '</td></tr>';             
            } 
            // echo '<tr><td>Event Name</td><td>'.$table_data['name'].'</td></tr>';
            // echo '<tr><td>Starts</td><td>'.$table_data['starts'].'</td></tr>';
            // echo '<tr><td>Ends</td><td>'.$table_data['ends'].'</td></tr>';
            // echo '<tr><td>Name of venue</td><td>'.$table_data['venue'].'</td></tr>';
            // echo '<tr><td>Address</td><td>'.$table_data['address']."  ".$table_data['address2'].'</td></tr>';
            // echo '<tr><td>State</td><td>'.$table_data['state'].'</td></tr>';
            // echo '<tr><td>Event type</td><td>'.$table_data['type'].'</td></tr>';
            // echo '<tr><td>Description</td><td>'.$table_data['description'].'</td></tr>';
            // echo '<tr><td>Social</td><td>'.$table_data['social'][0]."".$table_data['social'][1]."\n".$table_data['social'][2].'</td></tr>';
            // echo '<tr><td>Picture</td><td><img height="200" width="200" src="'.$table_data['social'].'"></td></tr>';

        ?> 
      </table>

      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="error"><?php echo $msg; ?></div>
          </div>

    <form class="create" action="created" method="post"  enctype="multipart/form-data" >
      <div><label>Confirm your order</label></div>
      <button type="submit" class="btn btn-default">Confirm</button>      
    </form>

      </div>
    </div>
  </div>

  <?php require __DIR__.'\..\footer.php'; ?> 
</body>
</html>