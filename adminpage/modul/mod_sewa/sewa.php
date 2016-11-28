<?php
// session_start();
// include "../../../config/library.php";
// include "../config/library.php";
 // if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
if (empty($_SESSION['namauser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
  $aksi = "modul/mod_sewa/aksi_sewa.php";
  echo "
  <aside class='right-side'>
                <!-- Content Header (Page header) -->
                <section class='content-header'>
                    <h1>
                        Data
                        <small>sewa</small>
                    </h1>
                    <ol class='breadcrumb'>
                        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
                        <li class='active'>Data sewa</li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class='content'>
                    <div class='row'>
                        <div class='col-xs-12'>
                   
<div class='box'>";
$act=!isset($_GET['act'])?'':$_GET['act'];
switch($act){
// switch($_GET['act']){
  // Tampil sewa
  default:
    echo "   
      <div class='box-header'>
      <h3 class='box-title'>

      </h3>
      </div><!-- /.box-header -->
      <div class='box-body table-responsive'>

      <table id='example1' class='table table-bsewaed table-striped'>
      <thead>
      <tr>
        <th>No.</th>
        <th>Nama Kostumer</th>
        <th>Barang</th>
        <th>Biaya</th>
        <th>Jumlah</th>
        <th>Biaya Total</th>
        <th>Tgl. sewa</th>
        <th>Jam sewa</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
      </thead><tbody>";
    
    $no=1;
    $s='SELECT *,
          IF(k.kategori="k",p.hargakoperasi,p.hargaumum)hargasatuan,
          IF(p.jenisdurasi="h","hari","jam")jenisdurasi,
          case ds.status
            when "b" then "belum kembali"
            when "k" then "sudah kembali"
            when "p" then "pending"
            else "terlambat"
          end as statussewa

        FROM
          orders_sewa s
          JOIN orders_detail_sewa ds ON ds.id_order_sewa = s.id_order_sewa
          JOIN kustomer k ON k.id_kustomer = s.id_kustomer
          JOIN produk p on p.id_produk = ds.id_produk';
    $tampil = mysqli_query($con,$s);
    while($r=mysqli_fetch_assoc($tampil)){
      $tanggal =tgl_indo($r['tgl_sewa']);
      $jam     =jam_indo($r['tgl_sewa']);
      echo "<tr><td align=center>$no</td>
                <td>$r[nama_lengkap]</td>
                <td>$r[nama_produk]</td>
                <td>Rp. ".(format_rupiah($r['hargasatuan']))." / ".($r['durasi'].' '.$r['jenisdurasi'])."</td>
                <td>$r[total]</td>
                <td>Rp. ".(format_rupiah($r['total']*$r['hargasatuan']))."</td>
                <td>$tanggal</td>
                <td>$jam</td>
                <td>$r[statussewa]</td>
                <td class='center'>
                  <a class='btn btn-info' href='?module=sewa&act=detailsewa&id=$r[id_order_sewa]'>
                    <i class='icon-edit icon-white'></i>  
          					Detail                                            
          				</a>
                </td></tr>";
      $no++;
    }echo "</tbody></table>";
  break;
  
  case "detailsewa":
    $s='SELECT *,
          IF(k.kategori="k",p.hargakoperasi,p.hargaumum)hargasatuan,
          IF(p.jenisdurasi="h","hari","jam")jenisdurasi,
          case ds.status
            when "b" then "belum kembali"
            when "k" then "sudah kembali"
            when "p" then "pending"
            else "terlambat"
          end as statussewa
        FROM
          orders_sewa s
          JOIN orders_detail_sewa ds ON ds.id_order_sewa = s.id_order_sewa
          JOIN kustomer k ON k.id_kustomer = s.id_kustomer
          JOIN produk p on p.id_produk = ds.id_produk';
    $edit = mysqli_query($con,$s);
    $r    = mysqli_fetch_assoc($edit);
    $totBiaya=$r['total']*$r['hargasatuan'];
    echo "
      <div class='container'>
        <section class='content-header'>
              <h1>
                  Data Sewa Barang
                  <small>#$r[id_order_sewa]</small>
              </h1>
              <ol class='breadcrumb'>
                  <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
                  <li class='active'>Invoice</li>
              </ol>
          </section>

          <div class='table-responsive'>
            <table class='table table-striped'>
              <tbody>
                <tr>
                  <th style='width:15%'>Nama Kustomer </th>
                  <td>: ".$r['nama_lengkap']."</td>
                </tr>
                <tr>
                  <th style='width:15%'>Barang </th>
                  <td>: ".$r['nama_produk']."</td>
                </tr>
                <tr>
                  <th style='width:15%'>Biaya </th>
                  <td>: Rp. ".format_rupiah($r['hargasatuan'])."</td>
                </tr>
                <tr>
                  <th style='width:15%'>Jumlah </th>
                  <td>: ".$r['total']."</td>
                </tr>
                <tr>
                  <th style='width:15%'>Biaya Total </th>
                  <td>: Rp. ".format_rupiah($totBiaya)."</td>
                </tr>
                <tr>
                  <th style='width:15%'>Tgl / Jam Sewa </th>
                  <td>: ".tgl_indo($r['tgl_sewa'])." / ".jam_indo($r['tgl_sewa'])."</td>
                </tr>
                <tr>
                  <th style='width:15%'>Tgl / Jam Kembali </th>
                  <td>
                    <div class='input-group date'  data-date-format='dd-mm-yyyy' data-provide='datepicker'>
                      <input  required  readonly placeholder='tanggal sewa' name='tgl_kembali' id='tgl_kembali' type='text' class='datepicker form-control span3'>
                      <div class='input-group-addon'>
                          <i class='glyphicon glyphicon-th'></i>
                      </div>
                    </div>
                  </td> 
                </tr>
                <tr>
                  <th style='width:15%'>Status </th>
                  <td>"; 
                  echo'<div class="form-group">
                    : <select class="span3 control-input" name="statussewa">
                      <option '.($r['status']=='p'?'selected':'').' value="p">Pending</option>
                      <option '.($r['status']=='b'?'selected':'').' value="b">Belum Kembali</option>
                      <option '.($r['status']=='t'?'selected':'').' value="t">Terlambat</option>
                      <option '.($r['status']=='k'?'selected':'').' value="k">Sudah Kembali</option>
                    </select>
                  </div>';
              echo"</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class='pad margin no-print'>
              <div class='alert alert-info' style='margin-bottom: 0!important;'>
                  <i class='fa fa-info'></i>
                  <b>Note:</b> This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
              </div>
          </div>
          <section>
                <div class='row'>
                    <!-- accepted payments column -->
                    <div class='col-xs-6'>
                        <p class='lead'>Payment Methods:</p>
                        <p class='text-muted well well-sm no-shadow' style='margin-top: 10px;'>
                        Pembayaran dapat dilakukan melalui transfer bank ke Rekening kami :<br />
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
      </div>
    ";

    break;  
}
}
echo "</div><!-- /.box-body -->
 </div>
                    </div>

                </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->";
?>
