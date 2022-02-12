<?php include 'koneksi.php';
session_start();
$tiapfoto=[];
$id_user = $_SESSION['user']['id_user'];
//koneksi mengambil id user 
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
    echo "<script>alert('Anda tidak bisa menghapus produk ini!!')</script>";
    echo "<script>location='berandasewa.php'</script>";
    exit();
}
?>

<?php
//koneksi mengambil foto berikutnya idproduk untuk dihapus
$ambilfoto = $koneksi->query("SELECT * FROM produksewa_foto WHERE id_produksewa=$_GET[id]");
while($pecahfoto = $ambilfoto->fetch_assoc()){
    $tiapfoto[]=$pecahfoto;
}?>
<pre><?php print_r($tiapfoto) ?></pre>
<?php foreach($tiapfoto as $key =>$value):?>
<?php
if(file_exists("foto_produksewa/$value[nama_foto_produksewa]")){
    unlink("foto_produksewa/$value[nama_foto_produksewa]");
}
$koneksi->query("DELETE FROM produksewa_foto WHERE id_produksewa_foto=$value[id_produksewa_foto]");
?>
<?php endforeach?>
<?php
//mengambil foto utama

if(file_exists("foto_produksewa/$pecah[foto_produksewa]")){
    unlink("foto_produksewa/$pecah[foto_produksewa]");
}
$koneksi->query("DELETE FROM produk_sewa WHERE id_produksewa=$_GET[id]");
echo "<script>alert('Produk Terhapus');</script>";
echo "<script>location='berandasewa.php';</script>";
?>
