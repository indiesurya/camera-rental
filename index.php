<?php
session_start();
include 'koneksi.php';
// var_dump($_SESSION['user'])
?>
<?php include 'navbar.php'?>

<div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/img/WEB1.png" width="1100" height="500">
        </div>
        <div class="carousel-item">
            <img src="assets/img/WEB2.jpg" width="1100" height="500">
        </div>
        <div class="carousel-item">
            <img src="assets/img/WEB3.jpg" width="1100" height="500">
        </div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<!-- content -->
<div class="container mt-3">
    <h2>Produk Terbaru</h2>
    <div class="row">
        <?php $i=1;
        $ambil = $koneksi->query("SELECT * FROM produk ORDER BY id_produk DESC ");?>
        <?php  while($perproduk = $ambil->fetch_assoc()){?>
        <?php if($i<=8): ?>
        <div class="col-lg-3 col-xs-12 col-sm-6 mb-3">
            <div class="card">
                <img class="card-img-top" src="foto_produk/<?= $perproduk['foto_produk']?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><a href="detail.php?&id=<?=$perproduk['id_produk']?>"><?= $perproduk['nama_produk']?></a></h5>
                    <h6 class="card-title">Rp. <?= number_format($perproduk['harga_produk'])?></h6>
                    <?php if($perproduk['stok_produk']!=='0'):?>
                    <a href="beli.php?id=<?=$perproduk['id_produk']?>"><button class="btn btn-primary">Beli</button></a>
                    <a href="detail.php?&id=<?=$perproduk['id_produk']?>" class="btn btn-secondary">Detail</a>
                    <?php else :?>
                    <p class="text-danger">Stok Produk Kosong</p>
                    <?php endif?>
                </div>
            </div>
        </div>
        <?php $i++;
        endif;
    } ?>
    </div>
</div>
<!-- content-->
<!-- footer -->
<?php include 'footer.php'; ?>
<!-- end footer -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // executes when HTML-Document is loaded and DOM is ready
        console.log("document is ready");


        $(".card").hover(
            function() {
                $(this).addClass('shadow-lg').css('cursor', 'pointer');
            },
            function() {
                $(this).removeClass('shadow-lg');
            }
        );

        // document ready  
    });
</script>
</body>

    </html>