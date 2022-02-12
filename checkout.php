<?php
session_start();
// var_dump($_SESSION['user']);
//koneksi ke db
include 'koneksi.php';
//jika tidak ada session user (belum login), maka dilarikan ke login.php
if(!isset($_SESSION['user'])){
    echo "<script>alert('Anda Harus Login Terlebih Dahulu')</script>";
    echo "<script>location='login.php'</script>";
}
if(!isset($_SESSION['keranjang']) OR (empty($_SESSION['keranjang']))){
    echo "<script>alert('Anda Harus Belanja Terlebih Dahulu')</script>";
    echo "<script>location='index.php'</script>";
}

?>
<!-- <pre><?php print_r($_SESSION)?></pre> -->

<?php include 'navbar.php'?>
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
            <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Checkout</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->

            <!-- main content -->
                
        <div class="container mt-3">
            <h2>Keranjang Belanja</h2>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1;
                    $totalbelanja = 0;
                    $berattotal = 0?>
                    <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah):?>
                        <!-- menampilkan produk yang sedang diperulangkan berdasarkan id produk -->
                    <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'")?>
                    <?php $pecah = $ambil->fetch_assoc();?>
                    <?php $subtotal=$pecah['harga_produk']*$jumlah;?>
                    <tr>
                        <th><?=$nomor?></th>
                        <td><?=$pecah['nama_produk']?></td>
                        <td>Rp.<?=number_format($pecah['harga_produk'])?></td>
                        <td><?=number_format($pecah['berat_produk'])?> Gr</td>
                        <td><?=$jumlah?></td>
                        <td>Rp.<?=number_format($subtotal)?></td>
                    </tr>
                    <?php $berattotal+=$pecah['berat_produk']*$jumlah/1000;
                    $nomor++;
                    $totalbelanja+=$subtotal?>
                    <?php endforeach ?>
                </tbody>
                <!-- <?php var_dump(ceil($berattotal))?> -->
                <tfoot>
                    <tr>
                        <th colspan="5">Total Belanja</th>
                        <th>Rp.<?= number_format($totalbelanja)?></th>
                    </tr>
                </tfoot>
            </table>
            <form action="" method="post">
                <div class="row mt-3">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nama_user">Nama</label>
                            <input type="text" class="form-control" readonly value="<?=$_SESSION['user']['nama_user']?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ongkir_user">Ongkos Kirim</label>
                            <select name="id_ongkir" required class="form-control">
                                <?php
                                $ambil = $koneksi->query("SELECT * FROM ongkos_kirim");
                                while($pecah =$ambil->fetch_assoc()){?>
                                <option value="<?= $pecah['id_ongkir']?>"><?=$pecah['nama_kota']?> - Rp.<?=number_format($pecah['tarif'])?></option>
                            <?php } ?>
                            </select>
                        </div>
                     </div>
                </div>
                <div class="row">
                <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="tlp_user">Nomor Telepon</label>
                            <input type="text" class="form-control" readonly value="<?=$_SESSION['user']['tlp_user']?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_lengkap">Alamat Lengkap Pengiriman</label>
                            <textarea required name="alamat_lengkap" class="form-control" placeholder="Alamat lengkap termasuk kode pos" cols="46" rows="7"></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary pull-right" name="checkout">Checkout</button>
            </form>
            <?php if(isset($_POST["checkout"])){
                //cek ketersediaan produk 
                foreach($_SESSION['keranjang'] as $id_produk => $jumlah):
                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $stok = $pecah['stok_produk'];
                if($jumlah > $stok){
                    echo "<script>alert('Mohon maaf stok produk tersisa $stok buah')</script>";
                    unset($_SESSION['keranjang'][$id_produk]);
                    echo "<script>location='keranjang.php'</script>";
                    exit();
                }
                endforeach;
                
                //menyimpan id pelanggan id ongkir dan biaya total
               $id_pelanggan =  $_SESSION["user"]["id_user"];
               $id_ongkir = $_POST["id_ongkir"];
               $tanggal_pembelian = date("y-m-d");
               $alamat_lengkap = $_POST['alamat_lengkap'];
               $ambil = $koneksi->query("SELECT * FROM ongkos_kirim WHERE id_ongkir='$_POST[id_ongkir]'");
               $pecah = $ambil->fetch_assoc();
               $nama_kota = $pecah['nama_kota'];
               $tarif = $pecah['tarif'];
               $totaltarif = $tarif * ceil($berattotal);
               $totalbiaya = $totalbelanja+$totaltarif;
               // menyimpan data ke tabel pembelian 
               $koneksi->query("INSERT INTO pembelian (id_user,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$totalbiaya','$nama_kota','$totaltarif','$alamat_lengkap')");
               //mendapatkan id pembelian yang baru terjadi
               $idpembelianbaru =  $koneksi->insert_id;

               //menyimpan data ke tabel pembelian_prooduk
               foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
                   //mendapatkan data produk berdasarkan id_produk (untuk nota)
                   $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                   $pecah = $ambil->fetch_assoc();
                   $nama = $pecah['nama_produk'];
                   $harga = $pecah['harga_produk'];
                   $beratproduk = $pecah['berat_produk'];
                   $subberat = $pecah['berat_produk']*$jumlah;
                   $subharga = $pecah['harga_produk']*$jumlah;
                   $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES('$idpembelianbaru','$id_produk','$nama','$harga','$beratproduk','$subberat','$subharga','$jumlah')");
                   //update stok
                   $koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");
               }
               //kosongkan keranjang belanja
               unset($_SESSION['keranjang']);
               //tampilan dialihkan ke halaman nota pembelian
               echo "<script>alert('Pembelian Berhasil!!')</script>";
               echo "<script>location='nota.php?id=$idpembelianbaru'</script>";
            } ?>

    <!-- <pre><?php print_r($_SESSION['user']) ?></pre> -->
    <!-- <pre><?php print_r($_SESSION['keranjang']) ?></pre> -->
    <!-- main content -->
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
