<head>

<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>

body {

background-image: url(https://demiart.ru/forum/uploads6/post-972989-1278263016.jpg);

background-repeat: no-repeat;

background-attachment: fixed;

background-size: cover;

}

#badge1 {

position: fixed;

top: 20%;

left: 25%;

margin-left: 30px;

padding: 40px

}

#badge2 {

font-size: 160%;

position: fixed;

top: 20%;

right: 25%;

margin-right: 64px;

padding: 40px

}

#drop {

position: fixed;

bottom: 15%;

left: 25%;

width: 10%;

}

#pass {

position: fixed;

bottom: 15%;

left: 50%;

margin-left: -65px;

width: 10%;

}

#giveUp {

position: fixed;

bottom: 15%;

right: 25%;

width: 10%;

}

</style>

</head>

<body>

<script type="text/javascript">

let drop = function () {

let rand = Math.round(0.5 + Math.random() * 6);

$.ajax({

type: "PUT",

url: 'gameQueryProc.php',

dataType: 'json',

data: JSON.stringify({"score":rand, "id":"<?php echo $_GET['session'];?>", "user":"<?php echo $_GET['user'];?>"}),

success: () => {

console.log(`Drop: ${rand}`);

},

error: () => {

console.log("Drop: error");

}

});

if (rand == 1) {

pass();

}

};

let pass = function () {

$.ajax({

type: "POST",

url: 'gameQueryProc.php',

data: JSON.stringify({"id":"<?php echo $_GET['session'];?>", "user":"<?php echo $_GET['user'];?>"}),

success: () => {

console.log("Pass: success");

},

error: () => {

console.log("Pass: error");

}

});

};

let giveUp = function () {

$.ajax({

type: "DELETE",

url: 'gameQueryProc.php',

data: JSON.stringify({"id":"<?php echo $_GET['session'];?>", "user":"<?php echo $_GET['user'];?>"}),

success: () => {

console.log("Delete: success");

},

error: () => {

console.log("Delete: error");

}

});

};

let f = function (data, status) {

let badge = document.getElementById("badge1");

badge.innerHTML = data.score1;

badge = document.getElementById("badge2");

badge.innerHTML = data.score2;

badge = document.getElementById("move");

badge.innerHTML = data.move;

badge = document.getElementById("line");

badge.style.width = data.score1 + "%";

//check game rules

if (data.score1 >= 100 || data.score2 >= 100)

window.location.href = 'gameResult.php?email=<?php echo $_GET["user"]?>&session=<?php echo $_GET["session"];

if (isset($_GET["game"]))

echo "&game=".$_GET["game"];?>';

};

setInterval(function times () {

$.get('gameQueryProc.php', {"id": "<?php echo $_GET["session"]?>", "email": "<?php echo $_GET["user"]?>"}, f)

}, 1000);

</script>

<h3 style="position: fixed; top: 5%; left: 25%">Your's score</h3> <h3 style="position: fixed; top: 5%; right: 25%">Opponent's score</h3>

<span id="badge1" class="badge badge-primary"></span> <span id="badge2" class="badge badge-primary"></span>

<div class="progress">

<div id="line" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>

</div>

<button id="drop" type="button" class="btn btn-primary btn-lg" onclick="drop()">Drop</button>

<button id="pass" type="button" class="btn btn-primary btn-lg" onclick="pass()">Pass</button>

<button id="giveUp" type="button" class="btn btn-primary btn-lg" onclick="giveUp()">Give up</button>

<h5 id="move" style="position: fixed; top: 20%"></h5>

</body>