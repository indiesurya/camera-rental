<?php
session_start();
include 'koneksi.php';
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong silahkan belanja terlebih dahulu')</script>";
    echo "<script>location='index.php'</script>";
}?>
    <?php include 'navbar.php'?>
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
            <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Keranjang Belanja</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->
        <!-- main content -->
        
        <div class="container mt-3">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1;?>
                    <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah):?>
                        <!-- menampilkan produk yang sedang diperulangkan berdasarkan id produk -->
                    <?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'")?>
                    <?php $pecah = $ambil->fetch_assoc();?>
                    <?php $subtotal=$pecah['harga_produk']*$jumlah;?>
                    <tr>
                        <th><?=$nomor?></th>
                        <td><?=$pecah['nama_produk']?></td>
                        <td>Rp.<?=number_format($pecah['harga_produk'])?></td>
                        <td><?=$jumlah?></td>
                        <td>Rp.<?=number_format($subtotal)?></td>
                        <td><a href="hapuskeranjang.php?id=<?=$id_produk?>">  <i class="fa fa-trash-o" style="font-size:24px;color:red"></i></a></td>
                    </tr>
                    <?php $nomor++;?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="tombol pull-right mt-3">
                <a href="index.php" class="btn btn-secondary ">Lanjutkan Belanja</a>
                <a href="checkout.php" class="btn btn-primary ">Checkout</a>
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