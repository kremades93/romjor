<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getusernames($game, $conn, $table='troballa_users') {
    $sql = "SELECT * from $table WHERE game ='$game'";
    $result = $conn->query($sql);
    if ($result === FALSE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
      $result2  =  $result -> fetch_all(MYSQLI_ASSOC);
    }
            $users = array_column($result2, 'user');

    return $users;
}

?>