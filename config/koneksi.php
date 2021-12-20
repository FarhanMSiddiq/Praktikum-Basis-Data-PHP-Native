<?php

$host="localhost";
$user="root";
$password="";
$db="db_farhan_ms";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
	  die("Koneksi gagal:".mysqli_connect_error());
}

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>