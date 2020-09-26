<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../style/button.css">
        <link rel="stylesheet" href="../style/tables.css">

        <script type="text/javascript" src="../js/functions/submitform.js"></script>
    </head>

<body onload="">

<?php

        //Retrieve info from the previous php file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $game = $_POST['game'];
          $jugador1 = $_POST['jugador1'];
          $nplayas = $_POST['numbplayas'];
        }


include("connect.php");
include("getdata/getuser.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name from animals WHERE game ='$game'";
$result = $conn->query($sql);
if ($result === FALSE) {
  echo "Error: " . $sql . "<br>" . $conn->error;
} else {
  $result2  =  $result -> fetch_all(MYSQLI_ASSOC);
}

$name = array_column($result2, 'name');

echo "<p>Loading game: $game ... </p>";
echo "<p>Animals in the game:</p>"
. "<ul>";
for ($i = 0; $i < sizeof($name) ; $i++) { /* printing different games */
     echo '<li>'.$name[$i].'</li>';
}
echo "</ul>";

 echo  '<form id="form2"  method="post" action="mam.php" style="visibility:visible"> 
     

    <table  class="table1">
    <tr>    
      <td>animals</td>    
      <td>player name</td>
      <td>game name</td>
      <td>number of players</td>
    </tr>   
    <tr>    
      <td><input  name="animals"  value="'.implode(",",$name).'" style="visibility:visible"></td>    
      <td><input  name="jugador1"  value="'.$jugador1.'" style="visibility:visible"></td>    
      <td><input  name="game"  value="'.$game.'" style="visibility:visible"></td>    
      <td><input  name="nplayas"  value="'.$nplayas.'" style="visibility:visible"></td>
      <td><input class ="submitbut"  type="submit" value="Start game"></td>
    </tr>    
    </table>  


            
        </form>';  
 


$playa1 = getplaya($game,$jugador1,$conn);

echo "<p> ".$playa1['name']." - ".$playa1['pos']." - ".$playa1['hunger']." - ".$playa1['thirst']."</p>";

$playa2 = getplaya($game,'jugador2',$conn); //this line is wrong

echo "<p> ".$playa2['name']." - ".$playa2['pos']." - ".$playa2['hunger']." - ".$playa2['thirst']."</p>";

$conn->close();


?>

    
</body>
</html> 