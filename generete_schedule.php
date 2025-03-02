<?php
session_start();
if (isset($_POST['date'])) {

    $conn = new mysqli('localhost', 'root', '', 'barber');
    if ($conn->connect_error) {
        die("Nieudane połączenie " . $conn->connect_error);
    }
    $sql2 = "INSERT INTO workers_schedule(date_of_shift,start_of_shift,end_of_shift,worker_id,salon_id) values(" . "'" . $_POST['date'] . "','" . $_POST['time-start'] . "','" . $_POST['time-end'] . "'," . $_POST['workerName'] . "," . $_SESSION['salon'] . ")";
   if( $conn->query($sql2) === TRUE)
   {
   $sql2="select max(id) as maks from workers_schedule";
$result=$conn->query($sql2);
$row=$result->fetch_assoc();
$begin= new DateTime($_POST['time-start']);
$beginstr=strtotime($_POST['time-start']);
$end=new DateTime($_POST['time-end']);
$interval=DateInterval::createFromDateString('45 min');
       $times = new DatePeriod($begin, $interval, $end);

       foreach ($times as $time) {
           $newtime = $time->format('H:i');

           $sql3 = "INSERT INTO schedule_terms(status,time,workers_schedule_id) VALUES('free','".$newtime."'," . $row['maks'] . ")";
        echo $sql3;
           if ($conn->query($sql3) === TRUE)
               $time->add($interval)->format('H:i');
           else
           {echo $conn->error;
           }
       }
    $_SESSION['infos']="Dodano pomyślnie";
       header("location:admin.php");
   }
else
   {
       $_SESSION['infos']="Nie udało się dodać do harmonogramu";
     header("location:admin.php");
   }
    $conn->close();


}
?>