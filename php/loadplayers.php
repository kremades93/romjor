<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../style/button.css">

        <script type="text/javascript" src="../js/functions/submitform.js"></script>
    </head>

<body >

<?php

        //Retrieve info from the previous php file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $game = $_POST['game'];
        }


include("connect.php");


// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user from troballa_users WHERE game ='$game'";
$result = $conn->query($sql);
if ($result === FALSE) {
  echo "Error: " . $sql . "<br>" . $conn->error;
} else {
  $result2  =  $result -> fetch_all(MYSQLI_ASSOC);
}

$users = array_column($result2, 'user');
echo "<p>Loading game: $game ... </p>";

 echo  '<form id="form2"  method="post" action="loadanimals.php" style="visibility:visible">     
        <label >Play as:</label>
        <select name="jugador1" >';


for ($i = 0; $i < sizeof($users) ; $i++) { /* printing different games */
     echo '<option onclick="submitform(\'form2\')" value="'.$users[$i].'">'.$users[$i].'</option>';
}
  echo      '</select>
        <input  name="game"  value="'.$game.'" style="visibility:hidden">  
        </form>';  


$conn->close();


?>

    
</body>
</html> 