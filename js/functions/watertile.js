/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function watertile(x) {
    if(availableturn && canmove=="yes" ) {
        if( dead() ) reportdeath();
        else if(validmove(posh1, x.id)) {           
            thirst = thirst + 5;
            thirst = Math.max(thirst,10);
            updatefood();
            writestatus();
            finishturn();
        }        
    }
}


