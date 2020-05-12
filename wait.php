<?php

require_once 'database.php';

$token=$_COOKIE['cookie_token'];

$query="SELECT login FROM users WHERE token = '$token'";

$result=mysqli_query($link, $query);

$user=mysqli_fetch_row($result);

$user=$user[0];

$query="SELECT user2 FROM games ORDER BY id DESC LIMIT 1";

$result=mysqli_query($link, $query);

$user2=mysqli_fetch_row($result);

$query="SELECT user1 FROM games ORDER BY id DESC LIMIT 1";

$result=mysqli_query($link, $query);

$user1 = mysqli_fetch_row($result);

if ($user1[0]==NULL){

goto first;

}

if($user==$user1[0]){

if ($user2[0]!=NULL){

$query = "UPDATE players SET time = 0 WHERE login = '$user'";

$result=mysqli_query($link, $query);

header("Location: http://95.217.23.70/game.php");

die();

}

goto exist;

}

if ($user2[0]==NULL){

$query="UPDATE games SET user2 = '$user' ORDER BY id DESC LIMIT 1";

$result=mysqli_query($link, $query);

$query = "UPDATE players SET time = 0 WHERE login = '$user'";

$result=mysqli_query($link, $query);

header("Location: http://95.217.23.70/game.php");

die();

}

else {

first:

$query="INSERT INTO games (user1) VALUE ('$user')";

$result=mysqli_query($link, $query);

}

exist:

$time=time();

$time_on_site=time()-$_COOKIE['cookie_time'];

setcookie('cookie_time', $time);

$query = "UPDATE players SET time = $time_on_site WHERE login = '$user'";

$result=mysqli_query($link, $query);

mysqli_close($link);

?>

<!doctype html>

<html lang="en">

<title>Waiting...</title>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<style>

body {

position: absolute;

top: 30%;

left: 50%;

transform: translate(-50%, -50%);

}

</style>

<body>

<meta http-equiv="Refresh" content="5"/>

<form method="post" action="index.php">

<div align = "center">

<h1>Waiting...</h1> <br>

<input type="submit" class="btn btn-success" value="Cancel">

</div>

</body>

</html>
