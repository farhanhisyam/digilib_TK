<?php
//variable
$host="localhost";
$user="telkom";
$pass="*T3lk0m#2023";
$db="digilib_tk";

//koneksi
$koneksi = mysqli_connect($host,$user,$pass,$db);
if (!$koneksi) echo "koneksi gagal........";
?>