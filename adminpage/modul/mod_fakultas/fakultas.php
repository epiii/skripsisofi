<?php
// session_start();
if (empty($_SESSION['namauser'])){
echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_fakultas/aksi_fakultas.php";
echo "
<aside class='right-side'>
                <!-- Content Header (Page header) -->
                <section class='content-header'>
                    <h1>
                        Data
                        <small>Faktultas</small>
                    </h1>
                    <ol class='breadcrumb'>
                        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
                        <li class='active'>Data Faktultas</li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class='content'>
                    <div class='row'>
                        <div class='col-xs-12'>
                   
<div class='box'>";
$act=!isset($_GET['act'])?'act':$_GET['act'];
switch($act){
  // Tampil fakultas
  default:
    echo "<div class='box-header'>
                                    <h3 class='box-title'>
<input type=button  class='btn btn-primary btn' value='Tambahkan Fakultas' onclick=location.href='?module=fakultas&act=tambahfakultas'>
</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body table-responsive'>
    
    <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
          <tr><th>No</th><th>Fakultas</th><th>Aksi</th></tr></thead><tbody>";
    $tampil=mysqli_query($con,"SELECT * FROM fakultas ORDER BY id_fakultas");
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
      // $tgl=tgl_indo($r['tgl_posting']);
      echo "<tr><td>$no</td>
                <td>$r[fakultas]</td>
                <td>
                   <a class='btn btn-info' href='?module=fakultas&act=editfakultas&id=$r[id_fakultas]'>
                    <i class='icon-edit icon-white'></i>  
                    Edit                                            
                  </a>
                  <a class='btn btn-danger' href='$aksi?module=fakultas&act=hapus&id=$r[id_fakultas]'>
                    <i class='icon-trash icon-white'></i> 
                    Delete
                  </a>
            </tr>";
    $no++;
    }
    echo "</tbody></table>";
    break;
  
  case "tambahfakultas":
    echo "<section class='content'>

                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Tambah <small>Slide</small></h3>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
                                        <button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
                                  <form method=POST action='$aksi?module=header&act=input' enctype='multipart/form-data'>
                                  <div class='form-group'>
                                            <label>Fakultas</label>
                                            <input type='text' class='form-control' name='judul' placeholder='Judul Slide ...'/>
                                        </div>
                                        
                                        <div class='form-group'>
                                        <input type=submit class='btn btn-primary btn-lg' value=Simpan>
                            <input type=button class='btn btn-warning btn-lg' value=Batal onclick=self.history.back()>
                            </div>
                                    </form>
                                </div>
                            </div><!-- /.box -->

                            
                        </div><!-- /.col-->
                    </div><!-- ./row -->
                                    </section>";
     break;
    
  case "editfakultas":
    $edit = mysqli_query($con,"SELECT * FROM fakultas WHERE id_fakultas='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

    echo "<section class='content'>

                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Edit <small>Fakultas</small></h3>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
                                        <button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
                                   <form method=POST enctype='multipart/form-data' action=$aksi?module=fakultas&act=update>
          <input type=hidden name=id value=$r[id_fakultas]>
                                  <div class='form-group'>
                                            <label>Fakultas</label>
                                            <input type='text' class='form-control' name='fakultas' value='$r[fakultas]'/>
                                  </div>
                                       
                                        <div class='form-group'>
                                        <input type=submit class='btn btn-primary btn-lg' value=Update>
                            <input type=button class='btn btn-warning btn-lg' value=Batal onclick=self.history.back()>
                            </div>
                                    </form>
                                </div>
                            </div><!-- /.box -->

                            
                        </div><!-- /.col-->
                    </div><!-- ./row -->
                                    </section>";
    break;  
}
}
?>
