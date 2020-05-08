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

$move = true;

function firstUser($tableUser1, $getUser){

if ($tableUser1 == $getUser)

return true;

return false;

}

if (isset($_GET["id"])) {

$res = $conn->query('SELECT score1, score2, user1, move FROM sessions WHERE id=' . $_GET["id"] . ';');

$res = $res->fetch_assoc();

if (isset($_GET['email'])) {

if (($_GET['email'] == $res['user1']) == ($res['move'] == 0)) {

if (firstUser($res['user1'], $_GET['email'])) {

header('Content-Type: application/json');

$data = array("score1" => $res["score1"], "score2" => $res["score2"], "move" => "your move");

print(json_encode($data));

} else {

header('Content-Type: application/json');

$data = array("score1" => $res["score2"], "score2" => $res["score1"], "move" => "your move");

print(json_encode($data));

}

/*my move*/

} else {

if (firstUser($res['user1'], $_GET['email'])) {

header('Content-Type: application/json');

$data = array("score1" => $res["score1"], "score2" => $res["score2"], "move" => "opponent move");

print(json_encode($data));

} else {

header('Content-Type: application/json');

$data = array("score1" => $res["score2"], "score2" => $res["score1"], "move" => "opponent move");

print(json_encode($data));

}

/*not my move*/

}

}

} else if (isset($_SERVER['REQUEST_METHOD'])) {

$vars = json_decode(file_get_contents("php://input"));

$res = $conn->query('SELECT score1, score2, user1, move FROM sessions WHERE id='.$vars->id.';');

$res = $res->fetch_assoc();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT') {

if ($vars->user == $res['user1']) {

if ($res['move'] == 0) {

$newScore = $res["score1"] + $vars->score;

$conn->query('UPDATE sessions SET score1='.$newScore.' WHERE id='.$vars->id.';');

header('HTTP/1.0 200 OK');

} else {

print('Not your move');

header('HTTP/1.0 403 Forbidden');

}

} else {

if ($res['move'] == 1) {

$newScore = $res["score2"] + $vars->score;

$conn->query('UPDATE sessions SET score2='.$newScore.' WHERE id='.$vars->id.';');

header('HTTP/1.0 200 OK');

} else {

print('Not your move');

header('HTTP/1.0 403 Forbidden');

}

}

} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

if (($vars->user == $res['user1']) && $res['move'] == 0) {

$newMove = $res['move'] == 0 ? 1 : 0;

} elseif (($vars->user != $res['user1']) && $res['move'] == 1) {

$newMove = $res['move'] == 0 ? 1 : 0;

} else {

$conn->close();

print('Not your move');

header('HTTP/1.0 403 Forbidden');

exit();

}

$conn->query('UPDATE sessions SET move='.$newMove.' WHERE id='.$vars->id.';');

header('HTTP/1.0 200 OK');

} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {

if ($vars->user == $res['user1']) {

$conn->query('UPDATE sessions SET score2=100 WHERE id='.$vars->id.';');

} else {

$conn->query('UPDATE sessions SET score1=100 WHERE id='.$vars->id.';');

}

header('HTTP/1.0 200 OK');

}

}

$conn->close();

?>