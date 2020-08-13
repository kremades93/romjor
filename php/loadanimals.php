<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../style/button.css">

        <script type="text/javascript" src="../js/functions/submitform.js"></script>
    </head>

<body onload="submitform('form2')">

<?php

        //Retrieve info from the previous php file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $game = $_POST['game'];
          $jugador1 = $_POST['jugador1'];
        }


include("connect.php");


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
        <input  name="animals"  value="'.implode(",",$name).'" style="visibility:visible">
        <input  name="jugador1"  value="'.$jugador1.'" style="visibility:visible">
        <input  name="game"  value="'.$game.'" style="visibility:visible">  
        </form>';  


$conn->close();


?>

    
</body>
</html> 