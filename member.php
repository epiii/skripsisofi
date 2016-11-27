 <script>
    // $(function() {
    //     $('#nav a[href~="' + location.href + '"]').parents('li').addClass('active');
    // });
    // </script>
<?php
if(!isset($_SESSION['levelmember'])){
    echo "<script>location.href='memberlogin.html'</script>";
} else{
    $aksi="modul/mod_tag/aksi_tag.php";
    echo"<div class='container'>            
    <section class='page'>
    <a class='btn ' href='memberlogout.php'>Logout</a>";
    $act    =!isset($_GET['act'])?'act':$_GET['act'];
    $idsewa =!isset($_GET['idsewa'])?'idsewa':$_GET['idsewa'];
// vd($_GET);
// vd($act);
    switch($act){
        case 'viewbeli':
            echo"
            <ol class='breadcrumb'>
                <li class='active'>Pembelian</li>
                <li class='active'>/</li>
                <li><a href='member-viewsewa-0.html'><i class='fa fa-dashboard'></i>Sewa</a></li>
            </ol>

            <h4><center>History Pembelian</center></h4><br>
            - Nama : ".$_SESSION['namamember']."<br>
            - Anggota : ".($_SESSION['levelmember']=='u'?'umum':'koperasi')."<br>
            - Alamat: ".$_SESSION['alamatmember']." <br>
            <div class='box-body table-responsive'>
            <table id='example1' class='table table-bordered table-striped'>
                <thead><tr>
                    <th>no</th>
                    <th>Tgl Order</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>harga</th>
                    <th>total</th>
                </tr></thead>
                <tbody>";
                $s='SELECT
                        o.id_orders,    
                        od.jumlah,
                        p.nama_produk,
                        o.tgl_order,
                        p.harga,    
                        (p.harga*od.jumlah)total
                    FROM
                        orders o 
                        JOIN orders_detail od on od.id_orders = o.id_orders
                        JOIN produk p on p.id_produk = od.id_produk 
                    WHERE
                        o.id_kustomer ='.$_SESSION['idmember'];
                // vd($s);
                $tampil=mysqli_query($con,$s);
                if(mysqli_num_rows($tampil)==0){
                    echo '<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>';
                }else{
                    $no=1;
                    while ($r=mysqli_fetch_assoc($tampil)){
                        echo "<tr><td>$no</td>
                                <td>".tgl_indo($r['tgl_order'])."</td>                
                                <td>$r[nama_produk]</td>                
                                <td>$r[jumlah]</td>                
                                <td>Rp. ".format_rupiah($r['harga'])."</td>                
                                <td>Rp. ".format_rupiah($r['total'])."</td>                
                            </td>
                        </tr>";
                        $no++;
                    }
                }echo "</tbody>
                
            </table>";
        break;

        case 'viewsewa':
            echo"
            <ol class='breadcrumb'>
                <li class='active'>
                    <a href='member-viewbeli-0.html'><i class='fa fa-dashboard'></i>Pembelian</a>
                </li>
                <li class='active'>/ Sewa</li>
            </ol>

            <h4><center>History Sewa</center></h4><br>
            - Nama : ".$_SESSION['namamember']."<br>
            - Anggota : ".($_SESSION['levelmember']=='u'?'umum':'koperasi')."<br>
            - Alamat: ".$_SESSION['alamatmember']." <br>
            <div class='box-body table-responsive'>
            <div class='box-header'>
                <h3 class='box-title'>
                    <input type=button class='btn btn-primary btn' value='Tambah Sewa'
                    onclick=\"window.location.href='member-tambahsewa-0.html';\">
                </h3>
            </div>
            <table id='example1' class='table table-bordered table-striped'>
                <thead><tr>
                    <th>no</th>
                    <th>Tgl Order</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>harga</th>
                    <th>total</th>
                </tr></thead>
                <tbody>";
                $s='SELECT
                        o.id_orders,    
                        od.jumlah,
                        p.nama_produk,
                        o.tgl_order,
                        p.harga,    
                        (p.harga*od.jumlah)total
                    FROM
                        orders o 
                        JOIN orders_detail od on od.id_orders = o.id_orders
                        JOIN produk p on p.id_produk = od.id_produk 
                    WHERE
                        o.id_kustomer ='.$_SESSION['idmember'];
                // vd($s);
                $tampil=mysqli_query($con,$s);
                if(mysqli_num_rows($tampil)==0){
                    echo '<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>';
                }else{
                    $no=1;
                    while ($r=mysqli_fetch_assoc($tampil)){
                        echo "<tr><td>$no</td>
                                <td>".tgl_indo($r['tgl_order'])."</td>                
                                <td>$r[nama_produk]</td>                
                                <td>$r[jumlah]</td>                
                                <td>Rp. ".format_rupiah($r['harga'])."</td>                
                                <td>Rp. ".format_rupiah($r['total'])."</td>                
                            </td>
                        </tr>";
                        $no++;
                    }
                }echo "</tbody>
            </table>";
        break;
 
        case "tambahsewa":
            echo "<section class='content'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Tambah <small>Sewa</small></h3>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
                                        <button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->

                        <div class='box-body pad'>
                            <form method=POST action='$aksi?module=tag&act=input'>
                                <div class='form-group'>
                                    <label>Keterangan</label>
                                    <input type='text' class='form-control' name='keterangan' placeholder='keterangan'/>
                                </div>
                                <div class='form-group'>
                                    <label>Tanggal Sewa</label>
                                    <input type='text' class='form-control' name='tgl_sewa' placeholder='tgl sewa'/>
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
                                    </section>
          ";
        break;
/*
        case "edittag":
            $edit=mysqli_query($con,"SELECT * FROM tag WHERE id_tag='$_GET[id]'");
            $r=mysqli_fetch_array($edit);
            echo "<section class='content'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='box box-info'>
                                        <div class='box-header'>
                                            <h3 class='box-title'>Edit <small>Tag Artikel</small></h3>
                                            <!-- tools box -->
                                            <div class='pull-right box-tools'>
                                                <button class='btn btn-info btn-sm' data-widget='collapse' data-toggle='tooltip' title='Collapse'><i class='fa fa-minus'></i></button>
                                                <button class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'><i class='fa fa-times'></i></button>
                                            </div><!-- /. tools -->
                                        </div><!-- /.box-header -->
                                        <div class='box-body pad'>
                                        <form method=POST action='$aksi?module=tag&act=update'>
                                        <input type=hidden name=id value='$r[id_tag]'>
                                        <div class='form-group'>
                                                    <label>Nama Kategori</label>
                                                    <input type='text' class='form-control' name='nama_tag' value='$r[nama_tag]'>
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
                                            </section>
            
                  ";
        break;*/  
    }
    echo"</section></div>";
}
