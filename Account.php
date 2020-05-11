<?php

$servername = "localhost";

$username = "phpmyadmin";

$password = "1234";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {

die("Connection error: ".$conn->connect_error);

$conn->close();

header('Location:'.'auth.php');

exit();

}

$conn->query("USE thepigtables;");

$res = $conn->query("SELECT COUNT(*) FROM users;");

$authflag = 0;

if (!empty($res) && $res->num_rows > 0){

$res = $conn->query('SELECT user FROM users WHERE BINARY user="'.$_GET['email'].'";');

$row = $res->fetch_assoc();

if ($row['user'] == $_GET['email']) {

$res = $conn->query('SELECT token FROM users WHERE BINARY user="'.$_GET['email'].'";');

$row = $res->fetch_assoc();

if (isset($_COOKIE['token']) && ($row['token'] == $_COOKIE['token']))

$authflag = 1;

}

}

if (!$authflag){

$conn->close();

require('auth.php');

exit();

}

$conn->close();

?>

<head>

<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">

<style>

body{

background-image: url(https://demiart.ru/forum/uploads6/post-972989-1278263016.jpg);

background-repeat: no-repeat;

background-attachment: fixed;

background-size: cover;

font-size: 200%;

position: fixed;

left: 50%;

top: 50%;

margin-top: -200px;

margin-left: -250px;

}

#buttons {

width: 500px;

margin: 5px

}

</style>

</head>

<br>

<h1 style="margin-left: 140px">Main menu</h1><br>

<button id="buttons" type="button" class="btn btn-primary btn-sm"

onclick="window.location.href='search.php?email=<?php echo $_GET['email'];?>'">Quick play</button><br>

<button id="buttons" type="button" class="btn btn-primary btn-sm"

onclick="window.location.href='table.php?email=<?php echo $_GET['email'];?>'">Create game</button><br>

<form action="logout.php" method="post">

<input type="hidden" name="email" value=<?php if(isset($_GET['email'])) echo $_GET['email'] ?>>

<input id="buttons" type="submit" class="btn btn-primary btn-sm" value="Log out">

</form>

</body>
