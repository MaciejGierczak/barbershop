<?php
session_start();
function password_validation($pass,$pass2)
{

   if($pass=$pass2) {
       $number = preg_match('@[0-9]@', $pass);
       $uppercase = preg_match('@[A-Z]@', $pass);
       $lowercase = preg_match('@[a-z]@', $pass);


       if (strlen($pass) < 8 || !$number || !$uppercase || !$lowercase) {
          return false;
       } else {
          return true;
       }
   }

}
function check_if_exist($login,$email)
{
    $conn = new mysqli('localhost', 'root', '', 'barber');
    if ($conn->connect_error) {
        die("Nieudane połączenie " . $conn->connect_error);
    }

    $sql = "SELECT login,email FROM users where login='".$login."' or email='".$email."'";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                if ($login==$row['login'] )
                {
                    mysqli_close($conn);
                    return false;
                }else if($email==$row['email'])
                {
                    mysqli_close($conn);
                    return false;

                }
            }

        }else
            mysqli_close($conn);
            return true;
    }

//name,mail,pass,pass2
if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']="nie prawidłowy adres email";
        header("location:register.php");
    } else {
        if (!check_if_exist($_POST['name'], $_POST['email'])) {
                $_SESSION['error']="Podany użytkownik z danym email'em lub loginem już istnieje";
            header("location:register.php");
        } else {
            if (password_validation($_POST['pass'], $_POST['pass2'])) {
                $conn = new mysqli('localhost', 'root', '', 'barber');
                if ($conn->connect_error) {
                    die("Nieudane połączenie " . $conn->connect_error);
                }

                $pwd=password_hash($_POST['pass'],PASSWORD_DEFAULT);
                $sql =$conn->prepare("INSERT INTO users(login,password,email)VALUES (?,?,?)");
                $sql->bind_param("sss",$_POST['name'],$pwd,$_POST['mail']);
                if ($sql->execute() === TRUE) {
                    $_SESSION['info'] = "Zarejestrowano pomyślnie, zaloguj się";
                    mysqli_close($conn);
                    header("location:login.php");
                } else {
                    $_SESSION['error'] = "Error" . $sql . "<br>" . $conn->error;
                    mysqli_close($conn);
                    $_SESSION['error'] = "Coś poszło nie tak spróbuj ponownie później";

                    header("location:register.php");
                }
            } else {
                $_SESSION['error'] = "Twoje Hasło jest za słabe (8 liter ,przynajmniej jedna duża litera i jedna cyfra";
                header("location:register.php");
            }
        }
    }
}else {
    $_SESSION['error'] = "Nie podano wszystkich danych";
    header("location:register.php");
}