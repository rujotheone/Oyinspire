<?php 
header("Content-Type: text/html");
 require 'require.php';

// include dirname(__FILE__) . '/includes/AltoRouter.php';
  //include dirname(__FILE__) . '/vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/oyinspire');

/* Setup the URL routing. This is production ready. */

// Main routes that non-customers see
$router->map('GET|POST','/see', 'views/see.php', 'see');
$router->map('GET|POST','/loader', 'views/loader.html', 'loader');


$router->map('GET','/', 'views/home.php', 'home');
$router->map('GET','/home', 'views/home.php', 'home-home');
$router->map('GET','/login', 'views/login.php', 'login');
$router->map('GET','/search', 'views/search.php', 'search');
$router->map('POST','/search', 'views/search.php');
$router->map('GET','/search?p=*&s=*&page=*&q=*', 'views/search.php', 'search-vendors');
$router->map('POST','/login', 'views/login.php', 'plogin');
$router->map('GET','/signup', 'views/signup.php', 'signup');
$router->map('POST','/signup', 'views/signup.php','psignup');
$router->map('GET','/logout', 'views/logout.php', 'logout');
$router->map('GET','/about', 'views/about.php', 'about');
$router->map('GET','/help', 'views/help.php', 'help');
$router->map('GET','/how-it-works', 'views/how-it-works.php', 'how');
$router->map('GET','/faq', 'views/faq.php', 'faq');
$router->map('GET','/pricing', 'views/pricing.php', 'pricing');
$router->map('GET','/privacy', 'views/privacy.php', 'privacy');
$router->map('GET','/terms', 'views/terms.php', 'terms');
$router->map('GET','/services', 'views/services.php', 'services');
$router->map('GET|POST','/vendor_service', 'views/vendor_service.php');
$router->map('GET|POST','/rate', 'views/rate.php');
$router->map('GET','/vendor/', 'views/vendor/vendors.php', 'vendors');
$router->map('GET','/planner/', 'views/vendor/planners.php', 'planners');
//$router->map('GET','/vendor/profile', 'views/vendor/profile.php', 'vendorprofile');
$router->map('GET','/vendor/registration', 'views/vendor/registration.php','PVregistration');
$router->map('POST','/vendor/registration', 'views/vendor/registration.php');
$router->map('GET','/vendor/myphotos', 'views/vendor/photos.php','vendorphotos');
$router->map('POST','/vendor/myphotos', 'views/vendor/photos.php');
$router->map('GET','/vendor/[*:user]', 'views/vendor/profile.php','vendorprofile');
$router->map('GET','/event/create', 'views/event/create.php', 'create');
$router->map('POST','/event/pick', 'views/event/pick.php');
$router->map('POST','/event/ticket', 'views/event/ticket.php');
$router->map('GET|POST','/event/created', 'views/event/created.php');
//$router->map('GET','/[c:user]', 'views/user/profile.php', 'profile2');
$router->map('GET','/registration', 'views/user/registration.php','registration');
$router->map('POST','/registration', 'views/user/registration.php','Pregistration');
$router->map('GET','/user/', 'views/user/profile.php', 'profile');
$router->map('GET','/user/[*:user]', 'views/user/profile.php');
$router->map('GET','/settings/edit', 'views/settings/edit.php', 'edit');
$router->map('POST','/settings/edit', 'views/settings/edit.php');
$router->map('GET','/settings/vendor-edit', 'views/settings/vendor-edit.php', 'vendoredit');
$router->map('POST','/settings/vendor-edit', 'views/settings/vendor-edit.php');
$router->map('GET|POST','/settings/password', 'views/settings/password.php', 'password');
$router->map('GET','/settings/close-account', 'views/settings/edit.php', 'close-account');
$router->map('GET','/settings/reset', 'views/settings/reset.php', 'reset');
$router->map('POST','/settings/reset', 'views/settings/reset.php');
$router->map('GET','/settings/complete-reset', 'views/settings/complete-reset.php','complete-reset');




/* Match the current request */
$match = $router->match();
if($match) {
  require $match['target'];
}
else {
  header("HTTP/1.0 404 Not Found");
  require '404.html';
}

   // echo    dirname(__FILE__);
  //echo    __FILE__;
  

   


  ?>

  