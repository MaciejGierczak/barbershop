<?php
session_start();

//name,mail,pass,pass2
function validate_phone_number($phone)
{
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
    if (strlen($phone_to_check) <= 9 || strlen($phone_to_check) > 12) {
        return false;
    } else {
        return true;
    }
}
if($_SESSION['previous']=="account"){
 if(validate_phone_number($_POST['phone']) && isset($_POST['name']))
{
    //name,surname,phone
    $conn = new mysqli('localhost', 'root', '', 'barber');
    if ($conn->connect_error) {
        die("Nieudane połączenie " . $conn->connect_error);
        echo "ee";
    }
    $sql="INSERT INTO users_data(users_id,name,surname,phone)VALUES ('".$_SESSION['id']."','".$_POST['name']."','".$_POST['surname']."','".$_POST['phone']."')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("location:account.php");
    }else
        $conn->close();
        $_SESSION['error']="błędne dane";

    header("location:account_input.php");
}else
    echo "nie";
}