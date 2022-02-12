<?php include 'koneksi.php';
session_start();
$id_user = $_SESSION['user']['id_user'];
?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
<?php
$ambildata=[];
$ambil = $koneksi->query("SELECT * FROM kategori");
while($pecah = $ambil->fetch_assoc()){
    $ambildata[]=$pecah;
}
?>
<!-- <pre><?php print_r($_SESSION['user'])?></pre> -->
<!-- ========================= SECTION  ========================= -->
<!-- judul -->
<div class="jumbotron color-grey-light mt-70">
    <div class="d-flex align-items-center h-100">
        <div class="container text-center py-5">
            <h3 class="mb-0">Tambah Penyewaan Produk</h3>
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
                        <option value="<?=$value['id_kategori']?>"><?=$value['nama_kategori']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_Produk">Nama Produk</label>
                    <input type="text" required class="form-control" name="nama">
                </div>
                <div class="form-group">
                    <label for="harga_Produk">Harga Sewa Produk / hari (Rp)</label>
                    <input type="number" min="0" required class="form-control" name="harga">
                </div>
                <div class="form-group">
                    <label for="spesifikasi_Produk">Spesifikasi Produk</label>
                    <textarea name="spesifikasi" required class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="foto_Produk">Foto Produk</label>
                    <div class="letak-input" style="margin-bottom: 10px;">
                        <input type="file" class="form-control" name="foto[]">
                    </div>
                    <span class="btn btn-primary btn-tambah"><a class="fa fa-plus"></a></span>
                </div>
                <button name="simpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php if(isset($_POST["simpan"])){
    $namanamafoto = $_FILES['foto']['name'];
    $lokasilokasifoto = $_FILES['foto']['tmp_name'];
    //mengganti nama foto 
    $nama_foto_baru = [];
    foreach($namanamafoto as $key =>$value){
        $nama_foto_baru []= date("YmdHis").$value;
    }
    move_uploaded_file($lokasilokasifoto[0],"foto_produksewa/".$nama_foto_baru[0]);
    $koneksi->query("INSERT INTO produk_sewa (id_kategori,id_user,nama_produksewa,harga_produksewa,spesifikasi_produksewa,foto_produksewa) VALUES('$_POST[kategori]','$id_user','$_POST[nama]','$_POST[harga]','$_POST[spesifikasi]','$nama_foto_baru[0]')");
    
    //mendapatkan id produk barusan
    $idprodukbaru = $koneksi->insert_id;
    
    foreach($nama_foto_baru as $key => $tiap_nama){
        $tiap_lokasi = $lokasilokasifoto[$key];
        move_uploaded_file($tiap_lokasi,"foto_produksewa/".$tiap_nama);
        
        //simpan ke database sesuai dengan id produk
        $koneksi->query("INSERT INTO produksewa_foto (id_produksewa,nama_foto_produksewa) VALUES ('$idprodukbaru','$tiap_nama')");
    }
    
    echo "<script>alert('Data Tersimpan')</script>";
    echo "<script>location='berandasewa.php'</script>";
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
<script>
    $(document).ready(function() {
        $(".btn-tambah").on('click', function() {
            $(".letak-input").append("<input type='file' class='form-control' name='foto[]'>")
        })
    })
</script>
</body>

</html>