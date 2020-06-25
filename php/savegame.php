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
    $name = $_POST['user'];
    $position = $_POST['position'];
     
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

$sql = "UPDATE troballa_users SET position=$position WHERE user='$name'";
    $result = $conn->query($sql);
    
if($result === false) {
  echo "error while executing mysql: " . mysqli_error($conn);
 } else {
        $moved = $row[1]; $position = $row[2];

        echo "selected '" . $name . "' with moved=".$moved ." and at position: " . $position ."<br>";
        echo '<form id="form2" action="loadgame.php" method="post" >
            <input value="$name" name="user" id="user"> 
            <input class ="submitbut"  type="submit" value="Start game"> 
        </form>';  
    }
    
    $conn->close();
  ?>


</body>
</html> 