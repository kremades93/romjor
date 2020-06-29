<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style/mapa.css">
    <link rel="stylesheet" href="style/button.css">
    <link rel="stylesheet" href="style/headers.css">

    <script type="text/javascript" src="js/man_movement.js"></script>
    <script type="text/javascript" src="js/tiles_onmouse.js"></script>
    <script type="text/javascript" src="js/man_loading.js"></script>
    <script type="text/javascript" src="js/tiles_matrix.js"></script>
    <script type="text/javascript" src="js/turns.js"></script>
    </head>


<body onload="checkturn();writestatus();loadplayas()">

    <?php
        //Retrieve info from the previous php file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $name = $_POST['user'];
          $moved = $_POST['moved'];
          $position = $_POST['position'];
        }


        //Now I will get both players and store the information of the second player in
        // javascript
        include("php/connect.php");//contains all passwords.
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//now we will get the two users from the database and see which one 
$sql = "SELECT user, moved, position FROM troballa_users";
    $result = $conn->query($sql);
if($result === false) {
  echo "result row false, error while executing mysql: " . mysqli_error($conn);
 } else {
  $result2 =  $result -> fetch_all(MYSQLI_ASSOC);

	$names = array_column($result2, 'user');
	$moves = array_column($result2, 'moved');
	$poss = array_column($result2, 'position');
        
        if($names[0] === $name) {
            $name2 = $names[1];
            $moved2 = $moves[1];
            $position2 = $poss[1];
        }
        else {
            $name2 = $names[0];
            $moved2 = $moves[0];
            $position2 = $poss[0];
        }        
 }	
?>


<script>
var selected = "", notsel="";
var prevtile="";
var availableturn=false;

var jugador1 = "<?php echo $name ?>";
var jugador2 = "<?php echo $name2 ?>";
var posh1 = "<?php echo $position ?>";
var posh2 = "<?php echo $position2 ?>";
var moved = "<?php echo $moved ?>";
var moved2 = "<?php echo $moved2 ?>";
var canmove = "<?php if($moved==="0"){echo "yes";
                } else {echo "no";}
             ?>";


var jug1html='<div id="jugador1"><span class="leg1"></span><span class="leg2"></span><span class="arms"></span><span class="body"></span><span class="head"><div id="cara1" class="cara">:)</div></span></div>';
var jug2html='<div id="jugador2"><span class="leg1"></span><span class="leg2"></span><span class="arms"></span><span class="body"></span><span class="head"><div id="cara2" class="cara">:(</div></span></div>';


function loadplayas() {
    document.getElementById("loadplayas").style.visibility = "hidden";
    document.getElementById(posh1).innerHTML = jug1html;
    document.getElementById(posh2).innerHTML = jug2html;
    availableturn = true;
}

function saveplaypos() {
    document.getElementById("formpos").value =posh1;
    document.getElementById("formmoved").value =moved;
    document.getElementById("userr").value =jugador1;
}

function writestatus() {
    document.getElementById("playname").innerHTML ="<b> You play as: '" + jugador1 + "'</b>,";
    document.getElementById("playpos").innerHTML ="position: <b>" + posh1 +"</b>,";
    document.getElementById("playmoved").innerHTML ="moved status: <b>" + moved + "</b>,";
        document.getElementById("pcanmove").innerHTML ="could move: <b>" + canmove + "</b>";
    document.getElementById("play2name").innerHTML ="player 2: '" + jugador2 + "',";
    document.getElementById("play2pos").innerHTML ="position: " + posh2;
    document.getElementById("play2moved").innerHTML ="moved status: " + moved2 + ",";
}
</script>
<body>
<h2 style="left:10px;top:-20px;position:absolute;" >A mighty adventure</h2>

<p id="echo" onclick="echsel()" style="left:470px;top:225px;color:black;font-size:120%" >mambo1</p>
<p id="mambo2" onclick="echsel()" style="left:470px;top:275px;color:black;font-size:120%" >yo low</p>

<button id="loadplayas" class="submitbut" onclick="loadplayas()" style="top:30px;left:520px">load da playas in da sist!!</button>
<!-- Ma boy, aquí poso un formulari per refrescar la pagina -->
<form id="form1"  method="post" action="php/savegame.php" onsubmit="saveplaypos()" >
        <input  name="userr" id="userr"  style="visibility:hidden;">
        <input  name="moved" id="formmoved"  style="visibility:hidden;">
        <input  name="position" id="formpos"  style="visibility:hidden;">
        <input id="nextturnbut" type="submit" class="submitbut" value="Next turn ma fellas!" style="position:absolute;top:50px;left:470px;visibility:hidden" />
