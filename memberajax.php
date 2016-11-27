<?php
	session_start();
	include "config/koneksi.php";
	include "config/library.php";

	if(!isset($_POST['aksi'])){

	}else{
		if($_POST['aksi']=='baranglist'){
			$s='select * from produk where tipe="s"';
			$e=mysqli_query($con,$s);
			$arr=[];
			while ($r=mysqli_fetch_assoc($e)) {
				$arr[]=$r;
			}echo json_encode($arr);
		}else{
			$s='select * from produk where id_produk='.$_POST['id_produk'];
			$e=mysqli_query($con,$s);
			$r=mysqli_fetch_assoc($e);
			echo json_encode($r[($_SESSION['levelmember']=='k'?'hargakoperasi':'hargaumum')]);
		}
	}
?>