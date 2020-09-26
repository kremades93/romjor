<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 echo  '<form id="playerform"  method="post" action="loadanimals.php" style="visibility:visible">     
        <label >Play as:</label>
        <select name="jugador1" >';


for ($i = 0; $i < sizeof($users) ; $i++) { /* printing different games */
     echo '<option onclick="submitform(\'playerform\')" value="'.$users[$i].'">'.$users[$i].'</option> \n';
}
  echo      '</select>
        <input  name="game"  value="'.$game.'" style="visibility:hidden">';
   for ($i = 0; $i < sizeof($users) ; $i++)  {/* printing different games */
     echo '<input  name="playa'.$i.'"  value="'.$users[$i].'" style="visibility:hidden"> ';
    }
     echo '<input  name="numbplayas"  value="'.sizeof($users).'" style="visibility:hidden"> ';

     echo '</form>';  


     
?>