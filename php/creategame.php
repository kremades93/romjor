<?php

/* 
 * we should have a table with animal on it, and a table with the users:
 * id 	animal 	name 	game 	pos 	hunger 	thirst 	health 	
1 	hiena 	hiena1 	partida1 	7-4 	10.00 	10.00 	10.00
 * 
 * id	user	game	moved	position	thirst	hunger	health 	
	Editar Editar	Copiar Copiar	Borrar Borrar	1 	jugador1 	partida1 	1 	5-3 	2.00 	2.00 	10.00
	Editar Editar	Copiar Copiar	Borrar Borrar	2 	jugador2 	partida1 	0 	1-5 	8.00 	5.40 	10.00
 */

include("connect.php");



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>