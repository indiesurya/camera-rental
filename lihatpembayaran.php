<?php include 'koneksi.php';
session_start()?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
<!-- <pre>
    <?php print_r($_SESSION['user'])?>
</pre> -->

<!-- mendapatkan id dari pembelian -->
<?php $id_pembelian = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
    $pecah = $ambil->fetch_assoc();
    $status = $pecah['status_pembelian'];?>
<!-- mendapatkan id pelanggan yang beli jika user yang beli != user yang bayar maka keluar-->
<?php $id_pelanggan = $pecah['id_user'];
    if($id_pelanggan!==$_SESSION['user']['id_user']){
        echo "<script>alert('Anda tidak boleh masuk ke lihat pemmbayaran barang ini!!')</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
    }
    //cek apakah status pending atau batal, jika ya maka tidak bisa melihat detail pembayaran
    if($status=="pending"){
        echo "<script>alert('Anda belum melakukan pembayaran pada nota ini, silahkan bayar terlebih dahulu!!')</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
    }
    else if($status=="Batal"){
        echo "<script>alert('Nota ini sudah dibatalkan!!')</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
    } 
    ?>
<?php $ambil= $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
    $detail= $ambil->fetch_assoc();
    ?>
    <!-- <pre><?php print_r($detail)?></pre> -->
<!-- ========================= SECTION  ========================= -->
<!-- judul -->
<div class="jumbotron color-grey-light mt-70">
    <div class="d-flex align-items-center h-100">
        <div class="container text-center py-5">
            <h3 class="mb-0">Lihat Pembayaran</h3>
        </div>
    </div>
</div>
<!-- end judul -->
<!-- main content -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <tr>
                    <th>Nama</th>
                    <td><?=$detail['nama']?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?=$detail['bank']?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?=$detail['tanggal']?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp.<?=number_format($detail['jumlah'])?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <img src="bukti_pembayaran/<?=$detail['bukti']?>" alt="">
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