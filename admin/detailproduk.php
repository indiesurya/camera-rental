<?php $id_produk =  $_GET['id'];
    //mengambil data produk
    $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_produk='$id_produk'");
    $detail_produk = $ambil->fetch_assoc();
    //mengambil data foto
    $ambil = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
    $semuafoto=[];
    while($pecah = $ambil->fetch_assoc()){
        $semuafoto[]=$pecah;
    }
?>
    <!-- <pre><?php print_r($detail_produk)?></pre>
    <pre><?php print_r($semuafoto)?></pre> -->
<div class="panel-headline">
    <div class="panel-heading">
        <h2>Detail Produk</h2>
    </div>
</div>
<div class="panel-body">
    <table class="table table-striped">
        <tr>
            <th>Kategori</th>
            <td><?=$detail_produk['nama_kategori']?></td>
        </tr>
        <tr>
            <th>Nama Produk</th>
            <td><?=$detail_produk['nama_produk']?></td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp.<?=number_format($detail_produk['harga_produk'])?></td>
        </tr>
        <tr>
            <th>Berat</th>
            <td><?=number_format($detail_produk['berat_produk'])?> Gr</td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td><?=$detail_produk['spesifikasi_produk']?></td>
        </tr>
        <tr>
            <th>Stok</th>
            <td><?=$detail_produk['stok_produk']?></td>
        </tr>
    </table>
    <div class="row">
            <?php foreach($semuafoto as $key =>  $tiap_foto):?>
            <div class="col-md-3 text-center">
                <img src="../foto_produk/<?=$tiap_foto['nama_produk_foto']?>"class="img-responsive" style="width:100%;height:150px;margin-bottom:15px;">
            <a href="index.php?halaman=hapusfotoproduk&idfoto=<?=$tiap_foto['id_produk_foto']?>&idproduk=<?=$id_produk?>" class="btn btn-danger btn-sm">Hapus</a>
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
        </form>
    </div>
</div>
<?php
if(isset($_POST['simpan'])){
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    $namafotobaru = date("YmdHis").$namafoto;
    //upload
    move_uploaded_file($lokasifoto,"../foto_produk/".$namafotobaru);
    //query 
    $koneksi->query("INSERT INTO produk_foto (id_produk,nama_produk_foto) VALUES ('$id_produk','$namafotobaru')");


    echo "<script>alert('Foto Produk Berhasil Disimpan');</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
}
?>