<?php
include 'koneksi.php';
session_start();
$id_foto = $_GET['id'];
$id_produk = $_GET['id_produksewa'];


//mengambil data foto dari database
$ambil = $koneksi->query("SELECT * FROM produksewa_foto LEFT JOIN produk_sewa ON produksewa_foto.id_produksewa=produk_sewa.id_produksewa WHERE produksewa_foto.id_produksewa_foto='$id_foto'");
$pecah = $ambil->fetch_assoc();
$id_user=$pecah['id_user'];
?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} 
else if($id_user !==$pecah['id_user']){
    echo "<script>alert('Anda tidak bisa menghapus detail produk ini!!')</script>";
    echo "<script>location='berandasewa.php'</script>";
    exit();
} ?>


<?php
//mengambil data foto utama dan foto yang ingin dihapus
$namafotodihapus = $pecah['nama_foto_produksewa'];
$namafotoutama = $pecah['foto_produksewa'];
//cek apakah foto yang dihapus adalah foto utama
if($namafotodihapus == $namafotoutama){
    //menghapus foto dari folder
    unlink("foto_produksewa/".$namafotoutama);
    // menghapus foto dalam database
    $koneksi->query("DELETE FROM produksewa_foto WHERE id_produksewa_foto='$id_foto'");
    //mencari foto pengganti untuk foto utama
    $foto = [];
    $ambilfoto = $koneksi->query("SELECT * FROM produksewa_foto WHERE id_produksewa='$id_produk'");
    while($pecahfoto = $ambilfoto->fetch_assoc()){
        $foto[]= $pecahfoto;
    }
    //ganti foto utama dengan foto berikutnya
    foreach($foto as $key =>$tiapfoto){
        if(empty($fotoutama)){
            $fotoutama = $tiapfoto['nama_foto_produksewa'];
        }
    }
    //masukan foto utama terbaru ke database
    $koneksi->query("UPDATE produk_sewa SET foto_produksewa='$fotoutama' WHERE id_produksewa='$id_produk'");
}else{

//menghapus foto dari folder
unlink("foto_produksewa/".$namafotodihapus);
//menghapus foto dalam database
$koneksi->query("DELETE FROM produksewa_foto WHERE id_produksewa_foto='$id_foto'");
}

//redirect

// echo "<script>alert('Foto Produk Terhapus');</script>";
// echo "<script>location='detailproduksewa.php?id=$id_produk';</script>";
?>

