<footer class="page-footer font-small bg-dark">

    <div class="bg-light">
        <div class="container">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                    <h6 class="mb-0">Get connected with us on social networks!</h6>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row-->
            <div class="container">
                <a style="font-size:40px;margin-right:10px;margin-bottom:20px;" href="#" class="fa fa-twitter"></a>
                <a style="font-size:40px;margin-right:10px;margin-bottom:20px;" href="#" class="fa fa-google"></a>
                <a style="font-size:40px;margin-right:10px;margin-bottom:20px;" href="#" class="fa fa-youtube"></a>
                <a style="font-size:40px;margin-right:10px;margin-bottom:20px;" href="#" class="fa fa-instagram"></a>
            </div>
        </div>
    </div>


    <!-- Footer Links -->
    <div class="container text-center text-md-left pt-4 pt-md-5">

        <!-- Grid row -->
        <div class="row mt-1 mt-md-0 mb-4 mb-md-0 text-muted">

            <!-- Grid column -->
            <div class="col-md-3 mx-auto mt-3 mt-md-0 mb-0 mb-md-4">

                <!-- Links -->
                <h5>About us</h5>
                <hr class="color-primary mb-4 mt-0 d-inline-block mx-auto w-60">

                <ul class="list-unstyled foot-desc">
                    <li class="mb-2">
                        <a href="aboutus.php">About us</a>
                    </li>
                    <li class="mb-2">
                        <a href="#!">Terms of use</a>
                    </li>
                    <li class="mb-2">
                        <a href="#!">Privacy policy</a>
                    </li>
                </ul>
            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 mx-auto mt-3 mt-md-0 mb-0 mb-md-4">

                <!-- Links -->
                <h5>Your account</h5>
                <hr class="color-primary mb-4 mt-0 d-inline-block mx-auto w-60">
                 <?php if(!isset($_SESSION['user'])): 
                 ?>
                <ul class="list-unstyled foot-desc">
                    <li class="mb-2">
                        <a href="login.php">Login</a>
                    </li>
                    <li class="mb-2">
                        <a href="register.php">Sign up</a>
                    </li>
                    <li class="mb-2">
                        <a href="keranjang.php">Keranjang</a>
                    </li>
                </ul>
                 <?php else:?>
                    <ul class="list-unstyled foot-desc">
                    <li class="mb-2">
                        <a href="riwayat.php">Riwayat Belanja</a>
                    </li>
                    <li class="mb-2">
                        <a href="berandasewa.php">Penyewaan</a>
                    </li>
                    <li class="mb-2">
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
                 <?php endif?>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 mx-auto mt-3 mt-md-0 mb-0 mb-md-4">

                <!-- Links -->
                <h5 href="#">About</h5>
                <hr class="color-primary mb-4 mt-0 d-inline-block mx-auto w-60">
                <p class="text-justify">Sisuka merupakan toko online yang menjual kamera beserta aksesoris penunjangnya, sisuka juga menyediakan tempat untuk pelanggan yang ingin menyewakan kameranya kepada pihak lain</p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 mx-auto mt-3 mt-md-0 mb-0 mb-md-4">

                <!-- Links -->
                <h5>Contacts</h5>
                <hr class="color-primary mb-4 mt-0 d-inline-block mx-auto w-60">

                <ul class="fa-ul foot-desc ml-4">
                    <li class="mb-2"><span class="fa-li"><i class="fa fa-map"></i></span>Jalan Pantai Purnama No 19
                    </li>
                    <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span>042 876 836 908</li>
                    <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span>sisukateam@gmail.com</li>
                </ul>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 text-muted">© 2020 Copyright:
        <a href="aboutus.php"> Sisukateam</a>
    </div>
    <!-- Copyright -->

</footer>