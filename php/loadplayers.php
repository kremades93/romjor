<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../style/button.css">

        <script type="text/javascript" src="../js/functions/submitform.js"></script>
    </head>

<body >

<?php
//upload functions that create forms 
include("sendvars/createforms.php");
//upload functions that get data rows from server
include("getdata/getusernames.php");

include("connect.php");
        //Retrieve info from the previous php file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $game = $_POST['game'];
        }
        



// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



echo "<p>Loading game: $game ... </p>";

$users = getusernames($game, $conn, $table='troballa_users');


$form = creaselectform($formid = "playerform", $action = "loadanimals.php", $selname = "jugador1",
        $seloptions = $users, $selonclick = "submitform", 
        $innames = array("game","numbplayas"), $invalues = array($game, sizeof($users)));

echo $form;


$innames = array("playa1", "numbplayas");
$invalues = array($users[0],sizeof($users));
$form = creasimpform("formulari1","loadanimals.php",$innames, $invalues);

echo $form;

$conn->close();


?>

    
</body>
</html> 