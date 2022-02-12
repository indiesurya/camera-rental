<?php
session_start();
include 'koneksi.php';
error_reporting(0);
//mendapatkan produk id_produk dari url
$id_produk=$_GET['id'];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$pecah = $ambil->fetch_assoc();
$stok = $pecah['stok_produk'];
if($_SESSION['keranjang'][$id_produk] == $stok){
    echo "<script>alert('produk tidak bisa ditambahkan lagi karena stok produk hanya $stok buah, silahkan membeli produk lain')</script>";
    echo "<script>location='index.php'</script>";
}
//jika sudah ada produk itu dikeranjang maka produk itu jumlahnya ditambahkan 
else if(isset($_SESSION['keranjang'][$id_produk]) AND ($_SESSION['keranjang'][$id_produk]<$pecah['stok_produk']))
{
    $_SESSION['keranjang'][$id_produk]+=1;
}
else
{
   $_SESSION['keranjang'][$id_produk]=1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//ke halaman keranjang
echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php'</script>";
?>