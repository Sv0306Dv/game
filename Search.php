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

$res = $conn->query('SELECT * FROM queue');

if (!empty($res) && ($res->num_rows > 0)) {

$res = $conn->query('SELECT game_id FROM queue LIMIT 1;');

$row = $res->fetch_assoc();

$conn->query('DELETE FROM queue WHERE game_id='.$row["game_id"].';');

$conn->query('UPDATE sessions SET user2="'.$_GET["email"].'" WHERE id='.$row["game_id"].';');

$conn->close();

header('Location: game.php?session='.$row["game_id"].'&user='.$_GET["email"].'');

exit();

} else {

$conn->query('INSERT into sessions (score1, score2, move, user1, user2) VALUES (0, 0, 0, "'.$_GET["email"].'", "");');

$res = $conn->query('SELECT id FROM sessions WHERE BINARY user1="'.$_GET["email"].'";');

$row = $res->fetch_assoc();

$conn->query('INSERT into queue (game_id) VALUES ('.$row["id"].');');

$conn->close();

header('Location: game.php?session='.$row["id"].'&user='.$_GET["email"].'');

exit();

}

?>