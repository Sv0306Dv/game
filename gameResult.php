<head>

<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">

<style>

body {

position: fixed;

top: 50%;

left: 50%;

margin-top: -250px;

margin-left: -145px;

background-image: url(https://demiart.ru/forum/uploads6/post-972989-1278263016.jpg);

background-repeat: no-repeat;

background-attachment: fixed;

background-size: cover;

}

#buttons {

position: fixed;

top: 50%;

left: 50%;

margin-top: -100px;

margin-left: -50;

}

</style>

</head>

<body>

<button id="buttons" type="button" class="btn btn-primary btn" onclick="window.location.href='account.php?email=<?php echo $_GET['email']?>'">Quit</button>

</body>

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

if (isset($_GET['session'])) {

$res = $conn->query('SELECT score1, score2, user1, user2, move FROM sessions WHERE id='.$_GET['session'].';');

$res = $res->fetch_assoc();

if ($res['score1'] >= 100) {

echo '<h1>'.$res["user1"].' win</h1>';

if ($res['move'] == 2) {

$conn->query('DELETE FROM sessions WHERE id='.$_GET['session'].';');

if (isset($_GET['game'])) {

$conn->query('UPDATE games SET winner="'.$res["user1"].'" WHERE id='.$_GET["game"].';');

} else {

$conn->query('INSERT INTO games (user1, user2, winner) VALUES ("'.$res["user1"].'", "'.$res["user2"].'", "'.$res["user1"].'");');

}

} else {

$conn->query('UPDATE sessions SET move=2 WHERE id='.$_GET['session'].';');

}

//insert data in the game table and delete session

} elseif ($res['score2'] >= 100) {

if ($res['move'] == 2) {

$conn->query('DELETE FROM sessions WHERE id='.$_GET['session'].';');

if (isset($_GET['game'])) {

$conn->query('UPDATE games SET winner="'.$res["user2"].'" WHERE id='.$_GET["game"].';');

} else {

$conn->query('INSERT INTO games (user1, user2, winner) VALUES ("'.$res["user1"].'", "'.$res["user2"].'", "'.$res["user2"].'");');

}

} else {

$conn->query('UPDATE sessions SET move=2 WHERE id='.$_GET['session'].';');

}

echo '<h1>'.$res["user2"].' win</h1>';

//insert data in the game table and delete session

} else {

header('HTTP/1.0 400 Bad Request');

}

}

$conn->close();

?>