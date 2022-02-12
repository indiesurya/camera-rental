<?php
session_start();
// var_dump($_SESSION['user']);
//koneksi ke db
include 'koneksi.php';
?>
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
<?php include 'navbar.php'?>

        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
            <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Nota</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->
       
            <div class="container">
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user WHERE pembelian.id_pembelian='$_GET[id]'");
                    $detail = $ambil->fetch_assoc();
                    $status = $detail['status_pembelian'];
                    // var_dump($detail);
                    ?>
                    <!-- <pre>
                    <?php print_r($detail)?>
                    </pre> -->
                    <!-- <pre>
                    <?php print_r($_SESSION)?>
                    </pre> -->
            <!-- jika pelanggan yang membeli tidak sama dengan pelanggan ang mengakses maka dilarikan ke index -->
            <?php 
            $iduseryanglogin = $_SESSION['user']['id_user'];
            if($detail['id_user']!==$_SESSION['user']['id_user']){
                echo "<script>alert('Anda tidak bisa mengakses nota ini');</script>";
                echo "<script>location='index.php'</script>";
                exit();
            } ?>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <h3>Pembelian #<?=$detail['id_pembelian']?></h3>
                        Tanggal :<i class='far fa-calendar-alt'></i> <?=$detail['tanggal_pembelian']?><br>
                        Status :<?php if($status=="pending"):
                        ?>
                            <span class="badge badge-info"><?=$status?></span>
        
                        <?php elseif($status=="Sudah mengirim pembayaran"): ?>
                    
                            <span class="badge badge-primary"><?=$status?></span>
                        
                        <?php elseif($status=="Batal"): ?>
                    
                            <span class="badge badge-danger"><?=$status?></span>
                        

                        <?php else:?>
                    
                            <span class="badge badge-success"><?=$status?></span>
                            <br>
                            <?php if(!empty($detail['resi_pengiriman'])):?>
                            Resi : <?=$detail['resi_pengiriman'];?>
                            <?php endif ?>
                        
                        <?php endif ?>
                    </div>
                    <div class="col-md-3">
                        <h3>Pelanggan</h3> 
                        <i class="fa fa-user"></i>  <?=$detail['nama_user'];?>
                        <br>
                        <i class="fa fa-phone"></i> <?=$detail['tlp_user'];?>
                        <br>
                        <i class="fa fa-envelope"></i> <?=$detail['email_user'];?>
                    </div>
                    <div class="col-md-3">
                        <h3>Pengiriman</h3>
                        Kota Pengiriman : <?=$detail['nama_kota'];?><br>
                        Alamat Pengiriman : <?=$detail['alamat_pengiriman']?>

                    </div>
                </div>

                <table class="table table-striped mt-5">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Berat</th>
                            <th>Jumlah</th>
                            <th>Subberat</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $nomor=1;?>
                    <?php $totalbelanja=0?>
                    <?php $ambil2 = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'")?>
                    <?php while($pecah =  $ambil2->fetch_assoc()){?>
                        <tr>
                            <th><?=$nomor;?></th>
                            <td><?=$pecah['nama'];?></td>
                            <td>Rp.<?=number_format($pecah['harga']);?></td>
                            <td><?=$pecah['berat'];?></td>
                            <td><?=$pecah['jumlah'];?></td>
                            <td><?=$pecah['subberat']?> Gram</td>
                            <td>Rp.<?=number_format($pecah['subharga'])?></td>
                        </tr>
                    <?php 
                    $nomor++;
                    $totalbelanja +=$pecah['subharga'];
                    } 
                    ?>
                    </tbody>
                </table> 
                <div class="row">
                    <div class="col-md-7 mt-5">
                        <div class="alert alert-info mt-5">
                            <p>Silahkan Melakukan Pembayaran <strong>Rp.<?=number_format($detail['total_pembelian'])?> </strong>Sesuai Dengan Prosedur <a href="pembayaran.php?id=<?=$detail['id_pembelian']?>">Pembayaran</a> </p>
                        </div>
                    </div>
                    <div class="col-md-5 mt-5">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Belanja</td>
                                    <td>Rp.<?=number_format($totalbelanja)?></td>
                                </tr>
                                <tr>
                                    <td>Total Ongkir</td>
                                    <td>Rp.<?=number_format($detail['tarif'])?></td>
                                </tr>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td>Rp.<?=number_format($detail['total_pembelian'])?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>        
            </div>
        
         <!-- ========================= SECTION  END// ========================= -->
        <!-- footer -->
        <?php include 'footer.php'; ?>
        <!-- end footer -->
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        </body>

</html>
