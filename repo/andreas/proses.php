<?php

$data=$_POST['input'];

$data_json=json_encode($data);
$alamat="http://localhost/repo/andreas/API/proses_data.php?data=$data";
echo " Alamat api=$alamat";
$handle = fopen("$alamat", "rb");
$contents = stream_get_contents($handle);
fclose($handle);
//eksekusi
echo "<br><b>";
//mysql /anything
echo $contents;
?>