<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getanimal($game, $aname, $conn, $table='animals') {
    $sql = "SELECT * from $table WHERE game ='$game' AND name='$aname'";
    $result = $conn->query($sql);
    if ($result === FALSE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
      $result2  =  $result -> fetch_all(MYSQLI_ASSOC);
    }

            $name = array_column($result2, 'name')[0];
            $pos = array_column($result2, 'pos')[0];
            $thirst = array_column($result2, 'thirst')[0];
            $hunger = array_column($result2, 'hunger')[0];
            $health = array_column($result2, 'health')[0];

    return compact('name','pos','thirst','hunger','health');
}
?>