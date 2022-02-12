<div class="panel-headline">
    <div class="panel-heading">
        <h2>Edit User</h2>
    </div>
    <div class="panel-body">
        <?php $ambil = $koneksi->query("SELECT * FROM user WHERE id_user='$_GET[id]'");
        $pecah = $ambil->fetch_assoc();?>
        <form method="post">
            <div class="form-group">
                <label for="nama_user">Nama</label>
                <input type="text" value="<?=$pecah['nama_user']?>" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label for="username_user">Username</label>
                <input type="text" value="<?=$pecah['username_user']?>" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="password_user">Password</label>
                <input type="text" value="<?=$pecah['password_user']?>" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="email_user">Email</label>
                <input type="email" value="<?=$pecah['email_user']?>" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="tlp_user">Nomor Telepon</label>
                <input type="text" value="<?=$pecah['tlp_user']?>" class="form-control" name="tlp">
            </div>
            <div class="form-group">
                <label for="alamat_user">Alamat</label>
                <input type="text" value="<?=$pecah['alamat_user']?>" class="form-control" name="alamat">
            </div>
            <button class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>
</div>
<?php if(isset($_POST["simpan"])){
    $koneksi->query("UPDATE user SET nama_user='$_POST[nama]',username_user='$_POST[username]',password_user='$_POST[password]',email_user='$_POST[email]',tlp_user='$_POST[tlp]',alamat_user='$_POST[alamat]' WHERE id_user='$_GET[id]'");
    echo"<script>alert('User berhasil dirubah');</script>";
    echo"<script>location='index.php?halaman=user';</script>";    
    }
    ?>