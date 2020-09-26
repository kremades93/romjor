<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../style/button.css">

    <script type="text/javascript" src="../js/functions/submitform.js"></script>

    </head>

<body >

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include("connect.php");


// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT game from games";
$result = $conn->query($sql);
if ($result === FALSE) {
  echo "Error: " . $sql . "<br>" . $conn->error;
} else {
  $result2  =  $result -> fetch_all(MYSQLI_ASSOC);
}

$games = array_column($result2, 'game');



echo  '<form id="gameform"  method="post" action="loadplayers.php" style="visibility:visible">     
         <label for="cars">Choose a game:</label>
        <select name="game" >';

    for ($i = 0; $i < sizeof($games) ; $i++) { /* printing different games */
        echo '<option onclick="submitform(\'gameform\')" value="'.$games[$i].'">'.$games[$i].'</option>';
    }
      echo      '</select>
            </form>'; 
 


$conn->close();


?>

    
</body>
</html> 