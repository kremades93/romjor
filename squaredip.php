<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style/mapa.css">
    <link rel="stylesheet" href="style/button.css">
    <link rel="stylesheet" href="style/headers.css">
    <link rel="stylesheet" href="style/controls.css">
    <link rel="stylesheet" href="style/body.css">

    <script type="text/javascript" src="js/class/animal.js"></script>
    <script type="text/javascript" src="js/class/object.js"></script>
    <script type="text/javascript" src="js/class/person.js"></script>
    <script type="text/javascript" src="js/class/turns.js"></script>

    
    <script type="text/javascript" src="js/functions/man_movement.js"></script>
    <script type="text/javascript" src="js/functions/tiles_onmouse.js"></script>
    <script type="text/javascript" src="js/functions/man_loading.js"></script>
    <script type="text/javascript" src="js/functions/tiles_matrix.js"></script>
    <script type="text/javascript" src="js/functions/turns.js"></script>
    <script type="text/javascript" src="js/functions/watertile.js"></script>
    </head>


<body onload="loadgame();">

    <?php
        //Retrieve info from the previous php file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $name = $_POST['user'];
          $moved = $_POST['moved'];
          $position = $_POST['position'];
          $thirst = $_POST['thirst'];
          $hunger = $_POST['hunger'];
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
$sql = "SELECT user, moved, position, thirst, hunger FROM troballa_users";
    $result = $conn->query($sql);
if($result === false) {
  echo "result row false, error while executing mysql: " . mysqli_error($conn);
 } else {
  $result2 =  $result -> fetch_all(MYSQLI_ASSOC);

	$names = array_column($result2, 'user');
	$moves = array_column($result2, 'moved');
	$poss = array_column($result2, 'position');
        $thirs = array_column($result2, 'thirst');
        $hungs = array_column($result2, 'hunger');
        
        if($names[0] === $name) {
            $name2 = $names[1];
            $moved2 = $moves[1];
            $position2 = $poss[1];
            $thirst2 = $thirs[1];
            $hunger2 = $hungs[1];            
        }
        else {
            $name2 = $names[0];
            $moved2 = $moves[0];
            $position2 = $poss[0];
            $thirst2 = $thirs[0];
            $hunger2 = $hungs[0];  
        }        
 }	
?>


<script>
    
    //here we set the first global variables
var selected = "", notsel="";
var prevtile="";
var availableturn=false;

var jugador1 = "<?php echo $name ?>";
var jugador2 = "<?php echo $name2 ?>";
var posh1 = "<?php echo $position ?>";
var posh2 = "<?php echo $position2 ?>";
var moved = "<?php echo $moved ?>"; if(moved==="1") moved=true; else {moved=false;}
var moved2 = "<?php echo $moved2 ?>"; if(moved2==="1") moved2=true; else {moved2=false;}
var thirst = "<?php echo $thirst ?>";
var thirst2 = "<?php echo $thirst2 ?>";
var hunger = "<?php echo $hunger ?>";
var hunger2 = "<?php echo $hunger2 ?>";  


var jug1html='<div id="jugador1"><span class="leg1"></span><span class="leg2"></span><span class="arms"></span><span class="body"></span><span class="head"><div id="cara1" class="cara">:)</div></span></div>';
var jug2html='<div id="jugador2"><span class="leg1"></span><span class="leg2"></span><span class="arms"></span><span class="body"></span><span class="head"><div id="cara2" class="cara">:(</div></span></div>';


//               (pos, select, name, id, visible, thirst,hunger,dead, html, moved=false, cara=":S", carahtml) {

//jugad1 = new person(posh1, false, jugador1, id="jugador1", visible=true, thirst, hunger, false, jug1html, moved, ":0","cara1");
//jugad2 = new person(posh2, false, jugador2, id="jugador2", visible=true, thirst, hunger, false, jug1htm2, moved2, ":0","cara2");

turn = new turn(ended=false);



function loadgame() {
    document.getElementById("mambo3").innerHTML = "Moonshine " + posh1 + " select: " + "name: " + jugador1 + " id: " + " thirst: " + thirst + " hunger: " + hunger +
            " html: " + jug1html + " moved: " + moved + " turn: " + turn.ended;
    
    turn.checkturn();
    document.getElementById("mambo3").innerHTML = "Yo-Low";
    turn.writestatus();
    turn.loadplayas();   
    turn.updategroceries();
}


