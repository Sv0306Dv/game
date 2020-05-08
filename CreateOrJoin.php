<head>

<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">

<style>

body {

position: fixed;

top: 50%;

left: 50%;

margin-top: -150px;

margin-left: -215px;

background-image: url(https://demiart.ru/forum/uploads6/post-972989-1278263016.jpg);

background-repeat: no-repeat;

background-attachment: fixed;

background-size: cover;

}

</style>

</head>

<?php

$servername = "localhost";

$username = "root";

$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {

die("Connection error: ".$conn->connect_error);

$conn->close();

header('Location: auth.php');

exit();

}

$conn->query("USE thepigtables;");

if (isset($_POST["CreateOrJoin"]) && ($_POST["CreateOrJoin"] == "create")){

$conn->query('INSERT into sessions (score1, score2, move, user1, user2) VALUE (0, 0, 0, "'.$_GET["email"].'", "");');

$conn->query('INSERT into games (user1, user2, winner) VALUE ("'.$_GET["email"].'", "", "");');

$res = $conn->query('SELECT id FROM sessions WHERE BINARY user1="'.$_GET["email"].'";');

$gameId = $conn->query('SELECT LAST_INSERT_ID();');

$gameId = $gameId->fetch_array();

$res = $res->fetch_assoc();

$conn->close();

header('Location: game.php?session='.$res["id"].'&user='.$_GET["email"].'&game='.$gameId[0].';');

} elseif (isset($_POST["CreateOrJoin"])) {

if (!is_numeric($_POST["id"])) {

require('table.php');

exit();

}

$res = $conn->query('SELECT user1, user2 FROM games WHERE id='.$_POST["id"].';');

if (isset($res) && ($res->num_rows == 1)) {

$res = $res->fetch_assoc();

$conn->query('UPDATE games SET user2="'.$_GET["email"].'" WHERE id='.$_POST["id"].';');

$res = $conn->query('SELECT id FROM sessions WHERE BINARY user1="'.$res["user1"].'";');

$res = $res->fetch_assoc();

$conn->query('UPDATE sessions SET user2="'.$_GET["email"].'" WHERE id='.$res["id"].';');

$conn->close();

header('Location: game.php?session='.$res["id"].'&user='.$_GET["email"].'&game='.$_POST["id"].';');

}

}

?>