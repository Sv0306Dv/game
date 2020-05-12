<?php

$link = mysqli_connect('localhost', 'sveta', '1234', 'database');

if (!$link) {

die("Connection failed: " . mysqli_connect_error());

}

?>
