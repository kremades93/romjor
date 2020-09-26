<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../style/button.css">

        <script type="text/javascript" src="../js/functions/submitform.js"></script>
    </head>

<body onload="">


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include("connect.php");
include("getdata/getuser.php");
include("getdata/getanimal.php");


// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $game = $_POST['game'];
      $jugador1 = $_POST['jugador1'];
      $nplayas = $_POST['nplayas'];
      $animals = $_POST['animals'];
    }
        
        
        
     echo "<p>partida: $game, jugador: $jugador1, number of players: $nplayas "
    . "animals: $animals</p>";
  
     
     
    
     
    $jug1 = getplaya($game, $jugador1, $conn);
      
    echo "<p>name: ".$jug1['name'].", moved:". $jug1['moved'].", position: ". $jug1['pos'].
            ", thirst: ". $jug1['thirst'].", hunger: ". $jug1['hunger'].", health: ". $jug1['health']."</p>  ";
  
    $animal1 = getanimal($game, "hiena2", $conn);
      
    echo "<p>name: ".$animal1['name'].", position: ". $animal1['pos'].
            ", thirst: ". $animal1['thirst'].", hunger: ". $animal1['hunger'].", health: ". $animal1['health']."</p>  ";
  
        

$conn->close();
?>

    
    
    
</body>
</html> 