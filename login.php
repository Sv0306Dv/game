<?php

if (isset($_COOKIE['cookie_token'])) {

header("Location: http://95.217.23.70/index.php");

die();

}

?>

<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>Авторизация</title>

</head>

<style>

body {

position: absolute;

top: 30%;

left: 50%;

transform: translate(-50%, -50%);

}

</style>

<body>

<h1 align = "center" class="alert alert-success">Авторизация</h1>

<form method="post" action="auth.php">

<div align = "center">



<table>

<tr>

<td> <label for="loginField">Login</label> </td>

<td> <input id="loginField" type="text" name="login" size="30" autocomplete="off" required > </td>

</tr>

<tr>

<td> <label for="passField"> Password </label> </td>

<td> <input id="passField" type="password" name="pswrd" size="30" required> </td>

</tr>

</table>

<input type="submit" class="btn btn-success" value="login"> <br>

<a href="http://95.217.23.70/signup.php"> Sign up now! </a>

</div>

</form>

</body>

</html>
