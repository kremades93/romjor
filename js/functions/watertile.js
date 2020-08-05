/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function watertile(x) {
    if(!turn.ended && !jugad1.moved ) {
        if( jugad1.dead ) jugad1.reportdeath("mambon5");
        else if(validmove(jugad1.pos, x.id)) {           
            jugad1.drink(5);
            turn.updategroceries();
            turn.writestatus();
            turn.saveplaypos();
            turn.finishturn();
        }        
    }
}


