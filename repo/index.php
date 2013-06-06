<?php
session_start();
$username=$_SESSION['username'];
?>
<html>
<head>
</head>
<body>


<?php
function retrieve($data){
// retrieve data
	return "Masuk";
}

//$data2=retrieve($data);
?>

<form method="post" action="function/login.php">
Username : <input type="text" value="" name="username"/><br />
Password : <input type="text" value="" name="password"/>
<input type="submit" name="Submit" value="Login"/>
</form>
<br />

<?php
	if(isset($username)){
		echo "Selamat datang, ".$username;
	}else{
		echo "Anda belum login";
	}
?>
<br />
<a href="function/logout.php" style="text-decoration:none">Logout </a>

</body>
</html>