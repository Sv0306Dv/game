<head>

<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">

<style>

body{

background-image: url(https://demiart.ru/forum/uploads6/post-972989-1278263016.jpg);

background-repeat: no-repeat;

background-attachment: fixed;

background-size: cover;

}

#create {

position: fixed;

top:5%;

left:73%;

width: 25%;

padding:5%;

font-size:200%;

}

#join {

position: fixed;

bottom: 15%;

left:73%;

right:2%;

width: 25%;

font-size:200%;

}

#iframe {

position: fixed;

width: 70%;

height: 90%;

top: 5%;

left: 1%;

background-color: lightsteelblue;

}

#btn {

position: fixed;

bottom: 5%;

left:73%;

right:2%;

width: 25%;

font-size:200%;

}

</style>

</head>

<body>

<iframe src="games.php" id="iframe" class="form-control" ></iframe>

<form action="createorjoin.php?email=<?php echo $_GET['email'];?>" method="post">

<input type="hidden" name="CreateOrJoin" value="create">

<input type="submit" id="create" class="btn btn-primary btn-sm" value="Create game">

</form>

<form action="createorjoin.php?email=<?php echo $_GET['email'];?>" method="post">

<input id="join" class="form-control mr-sm-2" name="id" type="text" placeholder="Enter game_id">

<input type="hidden" name="CreateOrJoin" value="join">

<input id="btn" type="submit" class="btn btn-primary btn-sm" value="Join">

</form>

</body>