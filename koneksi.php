<?php
date_default_timezone_set("Asia/Makassar");
$server 	= "localhost";
$username	= "root";
$pass		= "";
$db 		= "monitoring_telkom"; //sesuaikan nama databasenya
$koneksi = mysqli_connect($server, $username, $pass, $db); //pastikan urutan pemanggilan variabel nya sama.

//untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()) {
	echo "Koneksi gagal : ".mysqli_connect_error();
}