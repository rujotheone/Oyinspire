<?php
require 'require.php';

if (!session_start())
  session_start();


Logout();
header('Location: '.$router->generate('home'));


?>