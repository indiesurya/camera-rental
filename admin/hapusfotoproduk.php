<?php
$id_foto = $_GET['idfoto'];
$id_produk = $_GET['idproduk'];

//mengambil data foto dari database
$ambil = $koneksi->query("SELECT * FROM produk_foto LEFT JOIN produk ON produk_foto.id_produk=produk.id_produk WHERE produk_foto.id_produk_foto='$id_foto'");
$pecah = $ambil->fetch_assoc();

//mengambil data foto utama dan foto yang ingin dihapus

$namafotodihapus = $pecah['nama_produk_foto'];
$namafotoutama = $pecah['foto_produk'];
//cek apakah foto yang dihapus adalah foto utama
if($namafotodihapus == $namafotoutama){
    //menghapus foto dari folder
    unlink("../foto_produk/".$namafotodihapus);
    // menghapus foto dalam database
    $koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto'");
    //mencari foto pengganti untuk foto utama
    $foto = [];
    $ambilfoto = $koneksi->query("SELECT * FROM produk_Foto WHERE id_produk='$id_produk'");
    while($pecahfoto = $ambilfoto->fetch_assoc()){
        $foto[]= $pecahfoto;
    }
    //ganti foto utama dengan foto berikutnya
    foreach($foto as $key =>$tiapfoto){
        if(empty($fotoutama)){
            $fotoutama = $tiapfoto['nama_produk_foto'];
        }
    }
    //masukan foto utama terbaru ke database
    $koneksi->query("UPDATE produk SET foto_produk='$fotoutama' WHERE id_produk='$id_produk'");
}else{

//menghapus foto dari folder
unlink("../foto_produk/".$namafotodihapus);
//menghapus foto dalam database
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto'");
}

//redirect

echo "<script>alert('Foto Produk Terhapus');</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
?>
<pre><?php print_r($pecah)?></pre>
<pre><?php print_r($foto)?></pre>
