<?php
session_start();
include 'Calendar.php';
if(isset($_POST['schedule_date'])) {
    $_SESSION['schedule_date'] = $_POST['schedule_date'];
    $_SESSION['salon']=$_POST['salon'];
}
$calendar = new Calendar($_SESSION['schedule_date']);
$conn = new mysqli('localhost', 'root', '', 'barber');
$datestr=strtotime($_SESSION['schedule_date']);
$month=date("n",$datestr);
$sql="select users_data.name as imie,users_data.surname as nazw,date_of_shift,start_of_shift,end_of_shift,salon.nazwa as snazwa  from  workers_schedule inner join salon on salon_id=salon.id inner join worker on worker_id=worker.id inner join users on worker.users_id=users.id inner join users_data on users_data.users_id=users.id where extract(month from date_of_shift)=".$month." AND salon.id=".$_SESSION['salon'];
$result=$conn->query($sql);
while($row=$result->fetch_assoc())
{     $new_date=strtotime($row['date_of_shift']);
    $napis=$row['imie']." ".$row['nazw']." ".$row['snazwa']." ".$row['start_of_shift']."-".$row['end_of_shift'];
    $calendar->add_event($napis,$row['date_of_shift'],1,'green');
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Calendar</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="calendar.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navtop">
    <div>
        <h1>Harmonogram</h1>
        <h1><a href="account.php">Powrót</a></h1>
    </div>
</nav>
<div class="content home">
    <?=$calendar?>
    <form action="generete_schedule.php" method="post">
        <input type="date" name="date">
        <select class="form-select form-select-lg mb-3" name="workerName">
            <?php
            $conn = new mysqli('localhost', 'root', '', 'barber');
            if ($conn->connect_error) {
                die("Nieudane połączenie " . $conn->connect_error);
            }
            $sql="SELECT worker.id as wid,name,surname from users_data inner join users on users.id=users_id inner join worker on worker.users_id=users.id where worker.users_id=users.id";
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc())
            {
                echo "<option value='".$row['wid']."'>".$row['name']." ".$row['surname']."</option>";
            }
        $conn->close();

            ?>
        </select>
        <input type="time" name="time-start" placeholder="godzina rozpoczęcia zmiany">
        <input type="time" name="time-end" placeholder="godzina zakończenia zmiany">
        <input type="submit" class="btn btn-success" value="Wpisz do Harmonogramu">
    </form>
</div>
<div>
    <?php
    if(isset($_SESSION['infos']))
    {
        echo $_SESSION['infos'];
    }
    ?>

</div>
</body>
</html>