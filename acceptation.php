<?php
session_start();
if($_POST['accept']=="potwierdz")
{
    $conn = new mysqli('localhost', 'root', '', 'barber');
    $sql="Update `order` set accept='accepted',date_of_service=". "'".$_POST['date'] ."'" ."where id=".$_POST['id'];
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("location:account.php");
    } else {
        echo $_POST['id'];
        $_SESSION['error']="Ups ... coś poszło nie tak";
        echo $_SESSION['error'];
        echo $conn->error;
    }


}else
{
    $conn = new mysqli('localhost', 'root', '', 'barber');
    $sql="Update `order` set accept='notaccepted',date_of_service=". "'".$_POST['date'] ."'" ."where id=".$_POST['id'];
    $date=$_POST['date'];
    $a=explode(' ',$date);
    $sql2="Update schedule_terms inner join  workers_schedule on workers_schedule.id=workers_schedule_id inner join worker on worker.id=workers_schedule.worker_id inner join `order` on `order`.worker_id=worker.id set schedule_terms.status='free' where schedule_terms.time='".$a[1]."' and date_of_shift='".$a[0]."' and `order`.id=".$_POST['id'];
    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE ) {
        $conn->close();
        header("location:account.php");
    } else {
        $_SESSION['error']="Ups ... coś poszło nie tak";
    }
}

?>
