<?php include 'koneksi.php';
session_start();
$id_user = $_SESSION['user']['id_user'];
$id_produk = $_GET['id'];
//koneksi mengambil data produk
$ambil = $koneksi->query("SELECT * FROM produk_sewa WHERE id_produksewa=$_GET[id]");
$pecah = $ambil->fetch_assoc();
?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} 
else if($id_user !==$pecah['id_user']){
    echo "<script>alert('Anda tidak bisa mengedit produk ini!!')</script>";
    echo "<script>location='berandasewa.php'</script>";
    exit();
} ?>
<?php
$ambildata=[];
$ambilkategori = $koneksi->query("SELECT * FROM kategori");
while($pecahkategori = $ambilkategori->fetch_assoc()){
    $ambildata[]=$pecahkategori;
}
?>
<!-- <pre><?php print_r($_SESSION['user'])?></pre> -->
<!-- ========================= SECTION  ========================= -->
<!-- judul -->
<div class="jumbotron color-grey-light mt-70">
    <div class="d-flex align-items-center h-100">
        <div class="container text-center py-5">
            <h3 class="mb-0">Edit Penyewaan Produk</h3>
        </div>
    </div>
</div>
<!-- end judul -->
<!-- main content -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="kategori">Nama Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                    <?php foreach($ambildata as $key =>$value): 
                    ?>
                        <option value="<?=$value['id_kategori']?>"<?php if($pecah['id_kategori']==$value['id_kategori']){echo "selected";}?>><?=$value['nama_kategori']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_Produk">Nama Produk</label>
                    <input type="text" required class="form-control" value="<?=$pecah['nama_produksewa']?>" name="nama">
                </div>
                <div class="form-group">
                    <label for="harga_Produk">Harga Sewa Produk / hari (Rp)</label>
                    <input type="number" min="0" required class="form-control" value="<?=$pecah['harga_produksewa']?>" name="harga">
                </div>
                <div class="form-group">
                    <label for="spesifikasi_Produk">Spesifikasi Produk</label>
                    <textarea name="spesifikasi" required class="form-control" cols="30" rows="10"><?=$pecah['spesifikasi_produksewa']?></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status Produk</label>
                    <select name="status" id="" class="form-control">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
                </div>
                <div class="form-group">
                    <img src="foto_produksewa/<?=$pecah['foto_produksewa']?>" alt="" style="width: 80%;"><br>
                    <label for="foto_Produk">Ubah Foto Produk</label>
                    <div class="letak-input" style="margin-bottom: 10px;">
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <button name="simpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php if(isset($_POST["simpan"])){
    $namafoto = $_FILES['foto']['name'];
    $namafoto = date("YmdHis").$namafoto;
    $lokasi = $_FILES['foto']['tmp_name'];
    //jika foto dirubah
    if(!empty($lokasi)){
        move_uploaded_file($lokasi,"foto_produksewa/$namafoto");
        $koneksi->query("UPDATE produk_sewa SET id_kategori='$_POST[kategori]',nama_produksewa='$_POST[nama]',harga_produksewa='$_POST[harga]',spesifikasi_produksewa='$_POST[spesifikasi]',status_produksewa='$_POST[status]',foto_produksewa='$namafoto' WHERE id_produksewa='$id_produk'");
    }else{
        $koneksi->query("UPDATE produk_sewa SET id_kategori='$_POST[kategori]',nama_produksewa='$_POST[nama]',harga_produksewa='$_POST[harga]',spesifikasi_produksewa='$_POST[spesifikasi]',status_produksewa='$_POST[status]' WHERE id_produksewa='$id_produk'");
    }
    echo"<script>alert('Produk berhasil dirubah');</script>";
    echo"<script>location='berandasewa.php';</script>";
    }
?>
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