<html>
<body>
<head>
    <?php
    session_start();

    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!--NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light text-white" style="background-color: #23242a">
    <div class="container-fluid text-white">
        <a class="navbar-brand" href="index.php"><img src="rsz_barber_icon-removebg-preview.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link text-info" href="wizyta.php" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Umów Wizytę
                    </a>
                </li>
                <?php
                if(isset($_SESSION['session']))
                {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-info" href="account.php" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Moje Konto
                        </a>
                    </li>
                    <?php
                }
                ?>

            </ul>

        </div>
    </div>
    <?php
    if(!isset($_SESSION['login']))
    {
        ?>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="d-flex" action="login.php">
                        <button class="btn btn-outline-info" type="submit">Zaloguj</button>
                    </form>
            </ul>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="d-flex" action="logut.php">
                        <button class="btn btn-outline-info" type="submit">Wyloguj</button>
                    </form>
            </ul>
        </div>
        <?php
    }
    ?>
</nav>
<section class="vh-100" id="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">

                <div class="px-5 ms-xl-4">

                    <span class="h1 fw-bold mb-0">Barber Shop</span>
                </div>

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form style="width: 23rem;" method="post" action="loginval.php">

                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Zaloguj się</h3>

                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example18" class="form-control form-control-lg" name="login"/>
                            <label class="form-label" for="form2Example18">Login</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="form2Example28" class="form-control form-control-lg" name="pass"/>
                            <label class="form-label" for="form2Example28">Hasło</label>
                        </div>

                        <div class="pt-1 mb-4">
                            <input type="submit" class="btn btn-info btn-lg btn-block" value="logowanie"></input>
                        </div>
                        <p>Nie masz jeszcze konta? <a href="register.php" class="link-info">Zarejestruj się</a></p>
                        <?php

                        if(isset($_SESSION['error']))
                        {
                            echo "<p class=".'"Text-danger"'.">".$_SESSION['error']."</p>";
                            unset($_SESSION['error']);

                        }
                        ?>
                    </form>

                </div>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="https://d375139ucebi94.cloudfront.net/pl/cms_content/16/307f7601290a44d98ef9b8d5d85ed479.png"
                     alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>

<!--FOOTER -->
<div class="">

    <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row mt-4">
                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">About company</h5>

                    <p>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                        voluptatum deleniti atque corrupti.
                    </p>

                    <p>
                        Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
                        molestias.
                    </p>

                    <div class="mt-4">
                        <!-- Facebook -->
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-facebook-f"></i></a>
                        <!-- Dribbble -->
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-instagram"></i></a>
                        <!-- Twitter -->
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-twitter"></i></a>
                        <!-- Google + -->
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">


                    <div class="form-outline form-white mb-4">
                        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 48.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <ul class="fa-ul" style="margin-left: 1.65em;">
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">New York, NY 10012, US</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">info@example.com</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+ 01 234 567 88</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-print"></i></span><span class="ms-2">+ 01 234 567 89</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Opening hours</h5>

                    <table class="table text-center text-white">
                        <tbody class="font-weight-normal">
                        <tr>
                            <td>Poniedziałek - Czwartek:</td>
                            <td>8 - 18</td>
                        </tr>
                        <tr>
                            <td>Piątek - Sobota:</td>
                            <td>8 - 14</td>
                        </tr>
                        <tr>
                            <td>Niedziela:</td>
                            <td>10 - 16</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>


</body>
</html>

