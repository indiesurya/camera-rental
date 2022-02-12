<?php
session_start();

include 'koneksi.php';
$id_produk = $_GET['id'];
//ambil data produk
$ambil = $koneksi->query("SELECT * FROM produk_sewa LEFT JOIN user ON produk_sewa.id_user=user.id_user WHERE produk_sewa.id_produksewa='$id_produk'");
$pecah = $ambil->fetch_assoc();
//ambil data semua foto produk
$ambilfoto = $koneksi->query("SELECT * FROM produksewa_foto WHERE id_produksewa ='$id_produk'");
while($pecahfoto = $ambilfoto->fetch_assoc()){
  $semuafoto []= $pecahfoto;
}
?>
<!-- <pre><?php print_r($pecah)?></pre> -->
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
                        <img src="foto_produksewa/<?=$pecah['foto_produksewa']?>" class="jumbo"  >
                    </div>
                    <div class="col-md-6">  
                        <h2><?=$pecah['nama_produksewa']?></h2>
                        <h4>Rp.<?=number_format($pecah['harga_produksewa']);?> / Hari</h4>
                        <h5><i class="fa fa-user"></i> <?=$pecah['nama_user']?></h5>
                        <p><?=$pecah['spesifikasi_produksewa']?></p>
                        <?php if($pecah['status_produksewa']=='Tersedia'): ?>
                           <a href="https://api.whatsapp.com/send?phone=<?=$pecah['tlp_user']?>" class="btn btn-primary">Sewa</a>
                            <?php else: ?>
                                <p class="text-danger">Saat ini produk sedang tidak bisa disewa</p>
                            <?php endif ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                        <div class="mx-2"></div>
                        <?php foreach($semuafoto as $key =>$tiapfoto): ?>
                                  <img src="foto_produksewa/<?=$tiapfoto['nama_foto_produksewa']?>" class="thumb" alt="">
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