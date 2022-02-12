<?php
session_start();

//menghancurkan $_SESSION['user']
session_destroy();
echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='index.php';</script>";
?>