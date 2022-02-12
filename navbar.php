<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/style.css"> 
        <link rel="icon" type="image/png" sizes="96x96" href="admin/assets/img/logo-tittle.png">
        <style>
            html,
            body {
                margin: 0;
                padding: 0;
                height: 100%;
            }
            .container {
                position: relative;
                min-height: 100%;
            }
            .jumbo {
              width: 100%;
              border: 1px solid black;
              border-radius: 5px;
              min-height: 480px;
              max-height: 480px;
            }

            .thumb {
                width: 23%;
                float: left;
                border: 1px solid black;
                border-radius: 5px;
                margin-top: 3px;
                margin-right: 3px;
                min-height: 115px;
            }

            .thumb:hover {
                opacity: 0.5;
                cursor: pointer;
            }

            @keyframes fade {
                to {
                    opacity: 1;
                }
            }

            .fade {
                opacity: 0;
                animation: fade 0.5s forwards;
            }

            .display {
                opacity: 0.5;
            }
        </style>
    
        <title>Sisuka</title>
    </head>

    <body>
        
    <!-- navbar -->
    <div class="navbar-wrapper">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a href="index.php" class="navbar-brand"><img style="width: 150px;" src="assets/img/logo2.png" alt=""></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
                 </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ml-auto px-2">
                        <form class="form-inline" action="pencarian.php" method="get">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search..." name="keyword">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <a href="index.php" class="nav-item nav-link px-2">Home</a>
                        <a href="shop.php" class="nav-item nav-link px-2">Shop</a>
                        <a href="rent.php" class="nav-item nav-link px-2">Rent</a>
                        <li class="nav-item dropdown px-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart"></i> </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="keranjang.php">Keranjang</a>
                                        <a class="dropdown-item" href="checkout.php">Checkout</a>
                                    </div>
                            </li>
                        
                        <?php if(!isset($_SESSION['user'])): ?>
                            <a href="register.php" class="nav-item nav-link px-2">Sign up</a>
                        <li class="nav-item pl-2 mb-2 mb-md-0">
                            <a href="login.php" type="button" class="btn btn-outline-info btn-md btn-rounded  waves-effect px-2">Login</a>
                        </li>
                        <?php else: ?>
                            <li class="nav-item dropdown px-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle-o"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="riwayat.php">Riwayat Belanja</a>
                                    <a class="dropdown-item" href="berandasewa.php">Penyewaan</a>
                                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
                                    </div>
                            </li>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </nav>
        </div>
        <!-- navbar end -->