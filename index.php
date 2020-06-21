<!DOCTYPE html>
<html  onclick="" onkeydown="">
<head>
<title>yoyo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<!--<meta http-equiv="refresh" content="1"/> -->

<link rel="stylesheet" href="style/button.css">

<style>

/* per fer animacions mirar-se be al funció requestAnimationFrame() en comptes
d'usar setTimeout() */


body{
    background-color:LightCyan;
    touch-action: manipulation;
}
html {
    touch-action: manipulation;
}
#controls{
    position:absolute;
    visibility:hidden;
}

</style>
</head>
<body onload="update();">

<script src="js/class/rect.js"></script>


<script src="js/function/randbolet2.js"></script>

<script>

var rescats = 0;


function restart() {
    
	requestAnimationFrame(move);
}

function carrega() {

        intro();
}



function intro() {
   }

function move() {
	//repeat
	request = requestAnimationFrame(move); 
}

function update() {
    setTimeout(function() { location. reload(); }, 4000);
}

function showranking() {
    window.location.href = "php/getusers.php";
}
function playsong() {
    var rand = Math.round(Math.random());
    //canço de fons
    var song = 'song1.mp3';
    if(rand===1)  song='song2.mp3';
    song = "audio/"+song;
    document.getElementById("aux3").innerHTML = rand + " " + song;
    document.getElementById("aux3").visibility ="visible";
    var cançofons = new Audio(song);
    cançofons.loop = true;
    cançofons.play();
}

</script>

<div id="boton" >

</div>

<div id="score"></div>

<div id="controls">
    <p id="aux1"></p>
    <p id="aux2"></p>
    <p id="aux3"></p>
</div>
<br>
<br>





 <?php
 echo "mama <br>";
include("php/connect.php");//contains all passwords.
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, clics, active FROM botaula WHERE id=1";
    $result = $conn->query($sql);

	$row = mysqli_fetch_row($result);

	/*$id = array_column($result2, 'id');
	$clics = array_column($result2, 'clics');
	$active = array_column($result2, 'active');*/
$active = (int)$row[2]; $clics = $row[1];
echo "active: " . $active . " clics: " . $clics. "<br>";

$butt = "<form action= 'php/updatebut.php' > 
        <input class ='submitbut' type='submit' value='Press bootie!'";
if($active===1) { 
    $butt = $butt . "style='background-color:red'";
} else {$butt = $butt . "style='background-color:green'";}

$butt = $butt . ">   </form>";
echo $butt;

$conn->close();
?> 

<!-- galeria de sons a https://downloads.khinsider.com/game-soundtracks/album/fire-emblem-fates-->
</body>
</html> 