</script>
<body>
    <div id="gradient"></div>
    
<h2 style="left:10px;top:-20px;position:absolute;" >A mighty adventure</h2>

<div class="fonshungerbar">
  <div id="hunger1" class="hungerbar" style="width:70%"></div>
 </div>  <p class="hungertext">hunger</p> 
 <div class="fonsthirstbar">
  <div id="waterl" class="thirst" style="width:50%"></div>
 </div> <p class="thirsttext">thirst</p> 

 
<h2 id="mambo2" style="position:absolute;left:470px;top:280px;">hooli</h2>
<h2 id="mambo3" style="position:absolute;left:470px;top:320px;">hoodli</h2>

<button id="loadplayas" class="submitbut" onclick="turn.loadplayas()" style="top:30px;left:520px">load da playas in da sist!!</button>
<!-- Ma boy, aquí poso un formulari per refrescar la pagina -->
<form id="form1"  method="post" action="php/savegame.php" onsubmit="saveplaypos()" >
        <input  name="userr" id="userr"  style="visibility:hidden;">
        <input  name="moved" id="formmoved"  style="visibility:hidden;">
        <input  name="position" id="formpos"  style="visibility:hidden;">
        <input  name="hunger" id="fromhung"  style="visibility:hidden;">
        <input  name="thirst" id="formthirst"  style="visibility:hidden;">
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
<div id="1-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:50px"   ></div>
<div id="1-2" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:105px"   ></div>
<div id="1-3" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:160px"   ></div>
<div id="1-4" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:215px"   ></div>
<div id="1-5" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:270px"   ></div>
<div id="1-6" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:325px"   ></div>
<div id="1-7" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:70px;left:380px"   ></div>
<!-- Row  2  --> 
<div id="2-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:50px"   ></div>
<div id="2-2" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:105px"></div>
<div id="2-3" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:160px"></div>
<div id="2-4" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:215px"   ></div>
<div id="2-5" class="mineral" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:270px"></div>
<div id="2-6" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:325px"   ></div>
<div id="2-7" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:125px;left:380px"   ></div>
<!-- Row  3  --> 
<div id="3-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:50px"   ></div>
<div id="3-2" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:105px"   ></div>
<div id="3-3" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:160px"   ></div>
<div id="3-4" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:215px"></div>
<div id="3-5" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:270px"   ></div>
<div id="3-6" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:325px"   ></div>
<div id="3-7" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:180px;left:380px"   ></div>
<!-- Row  4  --> 
<div id="4-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:50px"   ></div>
<div id="4-2" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:105px"   ></div>
<div id="4-3" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:160px"   ></div>
<div id="4-4" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:215px"   ></div>
<div id="4-5" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:270px"   ></div>
<div id="4-6" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:325px"   ></div>
<div id="4-7" class="mineral" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:235px;left:380px"></div>
<!-- Row  5  --> 
<div id="5-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:50px"   ></div>
<div id="5-2" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:105px"   ></div>
<div id="5-3" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:160px"   ></div>
<div id="5-4" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:215px"></div>
<div id="5-5" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:270px"   ></div>
<div id="5-6" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:325px"></div>
<div id="5-7" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:290px;left:380px"   ></div>
<!-- Row  6  --> 
<div id="6-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:50px"   ></div>
<div id="6-2" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:105px"   ></div>
<div id="6-3" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:160px"   ></div>
<div id="6-4" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:215px"   ></div>
<div id="6-5" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:270px"   ></div>
<div id="6-6" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:325px"></div>
<div id="6-7" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:345px;left:380px"></div>
<!-- Row  7  --> 
<div id="7-1" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:50px"   ></div>
<div id="7-2" class="mineral" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:105px"></div>
<div id="7-3" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:160px"   ></div>
<div id="7-4" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:215px"   ></div>
<div id="7-5" class="earth" onclick="movepers(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:270px"   ></div>
<div id="7-6" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:325px"></div>
<div id="7-7" class="water" onclick="watertile(this)" onmouseover="bigImgE(this)" onmouseout="normalImgE(this)" style="top:400px;left:380px"></div>

</body>
</html> 
