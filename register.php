<?php

require_once 'database.php';

$login=$_POST['login'];

$password=$_POST['pswrd'];

$confirm=$_POST['confirm'];

if ($password!=$confirm) {

header("Location: http://lab2/signupNOTEQUAL.php");

die();

}

$query="SELECT login FROM users";

$result=mysqli_query($link, $query);

for ($i=0; $i<mysqli_num_rows($result); ++$i){

$acc = mysqli_fetch_row($result);

if($login==$acc[0]){

header("Location: http://lab2/signupALREXIST.php");

die();

}

}

mysqli_free_result($result);

$hash_password=password_hash($password,PASSWORD_BCRYPT);

$password=$hash_password;

$query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";

if (mysqli_query($link, $query)) {

$token=bin2hex(random_bytes(32));

$query = "UPDATE users SET token = '$token' WHERE login = '$login'";

$result = mysqli_query($link, $query);

setcookie('cookie_token', $token);

setcookie('cookie_create_time', time());

header("Location: http://lab2/index.php");

mysqli_close($link);

die();

}

else {

echo "Error: " . $query . "<br>" . mysqli_error($link);

mysqli_close($link);

die();

}

?>
