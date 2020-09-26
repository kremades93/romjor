<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getplaya($game, $user, $conn, $table='troballa_users') {
    $sql = "SELECT * from $table WHERE game ='$game' AND user='$user'";
    $result = $conn->query($sql);
    if ($result === FALSE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
      $result2  =  $result -> fetch_all(MYSQLI_ASSOC);
    }

            $name = array_column($result2, 'user')[0];
            $moved = array_column($result2, 'moved')[0];
            $pos = array_column($result2, 'position')[0];
            $thirst = array_column($result2, 'thirst')[0];
            $hunger = array_column($result2, 'hunger')[0];
            $health = array_column($result2, 'health')[0];

    return compact('name','moved','pos','thirst','hunger','health');
}
?>