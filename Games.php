<head>

<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">

<style>

body{

font-size: 170%;

}

</style>

</head>

<?php

$servername = "localhost";

$username = "sveta";

$password = "1234";

$conn = new mysqli($servername, $username, $password);

$conn->query("USE thepigtables;");

$res = $conn->query('SELECT id, user1, user2, winner, datetime FROM games;');

if (!empty($res) && $res->num_rows > 0) {

if (($del_rows = $res->num_rows - 50) > 0)

$conn->query('DELETE FROM games LIMIT '.$del_rows.';');

echo '<table class="table table-hover" style="background-color: lightsteelblue">';

echo '<tr>

<th scope="col">Game id</th>

<th scope="col">First player</th>

<th scope="col">Second player</th>

<th scope="col">Winner</th>

<th scope="col">Date/Time</th>

</tr>';

while($row = $res->fetch_assoc()) {

printf("<tr class=\"table - light\"><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row["id"], $row["user1"], $row["user2"], $row["winner"], $row["datetime"]);

}

echo '</table>';

} else {

echo "0 results";

}

$conn->close();

?>
