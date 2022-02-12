<?php include 'koneksi.php';
session_start()?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
    <!-- <pre><?php print_r($_SESSION['user'])?></pre> -->

    <!-- mendapatkan id dari pembelian -->
    <?php $id_pembelian = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
    $pecah = $ambil->fetch_assoc()?>
    <!-- mendapatkan id pelanggan yang beli jika user yang beli != user yang bayar maka keluar-->
    <?php $id_pelanggan = $pecah['id_user'];
    if($id_pelanggan!==$_SESSION['user']['id_user']){
        echo "<script>alert('Anda tidak boleh masuk ke konfirmasi pemmbayaran barang ini!!')</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
    }
    ?>
    <!-- <pre><?php print_r($pecah)?></pre> -->
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
        <div class="jumbotron color-grey-light mt-70">
            <div class="d-flex align-items-center h-100">
            <div class="container text-center py-5">
                <h3 class="mb-0">Konfirmasi Pembayaran</h3>
            </div>
            </div>
        </div>
        <!-- end judul -->
        <!-- main content -->
        <div class="container">
            <h3>Konfirmasi Pembayaran</h3>
            <p>Kirim bukti pembayaran anda disini</p>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert alert-info">Total tagihan anda<strong> Rp.<?=number_format($pecah['total_pembelian'])?></strong></p>
                    <form  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama Penyetor</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Bank</label>
                            <input type="text" name="bank" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah</label>
                            <input type="number" min="1" name="jumlah" class="form-control">
                        </div>
                        <div class="col-m-md-auto"></div>
                        <div class="form-group">
                            <label for="foto">Foto Bukti</label>
                            <input type="file"  name="foto" class="form-control">
                            <p class="text-danger">Foto bukti harus jpg maksimal 2MB</p>
                        </div>
                        <button class="btn btn-primary" name="upload">Upload</button>
                    </form>
                    <!-- jiak tombol upload ditekan -->
                    <?php
                    if(isset($_POST['upload'])){
                        //upload dulu foto buktinya
                        $nama_foto = $_FILES['foto']['name']; 
                        $lokasi_foto = $_FILES['foto']['tmp_name'];
                        $nama_foto_baru = date("YmdHis").$nama_foto;
                        move_uploaded_file($lokasi_foto,"bukti_pembayaran/$nama_foto_baru");
                        $tanggal = date("Y-m-d");
                        //simpan pembayaran
                        $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$id_pembelian','$_POST[nama]','$_POST[bank]','$_POST[jumlah]','$tanggal','$nama_foto_baru')");
                        //update status menjadi sudah mengirim pembayaran
                        $koneksi->query("UPDATE pembelian SET status_pembelian='Sudah mengirim pembayaran' WHERE id_pembelian='$id_pembelian'");
                        echo "<script>alert('Terima kasih sudah mengirimkan bukti pembayaran')</script>";
                        echo "<script>location='riwayat.php'</script>";
                    }
                    ?>
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