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

$res = $conn->query("SELECT COUNT(*) FROM users;");

$mail_flag = 0;

if (!empty($res) && $res->num_rows > 0) {

$res = $conn->query('SELECT user FROM users WHERE BINARY user="'.$_POST['email'].'";');

$row = $res->fetch_assoc();

if ($row['user'] == $_POST['email'])

$mail_flag = 1;

}

if (!$mail_flag) {

if ($_POST['password'] == $_POST['confirm']) {

$str = 'INSERT INTO users(user, token, pass) VALUES ("'.$_POST['email'].'", 0, "'.hash('md5', $_POST['password']).'");';

if($conn->query($str)){}

else

echo "Error3";

} else {

?>

<script>alert("Not equal passwords")</script>

<?php

require('signup.html');

exit();

}

require('congr.html');

} else {

?>

<script>alert("That email already exists")</script>

<?php

require('signup.html');

}

?>