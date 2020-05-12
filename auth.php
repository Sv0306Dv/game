<?php

require_once 'database.php';

if (isset($_COOKIE['cookie_token'])){

$token=$_COOKIE['cookie_token'];

$query="SELECT login FROM users WHERE token = '$token'";

$result=mysqli_query($link, $query);

$user=mysqli_fetch_row($result);

$user=$user[0];

$query="UPDATE players SET time = NULL WHERE login = '$user'";

$result=mysqli_query($link, $query);

$query="UPDATE users SET token = NULL WHERE login = '$user'";

$result=mysqli_query($link, $query);

mysqli_close($link);

setcookie('cookie_token', '');

setcookie('cookie_create_time', '');

setcookie('cookie_time', '');

header("Location: http://lab2/login.php");

die();
}

$login=$_POST['login'];

$password=$_POST['pswrd'];

$query="SELECT login FROM users";

$result=mysqli_query($link, $query);

for ($i=0; $i<mysqli_num_rows($result); ++$i){

$acc = mysqli_fetch_row($result);

if($login==$acc[0]){

goto exist;

}

}

mysqli_close($link);

header("Location: http://lab2/loginDOESNTEXIST.php");

die();

exist:

$query="SELECT password FROM users WHERE login = '$login'";

$result=mysqli_query($link, $query);

$acc_pass = mysqli_fetch_row($result);

$hash_password=$acc_pass[0];

if (password_verify ($password,$hash_password)){

$token=bin2hex(random_bytes(32));

$query = "UPDATE users SET token = '$token' WHERE login = '$login'";

$result = mysqli_query($link, $query);

setcookie('cookie_token', $token);

setcookie('cookie_create_time', time());

mysqli_close($link);

header("Location: http://lab2/index.php");

}

else {

mysqli_close($link);

header("Location: http://lab2/loginWRONGPASS.php");

}

?>
