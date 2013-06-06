<?php
session_start();
require('../lib/base_url.php');

session_unregister("username");
//setcookie("C_username","");
 header("location: ".$base_url );
  exit;
?>
