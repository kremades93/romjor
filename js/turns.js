/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function finishturn() {
    availableturn = false;
    document.getElementById("nextturnbut").style.visibility = "visible";
        document.getElementById("mambon5").innerHTML = "turn ended";

}

function checkturn() {
    if(canmove=="no") {
        document.getElementById("user").value =jugador1;
        setTimeout(function(){ document.getElementById("refresh").submit(); }, 3000);
        
        
    }
}