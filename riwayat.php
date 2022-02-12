<?php include 'koneksi.php';
session_start()?>

<?php include 'navbar.php'?>
<!-- jika tidak ada session pelanggan -->
<?php if(!isset($_SESSION['user'])OR empty($_SESSION['user'])){
    echo "<script>alert('Silahkan login terlebih dahulu!!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
} ?>
    <!-- <pre><?php print_r($_SESSION['user'])?></pre> -->
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
        <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Riwayat Belanja</h3>
		        </div>
		      </div>
        </div>
        <div class="container">
            <h3>Nama Pelanggan : <?=$_SESSION['user']['nama_user']?></h3>
            <table class="table table-striped">
                <thead class="thead thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //mendapatkan id pelanggan yang login
                    $nomor = 1;
                    $id_user = $_SESSION['user']['id_user'];
                    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_user='$id_user'");
                    while($pecah = $ambil->fetch_assoc()){
                    $status=$pecah['status_pembelian']?>
                    <tr>
                        <th><?=$nomor?></th>
                        <td><?=$pecah['tanggal_pembelian']?></td>
                        <?php if($status=="pending"):
                        ?>
                        <td>
                            <span class="badge badge-info"><?=$status?></span>
                        </td>
                        <?php elseif($status=="Sudah mengirim pembayaran"): ?>
                        <td>
                            <span class="badge badge-primary"><?=$status?></span>
                        </td>
                        <?php elseif($status=="Batal"): ?>
                        <td>
                            <span class="badge badge-danger"><?=$status?></span>
                        </td>

                        <?php else:?>
                        <td>
                            <span class="badge badge-success"><?=$status?></span>
                            <br>
                            <?php if(!empty($pecah['resi_pengiriman'])):?>
                            Resi : <?=$pecah['resi_pengiriman'];?>
                            <?php endif ?>
                        </td>
                        <?php endif ?>
                        
                        <td>Rp.<?=number_format($pecah['total_pembelian'])?></td>
                        <td><a href="nota.php?id=<?=$pecah['id_pembelian']?>" class="btn btn-info">Nota</a>
                        <?php if($status=="pending"):?>
                        <a href="pembayaran.php?id=<?=$pecah['id_pembelian']?>" class="btn btn-primary">Pembayaran</a></td>
                        <?php elseif($status=="Batal"):?>
                            </td>
                        <?php else:?>
                        <a href="lihatpembayaran.php?id=<?=$pecah['id_pembelian']?>" class="btn btn-success">Lihat Pembayaran</a></td>
                        <?php endif ?>
                        </tr>
                <?php 
            $nomor++;
            } ?>
                </tbody>
            </table>
        </div>
        <!-- end judul -->
        <!-- main content -->
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