</form>

<form id="refresh"  method="post" action="php/loadgame.php" style="visibility:hidden">
        <input  name="user" id="user"  style="visibility:hidden;">
        <input id="reload" type="submit" class="submitbut" value="reloadgame" style="position:absolute;top:50px;left:470px;visibility:hidden"/>
</form>

<div id="player-status" style="position:absolute;top:30px;left:50px;color:cornflowerblue" >
    <span id="playname"></span>
    <span id="playmoved"></span>
    <span id="playpos"></span>
    <span id="pcanmove"></span>
</div>
<div id="play2-status" style="position:absolute;top:50px;left:50px;color:salmon" >
    <span id="play2name"></span>
    <span id="play2moved"></span>
    <span id="play2pos"></span>
</div>

<div class="earth" style="top:70px;left:470px"></div><p class="header_grass ">field</p>
<div class="water" style="top:125px;left:470px"></div><p class="header_water ">river</p>
<div class="mineral" style="top:180px;left:470px"></div><p class="header_mineral">mineral</p>

<!-- Row  1  --> 
<div id="1-1" class="water" style="top:70px;left:50px"></div>
<div id="1-2" class="water" style="top:70px;left:105px"></div>
<div id="1-3" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:70px;left:160px"></div>
<div id="1-4" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:70px;left:215px"></div>
<div id="1-5" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:70px;left:270px"></div>
<div id="1-6" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:70px;left:325px"></div>
<div id="1-7" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:70px;left:380px"></div>
<!-- Row  2  --> 
<div id="2-1" class="water" style="top:125px;left:50px"></div>
<div id="2-2" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:125px;left:105px"></div>
<div id="2-3" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:125px;left:160px"></div>
<div id="2-4" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:125px;left:215px"></div>
<div id="2-5" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:125px;left:270px"></div>
<div id="2-6" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:125px;left:325px"></div>
<div id="2-7" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:125px;left:380px"></div>
<!-- Row  3  --> 
<div id="3-1" class="mineral" style="top:180px;left:50px"></div>
<div id="3-2" class="water" style="top:180px;left:105px"></div>
<div id="3-3" class="water" style="top:180px;left:160px"></div>
<div id="3-4" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:180px;left:215px"></div>
<div id="3-5" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:180px;left:270px"></div>
<div id="3-6" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:180px;left:325px"></div>
<div id="3-7" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:180px;left:380px"></div>
<!-- Row  4  --> 
<div id="4-1" class="mineral" style="top:235px;left:50px"></div>
<div id="4-2" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:235px;left:105px"></div>
<div id="4-3" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:235px;left:160px"></div>
<div id="4-4" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:235px;left:215px"></div>
<div id="4-5" class="water" style="top:235px;left:270px"></div>
<div id="4-6" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:235px;left:325px"></div>
<div id="4-7" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:235px;left:380px"></div>
<!-- Row  5  --> 
<div id="5-1" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:290px;left:50px"></div>
<div id="5-2" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:290px;left:105px"></div>
<div id="5-3" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:290px;left:160px"></div>
<div id="5-4" class="water" style="top:290px;left:215px"></div>
<div id="5-5" class="water" style="top:290px;left:270px"></div>
<div id="5-6" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:290px;left:325px"></div>
<div id="5-7" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:290px;left:380px"></div>
<!-- Row  6  --> 
<div id="6-1" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:345px;left:50px"></div>
<div id="6-2" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:345px;left:105px"></div>
<div id="6-3" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:345px;left:160px"></div>
<div id="6-4" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:345px;left:215px"></div>
<div id="6-5" class="water" style="top:345px;left:270px"></div>
<div id="6-6" class="water" style="top:345px;left:325px"></div>
<div id="6-7" class="water" style="top:345px;left:380px"></div>
<!-- Row  7  --> 
<div id="7-1" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:400px;left:50px"></div>
<div id="7-2" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:400px;left:105px"></div>
<div id="7-3" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:400px;left:160px"></div>
<div id="7-4" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:400px;left:215px"></div>
<div id="7-5" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:400px;left:270px"></div>
<div id="7-6" class="earth" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)"  onclick="movepers(this)"  style="top:400px;left:325px"></div>
<div id="7-7" class="water" style="top:400px;left:380px"></div>

</body>
</html> 
