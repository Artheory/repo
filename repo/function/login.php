<?php

require('../lib/base_url.php');

function json_decode_nice($json, $assoc = FALSE){ 
    $json = str_replace(array("\n","\r"),"",$json); 
    $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$json); 
    return json_decode($json,$assoc); 
}

$username=$_POST['username'];
$password=$_POST['password'];
$alamat = $base_url.'repo/api/login?username='.$username.'&password='.$password;
$handle = fopen("$alamat", "rb");
$contents = stream_get_contents($handle);
fclose($handle);

$data = var_dump(json_decode($contents, true));

?>