<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>Регистрация</title>

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

<h1 align = "center" class="alert alert-success">Регистрация</h1>

<form method="post" action="register.php">

<div align="center">



<h4> Заполните все поля: </h4>

<table>

<tr>

<td> <label for="loginField">Login</label> </td>

<td> <input id="loginField" type="text" name="login" size="30" autocomplete="off" required> </td>

</tr>

<tr>

<td> <label for="passField" </label> Password </td>

<td> <input id="passField" type="password" name="pswrd" size="30" required> </td>

</tr>

<tr>

<td> <label for="confField" </label> Confirm password </td>

<td> <input id="confField" type="password" name="confirm" size="30" required> </td>

</tr>

</table>

<input type="submit" class="btn btn-success" value="OK">

</div>

</body>

</html>
