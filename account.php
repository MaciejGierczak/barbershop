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
    <script type="text/javascript">
        var el = document.getElementById('myCoolForm');

        el.addEventListener('#but', function(){
            return confirm('Napewno chcesz Anulować wizytę ?');
        }, false);
    </script>
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
<?php
function check_data_user()
{
    $conn = new mysqli('localhost', 'root', '', 'barber');
    $sql = "SELECT * FROM users_data inner join users on users_id=users.id where users.login=" ."'".$_SESSION['login']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $conn->close();
            return $row;
        }
    } else {
        $conn->close();
        $_SESSION['previous']="account";
        header("location:account_input.php");
    }
}
function user_data()
{
    $conn = new mysqli('localhost', 'root', '', 'barber');
    $sql = "SELECT * FROM users_data inner join users on users_id=users.id where users.login=" ."'".$_SESSION['login']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
            ?>
            <table class="table">
                <thead>
                <tr><th class="scope"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg></th><th class="scope">Imie</th><th class="scope">Nazwisko</th><th class="scope">Nr.Telefonu</th><th class="scope">Adres Email</th</tr>
                </thead>
                <tbody>
    <?php
    echo "<td>".$row['id']."</td>";
           echo "<td>".$row['name']."</td>";
           echo "<td>".$row['surname']."</td>";
           echo "<td> ".$row['phone']."</td>";
           echo "<td>".$row['email']."</td>";
    ?>
                </tbody>
            </table>
    <?php

        $conn->close();
        }
    else {
       $conn->close();
       return false;
    }


}
function show_history()
{
    $conn = new mysqli('localhost', 'root', '', 'barber');
    if (isset($_SESSION['perm']) && $_SESSION['perm'] == 1) {
        $sql = "SELECT `order`.id,`order`.date_of_service as data,`order`.id as ido ,salon.nazwa as nazwa,`order`.accept as ac from `order` inner join salon on `order`.salon_id=salon.id where users_id=" . $_SESSION['id'] . " Order by data DESC ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if (date('Y-m-d h:i:s', time()) < $row['data']) {
                    echo "<tr><td>" . $row['data'] . "</td><td>" . $row['nazwa'] . "</td>";
                    if ($row['ac'] == "accepted") {
                        echo "<td class='text-success'>Potwierdzono</td></tr>";
                    } else if($row['ac']=="wait"){
                        echo '<td class="text-warning">Oczekiwanie na potwierdzenie</td><td><form action="acceptation.php" method="post"><input type="hidden" name="id" value='.'"'.$row['ido'].'"'.'> <input type="hidden" name="date" value='.'"'.$row['data'].'"'.'> <input type="submit" name="accept" id="but"value="anuluj" class="btn btn-warning"></form></td></tr>';
                    }else {
                        echo "<td class='text-danger'>odrzucono</td></tr>";
                    }
                } else if($row['ac']=="accepted") {
                    $sql="select * from reviews where order_id=".$row['id'];
                    $result2=$conn->query($sql);
                    if($result2->num_rows==0) {
                        echo "<tr><td>" . $row['data'] . "</td><td>" . $row['nazwa'] . "</td><td><form action='oceny.php' method='post'><input type='hidden' value='" . $row['id'] . "' name='order_id'><button class='btn btn-primary'>Oceń wizytę</button></form></a></td></tr>";
                    }else
                    {
                        echo "<tr><td>" . $row['data'] . "</td><td>" . $row['nazwa'] . "</td><td><span class='text-primary'>Oceniono</span></td></tr>";
                    }
                }
            }


        }else
            echo "Brak Wizyt";

    } else if ($_SESSION['perm']==2 || $_SESSION['perm']==3) {
        $sql = "SELECT `order`.id as ido,date_of_service as data,salon.nazwa as nazwa,accept as ac from `order` inner join worker on worker.id=worker_id inner join salon on `order`.salon_id=salon.id where worker.users_id=".$_SESSION['id']." order by data desc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if (date('Y-m-d h:i:s', time()) < $row['data']) {
                    echo "<tr><td>" . $row['data'] . "</td><td>" . $row['nazwa'] . "</td>";
                    if ($row['ac'] == "accepted") {
                        echo "<td class='text-info'>Potwierdzono</td></tr>";
                    } else if($row['ac']=='wait') {
                        echo "<td class='text-warning'>Oczekiwanie na potwierdzenie</td>";
                        echo '<td class="text-warning"><form action="acceptation.php" method="post"><input type="hidden" name="id" value='.'"'.$row['ido'].'"'.'> <input type="hidden" name="date" value='.'"'.$row['data'].'"'.'> <input type="submit" name="accept" value="potwierdz" class="btn btn-primary"><input type="submit" name="accept" value="odrzuc" class="btn btn-danger"></td></tr>';
                    }else
                    {
                        echo "<td class='text-danger'>odrzucono</td></tr>";
                    }
                } else

                    echo "<tr><td>" . $row['data'] . "</td><td>" . $row['nazwa'] . "</td><td class='text-success'>zakończne</td></tr>";
            }


        }else
            echo $conn->error;


    }
    if($_SESSION['perm']==3)
    {
        ?>
        <form method="post" action="admin.php">
            <input type="date" name="schedule_date">
            <select name="salon">
                <?php
                $sql="Select * from salon";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()) {

                    echo "<option value="."'".$row['id']."'".">".$row['nazwa']."</option>";
                }
                ?>
            </select>
            <input type="submit" value="harmonogram" name="schedule" class="btn btn-secondary btn-lg m-1">
        </form>
        <?php

    }
    $conn->close();
}
?>
<div class="mh-100 h-100" style="margin=0px;">
    <div class="row">
<div id="data_acc" class="col ">
    <?php
check_data_user();
user_data();
?>
</div>
    </div>
    <div class="row">
<div id="history" class="col ">
    <table class="table table-striped table-dark h-100" style="border: solid white;">
       <thead class="thead-dark">
        <tr><th class="col">Data Wizyty</th><th class="col">Salon</th><th>Status</th></tr>
       </thead>
        <tbody>
        <?php

        show_history();

        ?>
</tbody>
    </table>

</div>
    </div>
</div>
<!--FOOTER -->

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