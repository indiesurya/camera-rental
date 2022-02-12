<?php
session_start();
$keyword = $_GET['keyword'];
include 'koneksi.php';
$semuadata = [];
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR spesifikasi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc()){
    $semuadata[]=$pecah;
};
?>
<!-- <pre><?php print_r($semuadata)?></pre> -->
    <?php include 'navbar.php'?>
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
            <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Pencarian Produk</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->
        <!-- main content -->
        <div class="container">
            <h3>Hasil Pencarian Produk <?=$keyword?> : <?=count($semuadata)?> buah </h3>
            <?php if(empty($semuadata)):?>
                <div class="alert alert-danger">Produk <strong><?=$keyword?></strong> Tidak Ditemukan</div>
            <?php endif ?>
            <div class="row">
                <?php foreach($semuadata as $key =>$value):?>
                
                <div class="col-lg-3 col-xs-12 col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="foto_produk/<?= $value['foto_produk']?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a href="detail.php?&id=<?=$value['id_produk']?>"><?= $value['nama_produk']?></a></h5>
                            <h6 class="card-title">Rp. <?= number_format($value['harga_produk'])?></h6>
                            <?php if($value['stok_produk']!=='0'):?>
                            <a href="beli.php?id=<?=$value['id_produk']?>"><button class="btn btn-primary">Beli</button></a>
                            <a href="detail.php?&id=<?=$value['id_produk']?>" class="btn btn-secondary">Detail</a>
                            <?php else :?>
                            <p class="text-danger">Stok Produk Kosong</p>
                            <?php endif?>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
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