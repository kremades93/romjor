<?php
 
include("connect.php");//contains all passwords.
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, clics, active FROM botaula WHERE id=1";
    $result = $conn->query($sql);

	$row = mysqli_fetch_row($result);

	/*$id = array_column($result2, 'id');
	$clics = array_column($result2, 'clics');
	$active = array_column($result2, 'active');*/

$active = (int)$row[2]; $clics = (int)$row[1];

if($active===1) {$active =0;
} else {$active=1;}

$sql = "UPDATE botaula SET clics=($clics+1), active=$active WHERE id=1";

if ($conn->query($sql) === FALSE) {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

header("Location: ../boto.php");

?> 
