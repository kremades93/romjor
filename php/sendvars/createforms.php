<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function creasimpform($formid, $action, $innames, $invalues) {
    $formulari = '<form id="'.$formid.'"  method="post" action="'.$action.'" style="visibility:visible">';
    
    for ($i = 0; $i < sizeof($innames) ; $i++) { /* writing down the different inputs and values */
        $formulari = $formulari . '<input  name="'.$innames[$i].'"  value="'.$invalues[$i].'" style="visibility:visible"> ';
    }    
    
    
    $formulari = $formulari . '</form>';
    
    return $formulari;
}


function creaselectform($formid, $action, $selname, $seloptions, 
        $selonclick, $innames, $invalues){
    
    $formulari = '<form id="'.$formid.'"  method="post" action="'.$action.'" style="visibility:visible">';
    $formulari = $formulari . '<select name="'.$selname.'" >';
    for ($i = 0; $i < sizeof($seloptions) ; $i++) { /* printing different games */
        $formulari = $formulari . '<option onclick="'.$selonclick.'(\''.$formid.'\')" value="'.$seloptions[$i].'">'.$seloptions[$i].'</option> \n';
    }
    
    for ($i = 0; $i < sizeof($innames) ; $i++) { /* writing down the different inputs and values */
        $formulari = $formulari . '<input  name="'.$innames[$i].'"  value="'.$invalues[$i].'" style="visibility:hidden"> ';
    }   
    
    $formulari = $formulari . '</form>';
    
    return $formulari;
    
}

?>