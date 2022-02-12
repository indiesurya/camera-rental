

<div class="panel-headline">
    <div class="panel-heading">
        <h2>Edit Produk</h2>
    </div>
</div>
<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
var_dump($pecah);
?>
<?php
$ambildata=[];
$ambilkategori = $koneksi->query("SELECT * FROM kategori");
while($pecahkategori = $ambilkategori->fetch_assoc()){
    $ambildata[]=$pecahkategori;
}
?>
<div class="panel-body">
    <form method="post" enctype="multipart/form-data">
         <div class="form-group">
                <label for="kategori">Nama Kategori</label>
                <select name="kategori" class="form-control">
                <?php foreach($ambildata as $key =>$value): 
                ?>
                    <option value="<?=$value['id_kategori']?>"<?php if($pecah['id_kategori']==$value['id_kategori']){echo "selected";}?>>
                    
                    <?=$value['nama_kategori']?></option>
                    <?php endforeach?>
                </select>
            </div>
        <div class="form-group">
            <label for="nama_Produk">Nama Produk</label>
            <input type="text" value="<?=$pecah['nama_produk'];?>" class="form-control" name="nama">
        </div>
        <div class="form-group">
            <label for="harga_Produk">Harga Produk (Rp)</label>
            <input type="number" min="0" value="<?=$pecah['harga_produk'];?>" class="form-control" name="harga">
        </div>
        <div class="form-group">
            <label for="stok_Produk">Stok Produk</label>
            <input type="number" min="0" value="<?=$pecah['stok_produk'];?>" class="form-control" name="stok">
        </div>
        <div class="form-group">
            <label for="berat_Produk">Berat Produk(Gr)</label>
            <input type="number" min="0" value="<?=$pecah['berat_produk'];?>" class="form-control" name="berat">
        </div>
        <div class="form-group">
            <label for="spesifikasi_Produk">Spesifikasi Produk</label>
            <textarea name="spesifikasi" class="form-control" cols="30" rows="10"><?=$pecah['spesifikasi_produk'];?></textarea>
        </div>
        <div class="form-group">
            <img src="../foto_produk/<?=$pecah['foto_produk'];?>" width="200px">
        </div>
        <div class="form-group">
            <label for="foto_produk">Ganti Foto Produk</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?php if(isset($_POST["simpan"])){
    $namafoto = $_FILES['foto']['name'];
    $namafoto = date("YmdHis").$namafoto;
    $lokasi = $_FILES['foto']['tmp_name'];
    //jika foto diruabah
    if(!empty($lokasi)){
        move_uploaded_file($lokasi,"../foto_produk/$namafoto");
        $koneksi->query("UPDATE produk SET id_kategori='$_POST[kategori]',nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',stok_produk='$_POST[stok]',berat_produk='$_POST[berat]',spesifikasi_produk='$_POST[spesifikasi]',foto_produk='$namafoto' WHERE id_produk='$_GET[id]'");
    }else{
        $koneksi->query("UPDATE produk SET id_kategori='$_POST[kategori]',nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',stok_produk='$_POST[stok]',berat_produk='$_POST[berat]',spesifikasi_produk='$_POST[spesifikasi]' WHERE id_produk='$_GET[id]'");
    }
    echo"<script>alert('Produk berhasil dirubah');</script>";
    echo"<script>location='index.php?halaman=produk';</script>";
    }
?>