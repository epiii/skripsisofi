<?php
	session_start();
	include "config/koneksi.php";
	include "config/library.php";
	include "config/fungsi_indotgl.php";

	if(!isset($_POST['aksi'])){

	}else{
		if($_POST['aksi']=='baranglist'){
			$s='select * from produk where tipe="s"';
			$e=mysqli_query($con,$s);
			$arr=[];
			while ($r=mysqli_fetch_assoc($e)) {
				$arr[]=$r;
			}echo json_encode($arr);
		}elseif($_POST['aksi']=='total'){
			$s='select * from produk where id_produk='.$_POST['id_produk'];
			$e=mysqli_query($con,$s);
			$r=mysqli_fetch_assoc($e);
			echo json_encode($r[($_SESSION['levelmember']=='k'?'hargakoperasi':'hargaumum')]);
		}else{
			$tgl= tgl_db($_POST['tgl_sewa']);
			$jam= $_POST['jam'];
			$menit= $_POST['menit'];
			$tgl_sewa=$tgl.' '.$jam.':'.$menit;
			// vd($tgl);
			$s='insert into orders_sewa set 
				keterangan  ="'.$_POST['keterangan'].'",
				id_kustomer ="'.$_POST['id_kustomer'].'",
				tgl_sewa    ="'.$tgl_sewa.'"';
			vd($s);
			echo json_encode(array('hasil'=>true));
		}
	}
?>