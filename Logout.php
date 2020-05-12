<?php

$servername = "localhost";

$username = "sveta";

$password = "1234";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {

die("Connection error: ".$conn->connect_error);

$conn->close();

header('Location: auth.php');

exit();

}

$conn->query("USE thepigtables;");

$res = $conn->query("SELECT COUNT(*) FROM users;");

if (!empty($res) && $res->num_rows > 0)

$res = $conn->query('SELECT user FROM users WHERE BINARY user="'.$_POST['email'].'";');

$row = $res->fetch_assoc();

if ($row['user'] == $_POST['email']) {

$res = $conn->query('SELECT token FROM users WHERE BINARY user="'.$_POST['email'].'";');

$row = $res->fetch_assoc();

if (isset($_COOKIE['token']) && ($row['token'] == $_COOKIE['token'])) {

$conn->query('UPDATE users SET token="0"' . ' WHERE BINARY user="' . $_POST['email'] . '";');

setcookie("token", "", time() - 10 * 365 * 24 * 60 * 60);

}

}

$conn->close();

require('auth.php');

?>
