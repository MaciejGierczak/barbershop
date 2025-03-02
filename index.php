<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
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
<!--Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://d375139ucebi94.cloudfront.net/region2/pl/89861/biz_photo/0295c00d533840369f9d58cbe362f8-konopny-barber-biz-photo-b5d675d375904f32bb5b6ffdcdcf62-booksy.jpeg?size=640x427" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="data:image/jpeg;base64,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" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://www.hairstore.pl/blog/wp-content/uploads/2020/12/jak-zalozyc-salon-barberski-1024x576.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div style="width:100%;text-align: center">
<p class="h1 text-dark">Barber Trójmiasto Zaprasza</p>
</div>
<div class="container">
    <div class="row">
<div style="width: 45%;float left" class="column">
    <?php
    $conn = new mysqli('localhost', 'root', '', 'barber');
    $sql = "SELECT * from services";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
    <table class="table" style="float left">
        <thead>
        <tr>
            <th scope="col">Usługi</th>
            <th scope="col">Cena</th>
        </tr>
        </thead>
        <tbody>
    <?php
    while($row=$result->fetch_assoc())
    {
        echo "<tr><td>".$row['name_of_service']."</td><td>".$row['price']."zł</td></tr>";
    }
    }

    ?>
        </tbody>
    </table>
</div>
    <div class="column" style="width: 45%;float left; text-align: center">
        <p class="h2 text-muted">Promocja co 5 wizyta </br> 50% taniej</p>
    </div>
    </div>
        <div class="row" style="overflow: scroll;max-height: 20%">
            <?php
            $sql = "SELECT * from reviews inner join users on reviews.users_id=users.id inner join users_data on users_data.users_id=users.id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                ?>
                <?php
                while($row=$result->fetch_assoc())
                {
                    ?>
                    <div style="border solid 2px black;" class='container'>
<span class='h4'>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                        <?php
                        echo $row['name']."</span>";
                        echo "<p>".$row['review']."</p>";

                        ?>

                    </div>

            <?php

                }
            }

            ?>
        </div>
        </div>
    </div>
</div>


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
                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">info@example.com</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-phone"></i></span><a href="tel:111-111-111"><span class="ms-2">111 111 111 </span></a>
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

            <a class="text-white" href="https://mdbootstrap.com/">Maciej Gierczak</a>
        </div>
        <!-- Copyright -->
    </footer>

</div>
</body>
</html>