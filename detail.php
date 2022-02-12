<?php
include 'koneksi.php';
session_start();
//ambil id produk dari url
$id_produk = $_GET["id"];
//query ke database untuk mendapatkan informasi produk
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$pecah= $ambil->fetch_assoc();
// var_dump($pecah);
//ambil data semua foto produk
$semuafoto = [];
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk ='$id_produk'");
while($pecahfoto = $ambilfoto->fetch_assoc()){
  $semuafoto []= $pecahfoto;
}
?>
<!-- <pre><?php print_r($semuafoto)?></pre> -->
    <?php include 'navbar.php'?>
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
            <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Detail Produk</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->
        <!-- main content -->

            <div class="container main">
                <div class="row">
                    <div class="col-md-6">
                        <img src="foto_produk/<?=$pecah['foto_produk']?>" class="jumbo"  style="width:100%">
                    </div>
                    <div class="col-md-6">
                        <h2><?=$pecah['nama_produk']?></h2>
                        <h4>Rp.<?=number_format($pecah['harga_produk']);?></h4>
                        <h5>Stok : <?=$pecah['stok_produk']?></h5>
                        <p><?=$pecah['spesifikasi_produk']?></p>
                        <?php if($pecah['stok_produk']!=='0'): ?>
                        <form action="" method="post">
                            <div class="input-group">
                                <label for="Qty">Qty : </label>
                                <div class="col-auto">
                                    <input type="number" name="qty" value="1" class="form-control input-sm" min="1" max="<?=$pecah['stok_produk']?>">
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" name="beli">Beli</button>
                            <?php else: ?>
                                <p class="text-danger">Stok Produk Kosong</p>
                            <?php endif ?>
                        </form>
                        <?php
                        //jika tombol beli diklik
                        if(isset($_POST['beli'])){
                            //mendapatkan jumlah yang diinputkan
                            $jumlah=$_POST['qty'];
                            //masukan ke keranjang belanja
                            $_SESSION['keranjang'][$id_produk]=$jumlah;
                            echo "<script>alert('Produk berhasil masuk ke kanjang belanja')</script>";
                            echo "<script>location='keranjang.php'</script>";
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                        <div class="mx-2"></div>
                        <?php foreach($semuafoto as $key =>$tiapfoto): ?>
                                  <img src="foto_produk/<?=$tiapfoto['nama_produk_foto']?>" class="thumb" alt="">
                              <?php endforeach ?>
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
        <script>
          const container = document.querySelector('.main');
          const jumbo = document.querySelector('.jumbo');
          const thumbs = document.querySelectorAll('.thumb');
          container.addEventListener('click', function(e) {
              if (e.target.className == 'thumb') {
                  jumbo.src = e.target.src;
                  jumbo.classList.add('fade');
                  setTimeout(function() {
                      jumbo.classList.remove('fade');
                  }, 500)
                  thumbs.forEach(function(thumb) {
                      // if (thumb.target.classList.contains('active')) {
                      //     thumb.target.classList.remove('active');
                      // }
                      thumb.className = 'thumb';
                  });
                  e.target.classList.add('display'); 
              }
          })
        </script>
        </body>

</html>