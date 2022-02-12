<?php include 'koneksi.php';
session_start();
?>

<?php include 'navbar.php';?>
        <!-- ========================= SECTION  ========================= -->
        <!-- judul -->
        <div class="jumbotron color-grey-light mt-70">
		      <div class="d-flex align-items-center h-100">
		        <div class="container text-center py-5">
		          <h3 class="mb-0">Sign Up</h3>
		        </div>
		      </div>
		    </div>
        <!-- end judul -->
        <!-- main content -->
        <div class="container">

<!--Grid row-->
<div class="row d-flex justify-content-center">

  <!--Grid column-->
  <div class="col-md-6">

    <!--Section: Content-->
    

      <form action="" method="post">

        <div class="md-form md-outline">
            <label  for="nama_user">Nama</label>
          <input type="text" name="nama" required class="form-control">
        </div>
        <div class="md-form md-outline">
            <label  for="email_user">Email</label>
          <input type="text" name="email" required class="form-control">
        </div>
        <div class="md-form md-outline">
            <label  for="username_user">Username</label>
          <input type="text" name="username" required class="form-control">
        </div>
        <div class="md-form md-outline">
            <label  for="tlp_user">Nomor Telepon</label>
          <input type="text" name="tlp" required placeholder="Gunakan kode telepon internasional (+62)" class="form-control">
        </div>
        <div class="md-form md-outline">
            <label  for="alamat_user">Alamat</label>
          <textarea name="alamat" class="form-control" required cols="30" rows="5"></textarea>
        </div>
        <div class="md-form md-outline">
            <label data-error="wrong" data-success="right" for="defaultForm-pass1">Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div class="text-center pb-2 mt-3">
          <button type="submit" class="btn btn-primary mb-4 waves-effect waves-light" name="signup">Sign Up</button>
        </div>
      </form>
      <?php
      //jika tombol signup ditekan
      if(isset($_POST['signup'])){
          //mengambil isi dari inputan user
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $username = $_POST['username'];
          $tlp = $_POST['tlp'];
          $alamat = $_POST['alamat'];
          $password = $_POST['password'];
          //cek apakah email username, dan nomor telepon sudah ada
          $ambil1 = $koneksi->query("SELECT * FROM  user WHERE email_user='$email'");
          $sama1 = $ambil1->num_rows;
          if($sama1==1){
              echo "<script>alert('Gagal registrasi, email sudah pernah digunakan')</script>";
              echo "<script>location='register.php'</script>";
            }else{
                $ambil2 = $koneksi->query("SELECT * FROM  user WHERE username_user='$username'");
                $sama2 = $ambil2->num_rows;
                if($sama2==1){
                    echo "<script>alert('Gagal registrasi, username sudah pernah digunakan')</script>";
                    echo "<script>location='register.php'</script>";
                }else{
                    $ambil3 = $koneksi->query("SELECT * FROM  user WHERE tlp_user='$tlp'");
                    $sama3 = $ambil3->num_rows;
                    if($sama3==1){
                        echo "<script>alert('Gagal registrasi, Nomor Telepon sudah pernah digunakan')</script>";
                        echo "<script>location='register.php'</script>";
                    }else{
                        //masukan ke dalam database
                        $koneksi->query("INSERT INTO user (username_user,password_user,nama_user,email_user,tlp_user,alamat_user) VALUES ('$username','$password','$nama','$email','$tlp','$alamat')");
                        echo "<script>alert('Registrasi berhasil!!, silahkan login')</script>";
                        echo "<script>location='login.php'</script>";
                    }
                }
            }



      }
      ?>
    
    <!--Section: Content-->

  </div>
  <!--Grid column-->

</div>
<!--Grid row-->


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