<?php
	session_start();
	include "config/koneksi.php";
	include "config/library.php";
	include "config/fungsi_indotgl.php";

	if(!isset($_POST['aksi'])){
		echo json_encode('invalid post');
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
		}elseif($_POST['aksi']=='simpan'){
			$tgl= tgl_db($_POST['tgl_sewa']);
			$jam= $_POST['jam'];
			$menit= $_POST['menit'];
			$tgl_sewa=$tgl.' '.$jam.':'.$menit;
			// vd($tgl);
			$s=empty($_POST['id_order'])?'INSERT INTO ':'UDPATE ';
			$s.=' orders_sewa set 
					keterangan  ="'.$_POST['keterangan'].'",
					id_kustomer ="'.$_POST['id_kustomer'].'",
					tgl_sewa    ="'.$tgl_sewa.'"';
			$s.=empty($_POST['id_order'])?'':' WHERE id_order='.$_POST['id_kustomer'];
			$e=mysqli_query($con,$s);
			$id_order_sewa=mysqli_insert_id($con);
			if($e){
				$sx='';
				foreach ($_POST['selectTB'] as $i => $v) {
					$ss='INSERT INTO orders_detail_sewa SET 
						id_order_sewa ='.$id_order_sewa.',
						id_produk     ='.$v.',
						total         ='.$_POST['jumlahTB'][$i];
					$sx.=$ss;
					$ee=mysqli_query($con,$ss);
				}
			}echo json_encode(array('success'=>!$e||!$ee?false:true));
		}else{
			$s='DELETE FROM orders WHERE id_order='.$_POST['id_order'];
			$e=mysqli_query($con,$s);
			echo json_encode(array('success'=>!$e?false:true));
		}
	}
?>