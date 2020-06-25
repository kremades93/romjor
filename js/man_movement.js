var selected = "";
var notsel="";
var prevtile="";

function move(x) {
    if(selected != "") { //this means the human is already selected
        if(x.className==="earth" && x.id != notsel) {
            prevtile.innerHTML="";
            x.innerHTML=man_pos_0;
            selected="", notsel="";
            if(prevtile.id===posh1) posh1 = x.id;
            if(prevtile.id===posh2) posh2 = x.id;
        }
        document.getElementById("tag_position_man1").innerHTML = "class:" + x.className + " id: " + x.id;
    } else if ( x.id===posh1 || x.id===posh2 ){
        if(x.id===posh1) {selected=posh1; notsel=posh2}
        if(x.id===posh2) {selected=posh2; notsel=posh1}
        x.innerHTML = man_pos_1;
        prevtile=x;
    }
}







<!-- FUNCIONS OBSOLETES------------------------------------------------------------------------------------------------->
<!-- FUNCIONS OBSOLETES------------------------------------------------------------------------------------------------->
<!-- FUNCIONS OBSOLETES------------------------------------------------------------------------------------------------->

function movepers(x) {
    if(selected != "") { //this means the user has selected the human
        if(x.className==="earth" && x.id != posh2) {
            prevtile.innerHTML="";
            x.innerHTML=jug1html;
            document.getElementById("cara1").innerHTML =":)";
            selected="";
            posh1 = x.id;
        }
        document.getElementById("mambo1").innerHTML = "class:" + x.className + " id: " + x.id;
    } else if ( x.id===posh1 ){
        if(x.id===posh1) {selected=posh1;}
        x.innerHTML = jug1html;
        document.getElementById("cara1").innerHTML =":D";
        prevtile=x;
    }
}

function movepers2(x,posh1){
    if (posh2=="3-5"){
        x.innerHTML=humanhtml;
    }
}


