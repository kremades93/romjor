<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../style/button.css">


<script>
    function submitform()
    {
        document.getElementById("form2").submit();
    }
</script>
</head>

<body onload="submitform()">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
    $name = $_POST['userr'];
    $position = $_POST['position'];
    $moved = $_POST['moved'];
     
  if (empty($name)) {
    echo "Name is empty";
  } else {
    echo "You want to play as '" . $name ."'<br>";
  }
}

include("connect.php");//contains all passwords.
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//loading data from 2nd player:
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
if($moved=="0") {$moved="1";}
if($moved2==="1" && $moved==="1") {
    $moved="0"; $moved2="0";
    
    $sql = "UPDATE troballa_users SET moved='$moved2' WHERE user='$name2'";
    $result = $conn->query($sql);
    
if($result === false) {
  echo "error in reseting moves to 0 while executing mysql: " . mysqli_error($conn);
}
    
}

$sql = "UPDATE troballa_users SET position='$position', moved='$moved' WHERE user='$name'";
    $result = $conn->query($sql);
    
if($result === false) {
  echo "error while executing mysql: " . mysqli_error($conn);
 } else {
        
        echo "selected '" . $name . "' with moved=".$moved ." and at position: " . $position ."<br>";
        echo "other player: '" . $name2 . "' with moved=".$moved2 ." and at position: " . $position2 ."<br>";
        echo '<form id="form2" action="loadgame.php" method="post" >
            <input value="'.$name.'" name="user" id="user"> 
            <input class ="submitbut"  type="submit" value="Start game"> 
        </form>';  
    }
    
    $conn->close();
  ?>


</body>
</html> 