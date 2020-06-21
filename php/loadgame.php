<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../style/button.css">


<script>
    function submitform()
    {
        document.getElementById("form2").value = "oh la la ";    
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

$sql = "SELECT user, moved, position FROM troballa_users WHERE user='$name'";
    $result = $conn->query($sql);
if($result === false) {
  echo "error while executing mysql: " . mysqli_error($conn);
 } else {
  $row = mysqli_fetch_row($result);
}
	

	/*$id = array_column($result2, 'id');
	$clics = array_column($result2, 'clics');
	$active = array_column($result2, 'active');*/
if(empty($row)) {
    echo "no player found with this name <br>";
    echo '<form action="../index.html">
        <input type="submit" class="submitbut" value="Go back" />
        </form>';
} else {
    $moved = $row[1]; $position = $row[2];

    echo "selected '" . $name . "' with moved=".$moved ." and at position: " . $position ."<br>";
    echo '<form id="form2"  method="post" action="../squaredip.php">
        <input  name="user" value="'.$name.'"> 
        <input  name="moved"  value="'.$moved.'">
        <input  name="position"  value="'.$position.'">
        <input type="submit" class="submitbut" value="" />
        </form>';  
    }
    
    $conn->close();
  ?>






</body>
</html> 