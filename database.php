<?php

$link = mysqli_connect('localhost', 'root', '', 'database');

if (!$link) {

die("Connection failed: " . mysqli_connect_error());

}

?>
