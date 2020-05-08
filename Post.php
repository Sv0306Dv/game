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

if($conn->query("USE thepigtables") === true)

$res = $conn->query("SELECT COUNT(*) FROM users;");

function make_cookie($token, $row){

if ($row['token'] == "0") {

return 1;

}

?>

<script>alert("Incorrect mail or/and password")</script>

<?php

return 0;

}

$alert_flag = 0;

if (!empty($res) && $res->num_rows > 0) {

$res = $conn->query('SELECT user FROM users WHERE BINARY user="'.$_POST["email"].'";');

$row = $res->fetch_assoc();

if ($row['user'] == $_POST['email']) {

$res = $conn->query('SELECT pass FROM users WHERE BINARY user="'.$_POST['email'].'";');

$row = $res->fetch_assoc();

if ($row['pass'] == hash('md5', $_POST['password'])){

} else

$alert_flag = 1;

} else

$alert_flag = 1;

} else {

$alert_flag = 1;

}

if ($alert_flag) {

?>

<script>alert("Incorrect mail or/and password")</script>

<?php

$conn->close();

require('auth.php');

exit();

}

else {

$res = $conn->query('SELECT token FROM users WHERE BINARY user="'.$_POST['email'].'";');

$row = $res->fetch_assoc();

$token = bin2hex(random_bytes(32));

if (make_cookie($token, $row)) {

$conn->query('UPDATE users SET token="'.$token.'" WHERE BINARY user="'.$_POST['email'].'";');

$conn->close();

header('Location: account.php?email='.$_POST['email']);

exit();

} else {

$conn->close();

header('Location: auth.php');

exit();

}

}

?>