<?php
// panggil fungsi validasi xss dan injection
require_once('fungsi_validasi.php');

// definisikan koneksi ke database
$server = "localhost";
$username = "root";
$password = "";
$database = "skripsi";
// $database = "skripsi2";

// Koneksi dan memilih database di server
$con =mysqli_connect($server,$username,$password) or die("Koneksi gagal");
$db  =mysqli_select_db($con,$database);// or die("Database tidak bisa dibuka");
// var_dump($db);exit;
// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Lokovalidasi;
?>
