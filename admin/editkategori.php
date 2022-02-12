
<?php 
$id_kategori = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
$pecah = $ambil->fetch_assoc();?>
<div class="panel-headline">
    <div class="panel-heading">
        <h2>Edit Kategori</h2>
    </div>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input value="<?=$pecah['nama_kategori']?>" type="text" name="nama" class="form-control"> 
                </div>
                <button name="simpan" class="btn btn-primary">Simpan</button>
                <?php if(isset($_POST["simpan"])){
                    $koneksi->query("UPDATE kategori SET nama_kategori='$_POST[nama]' WHERE id_kategori='$id_kategori'");
                    echo '<div class="alert alert-info">Data Tersimpan</div>';
                    echo '<meta http-equiv="refresh" content="1;url=index.php?halaman=kategori">';
                }
                ?>
            </form>
        </div>
    </div>
</div>