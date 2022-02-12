<?php include 'koneksi.php';
session_start();
$data= [];
$id_user = $_SESSION['user']    
?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
<?php $ambil = $koneksi->query("SELECT * FROM produk_sewa LEFT JOIN kategori ON produk_sewa.id_kategori=kategori.id_kategori WHERE produk_sewa.id_user='$id_user'");
  while($pecah = $ambil->fetch_assoc()){
           $data[]=$pecah;
        }
  ?>
        <!-- <pre><?php print_r($_SESSION['user'])?></pre> -->
      <!-- <pre><?php print_r($data)?></pre> -->
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
        <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Dashboard Penyewaan</h3>
		        </div>
		      </div>
        </div>
        <!-- end judul -->
        <!-- main content -->
        <div class="container">
        <h3>Nama Pelanggan : <?=$_SESSION['user']['nama_user']?></h3>
        <table class="table table-striped mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                    <th>Foto Produdk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $key =>$value):
                    ?>
                <tr>
                    <th><?=$key+1?></th>
                    <td><?= $value['nama_kategori'];?></td>
                    <td style="width: 10%;"><?= $value['nama_produksewa'];?></td>
                    <td>Rp.<?= number_format($value['harga_produksewa']);?></td>
                    <td style="width: 25%;"><?= $value['spesifikasi_produksewa'];?></td>
                    <?php if($value['status_produksewa']=="Tersedia"):?>
                    <td><span class="badge badge-success"><?= $value['status_produksewa'];?></span></td>
                    <?php else:?>
                      <td><span class="badge badge-danger"><?= $value['status_produksewa'];?></span></td>
                    <?php endif ?>
                    <td><img src="foto_produksewa/<?= $value['foto_produksewa'];?>" width="150px"></td>
                    <td style="width: 15%;"><a href="hapusproduksewa.php?id=<?=$value['id_produksewa']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</a>
                        <a href="editproduksewa.php?id=<?=$value['id_produksewa']?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="detailproduksewa.php?id=<?=$value['id_produksewa']?>" class="btn btn-info btn-sm mt-2"><i class="fa fa-search"></i> Detail</a></td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
        <a href="tambahproduksewa.php" class="btn btn-primary ">Tambah Produk</a>
        </div>
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