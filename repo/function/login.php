<?php
session_start();
require('../lib/base_url.php');

$username=$_POST['username'];
$password=$_POST['password'];

if ((!$username) and (!$password)) // cek apakah ada inputan kosong
	{
	header("location:index.php"); // ya, input kosong
    exit;
	}else{

	$alamat = $base_url.'api/login?username='.$username.'&password='.$password;
	$handle = fopen("$alamat", "rb");
	$contents = stream_get_contents($handle);
	fclose($handle);

	$data = json_decode($contents, true);
	
	if ($data['status'] != "failed"){
		$_SESSION[username]=$data['username'];
	}else{
		session_unregister("username");
	}
	
	header( 'Location: '.$base_url ) ;
	//print_r($data);
}
?>