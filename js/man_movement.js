var selected = "";
var notsel="";
var prevtile="";


function move(x) {
    if(selected != "") { //this means the human is already selected
        if(x.className==="earth" && x.id != notsel) {
            prevtile.innerHTML="";
            selected="", notsel="";
            if(prevtile.id===posh1){x.innerHTML=man1_pos_0; posh1 = x.id}
            if(prevtile.id===posh2){x.innerHTML=man2_pos_0; posh2 = x.id}
        }
        document.getElementById("tag_position_man1").innerHTML = "class:" + x.className + " id: " + x.id;
    } else if ( x.id===posh1 || x.id===posh2 ){
        if(x.id===posh1) {selected=posh1; notsel=posh2}
        if(x.id===posh2) {selected=posh2; notsel=posh1}
        if(prevtile.id===posh1){x.innerHTML=man1_pos_0}
        if(prevtile.id===posh2){x.innerHTML=man2_pos_0}
        prevtile=x;
    }
}

//<!-- FUNCIONS OBSOLETES------------------------------------------------------------------------------------------------->
//<!-- FUNCIONS OBSOLETES------------------------------------------------------------------------------------------------->
//<!-- FUNCIONS OBSOLETES------------------------------------------------------------------------------------------------->

function movepers(x) {
    if(availableturn && canmove=="yes") {
        if(selected != "") { //this means the user has selected the human
            if(x.className==="earth" && x.id != posh2 && validmove(posh1, x.id)) {
                document.getElementById("mambo2").innerHTML ="posh1: "+ posh1 + ", x.id: " + x.id + ", valid move:" + validmove(posh1, x.id);
                prevtile.innerHTML="";
                x.innerHTML=jug1html;
                document.getElementById("cara1").innerHTML =":)";
                selected="";
                posh1 = x.id;
                moved=1;
                writestatus();
                finishturn();
                
                

            }
            document.getElementById("mambo1").innerHTML = "class:" + x.className + " id: " + x.id;
        } else if ( x.id===posh1 ){
            selected=posh1;
            x.innerHTML = jug1html;
            document.getElementById("cara1").innerHTML =":D";
            prevtile=x;
        }
    }
}

function validmove(pos1,pos2, length=1) { //pos1 and pos2 should be in the format "2-4" 
    posi1 = pos1.split("-");
    posi2 = pos2.split("-");
    if(Math.abs(posi1[0]-posi2[0]) + Math.abs(posi1[1]-posi2[1]) <= length ) return true;
    return false;
}
