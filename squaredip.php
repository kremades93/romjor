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
</head>
<body>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
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
	



echo "<p style='position:absolute;left:600px'>hello $name, you moved $moved, and your position is $position. </p>"

?>
    
    
<script>
var selected = "", notsel="";
var prevtile="";

var jugador1 = "<?php echo $name ?>";
var jugador2 = "<?php echo $name2 ?>";
var posh1 = "<?php echo $position ?>";
var posh2 = "<?php echo $position2 ?>";


var jug1html='<div id="jugador1"><span class="leg1"></span><span class="leg2"></span><span class="arms"></span><span class="body"></span><span class="head"><div id="cara1" class="cara">:)</div></span></div>';
var jug2html='<div id="jugador2"><span class="leg1"></span><span class="leg2"></span><span class="arms"></span><span class="body"></span><span class="head"><div id="cara2" class="cara">:(</div></span></div>';


function loadplayas() {
    document.getElementById(posh1).innerHTML = jug1html;
    document.getElementById(posh2).innerHTML = jug2html;
}


</script>
<body>
<h2>A mighty adventure</h2>

<p id="echo" onclick="echsel()" style="left:470px;top:225px;color:black;font-size:120%" >mambo1</p>
<p id="mambo2" onclick="echsel()" style="left:470px;top:275px;color:black;font-size:120%" >mambo2</p>

<button class="submitbut" onclick="loadplayas()" style="top:30px;left:470px">load da playas in da sist!!</button>
<!-- Ma boy, aquí poso un formulari per refrescar la pagina -->
<form id="form1"  method="post" action="php/savegame.php" style="position:absolute;top:50px;left:470px;">
        <input  name="user" id="user" value=jugador1 style="visibility:visible;">
        <input  name="moved" id="formmoved"  style="visibility:visible;">
        <input  name="position" id="formpos"  style="visibility:visible;">
        <input type="submit" class="submitbut" value="Next turn ma fellas!" />
</form>

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