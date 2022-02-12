<?php include 'koneksi.php';
session_start();
$id_user = $_SESSION['user']['id_user'];
$id_produk = $_GET['id'];
//koneksi mengambil data produk
$ambil = $koneksi->query("SELECT * FROM produk_sewa LEFT JOIN kategori ON produk_sewa.id_kategori=kategori.id_kategori WHERE produk_sewa.id_produksewa=$_GET[id]");
$pecah = $ambil->fetch_assoc();
//koneksi mengmabil data foto produk
$semuafoto;
$ambilfoto = $koneksi->query("SELECT * FROM produksewa_foto WHERE id_produksewa=$id_produk");
while($pecahfoto = $ambilfoto->fetch_assoc()){
    $semuafoto[]=$pecahfoto;
}

?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} 
else if($id_user !==$pecah['id_user']){
    echo "<script>alert('Anda tidak bisa melihat detail produk ini!!')</script>";
    echo "<script>location='berandasewa.php'</script>";
    exit();
} ?>
<!-- <pre><?php print_r($pecah)?></pre> -->
<!-- <pre><?php print_r($semuafoto)?></pre> -->
<!-- ========================= SECTION  ========================= -->
<!-- judul -->
<div class="jumbotron color-grey-light mt-70">
    <div class="d-flex align-items-center h-100">
        <div class="container text-center py-5">
            <h3 class="mb-0">Detail Penyewaan Produk</h3>
        </div>
    </div>
</div>
<!-- end judul -->
<!-- main content -->
<div class="container">
<table class="table table-striped">
        <tr>
            <th>Kategori</th>
            <td><?=$pecah['nama_kategori']?></td>
        </tr>
        <tr>
            <th>Nama Produk</th>
            <td><?=$pecah['nama_produksewa']?></td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp.<?=number_format($pecah['harga_produksewa'])?></td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td><?=$pecah['spesifikasi_produksewa']?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?=$pecah['status_produksewa']?></td>
        </tr>
    </table>
    <div class="row">
            <?php foreach($semuafoto as $key =>  $tiap_foto):?>
            <div class="col-md-3 text-center">
                <img src="foto_produksewa/<?=$tiap_foto['nama_foto_produksewa']?>"class="img-responsive" style="width:100%;height:150px;margin-bottom:15px;">
            <a href="hapusdetailfotosewa.php?id=<?=$tiap_foto['id_produksewa_foto']?>&id_produksewa=<?=$id_produk?>" class="btn btn-danger btn-sm">Hapus</a>
            </div>
            <?php endforeach ?>
        </div>
        <br>
        <form enctype="multipart/form-data" action="" method="post">
                <div class="form-group">
                    <label for="">Tambah Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                <a href="berandasewa.php" class=" btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php
if(isset($_POST['simpan'])){
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    $namafotobaru = date("YmdHis").$namafoto;
    //pindahkan file foto
    move_uploaded_file($lokasifoto,"foto_produksewa/".$namafotobaru);
    //query 
    $koneksi->query("INSERT INTO produksewa_foto (id_produksewa,nama_foto_produksewa) VALUES ('$id_produk','$namafotobaru')");
    echo "<script>alert('Foto Produk Berhasil Disimpan');</script>";
    echo "<script>location='detailproduksewa.php?id=$id_produk';</script>";
}
?>
<!-- main content -->
<!-- ========================= SECTION  END// ========================= -->
<?php include 'footer.php'; ?>
<!-- footer -->
<!-- end footer -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>