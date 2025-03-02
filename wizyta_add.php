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
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp"
                         class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                         alt="Sample photo">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Rejestracja Wizyty</h3>
                        <?php
                        if(isset($_SESSION['id'])) {
                            if (isset($_POST['worker'])) {
                                $_SESSION['worker'] = $_POST['worker'];
                            }
                            $conn = new mysqli('localhost', 'root', '', 'barber');
                            $date = $_SESSION['date'] . " " . $_SESSION['time'];
                            $sql = "Insert into `order` (services_id,users_id,salon_id,worker_id,date_of_service,accept) values(" . $_SESSION['service_id'] . "," . $_SESSION['id'] . "," . $_SESSION['salon'] . "," . $_SESSION['worker'] . ",'" . $date . "','wait')";
                            $sql2 = "Update schedule_terms inner join  workers_schedule on workers_schedule.id=workers_schedule_id set schedule_terms.status='occupied' where time='" . $_SESSION['time'] . "' and workers_schedule.worker_id=" . $_SESSION['worker'] . " and workers_schedule.date_of_shift='" . $_SESSION['date'] . "';";

                            if ($conn->query($sql) === TRUE && $conn->query($sql2) === True) {
                                echo "<p class='h1 text-success'>Wizyta została dodana</p></br>";
                                echo "<span>Żeby sprawdzić status lub zmienić coś w wizycie wejdź na <a href='account.php'>Moje Konto</a></span></br>";
                                echo "<span class='text-muted'>dziękujemy za wybranie naszych usług </span>";

                            } else {
                                echo $conn->error;
                            }
                            $conn->close();
                        }else
                            echo " <a href='login.php' class='text-warning'>Zaloguj się , aby umówić się do nas</a>";
                                ?>

                </div>
            </div>
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