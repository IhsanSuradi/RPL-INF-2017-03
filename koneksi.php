<?php

$servername = "localhost";
$username = "root";
$password= "";
$dbname = "rpl";

//buat koneksi
$koneksidb = new mysqli($servername, $username, $password, $dbname);

//cek koneksi
if($koneksidb->connect_error)
{
	die("Koneksi gagal :(" . $conn->connect_error);
	
}

?>
