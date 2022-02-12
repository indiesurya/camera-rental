<?php
session_start();

$id_kategori = $_GET['id'];
include 'koneksi.php';
$semuadata = [];
$ambil = $koneksi->query("SELECT * FROM kategori LEFT JOIN produk_sewa ON kategori.id_kategori=produk_sewa.id_kategori LEFT JOIN user ON produk_sewa.id_user=user.id_user WHERE kategori.id_kategori='$id_kategori'");
while($pecah = $ambil->fetch_assoc()){
    $semuadata[]=$pecah;
};
$semuakategori = [];
$ambilkategori = $koneksi->query("SELECT * FROM kategori");
while($pecahkategori = $ambilkategori->fetch_assoc()){
    $semuakategori[]= $pecahkategori;
}
?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
<!-- <pre><?php print_r($semuadata)?></pre> -->
    <?php include 'navbar.php'?>
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
            <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
                  <h3 class="mb-0">Rent</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->
        <!-- main content -->
        <div class="container mt-3">
        <div class="row">
                <!-- sidebar -->
                <div class="col-lg-3">
                    <h3 class="my-4">Kategori</h3>
                    <div class="list-group">
                        <?php foreach($semuakategori as $key => $tiapkategori): 
                        ?>
                        <a href="kategorisewa.php?id=<?=$tiapkategori['id_kategori']?>" class="list-group-item"><?= $tiapkategori['nama_kategori']?></a>
                        <?php endforeach?>
                    </div>
                </div>
                <!-- Main content -->
                <div class="col-lg-9">
                     <h3 class="my-4">Kategori Produk <?= $semuadata[0]['nama_kategori']?></h3>
                     <div class="row">
                         <?php  $ambiltotal = $koneksi->query("SELECT * FROM produk_sewa WHERE id_kategori='$id_kategori'");
                                $pecahtotal = $ambiltotal->fetch_assoc();
                         ?>
                     <?php if(!isset($pecahtotal)):
                             echo "<span class='alert alert-danger'><h5>Produk dengan kategori ini tidak tersedia</h5></span>";
                        else:
                        ?>
                        <?php foreach($semuadata as $key => $perproduk):?>
                        <div class="col-lg-3 col-xs-12 col-sm-6 mb-3">
                            <div class="card">
                                <img class="card-img-top" src="foto_produksewa/<?= $perproduk['foto_produksewa']?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="detailsewa.php?&id=<?=$perproduk['id_produksewa']?>"><?= $perproduk['nama_produksewa']?></a></h5>
                                    <h6 class="card-title"><i class=" fa fa-user"> <?=$perproduk['nama_user']?></i></h6>
                                    <h6 class="card-title">Rp. <?= number_format($perproduk['harga_produksewa'])?>/ Hari</h6>
                                    <?php if($perproduk['status_produksewa']=='Tersedia'):?>
                                    <a href="https://api.whatsapp.com/send?phone=<?=$perproduk['tlp_user']?>"><button class="btn btn-primary">Sewa</button></a>
                                    <a href="detailsewa.php?&id=<?=$perproduk['id_produksewa']?>" class="btn btn-secondary">Detail</a>
                                    <?php else :?>
                                    <p class="text-danger">Produk tidak tersedia</p>
                                    <?php endif?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php endif?>
                     </div>
                </div>
            </div>
            
        </div>
        <!-- main content -->
        <!-- ========================= SECTION  END// ========================= -->
        <!-- footer -->
        <?php include 'footer.php'; ?>
        <!-- end footer -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <script src="assets/js/bootstrap.min.js"></script>
        </body>

</html>