<?php
session_start();
$conn=new mysqli('localhost','root','','barber');
if($conn->connect_error)
{
    die("Nieudane połączenie ". $conn->connect_error);
}

$sql="SELECT id,login,email,password,permission FROM users";
$pass=$_POST['pass'];
$login=$_POST['login'];
$result =$conn->query($sql);
if($result->num_rows>0)
{while($row=$result->fetch_assoc())
{   $ver=password_verify($_POST['pass'],$row['password']);
    if($row['login']==$login && $ver)
    {   $_SESSION['login']=$login;
        $_SESSION['mail']=$row['email'];
        $_SESSION['pass']=$pass;
        $_SESSION['perm']=$row['permission'];
        $_SESSION['session']=true;
        $_SESSION['id']=$row['id'];
        break;
    }
}
  mysqli_close($conn);
if(empty($_SESSION['login']))
{
    $_SESSION['error']="Nie prawidłowy login lub hasło";
    header("location:login.php");
}else
{
    header("location:index.php");
}


}

?>