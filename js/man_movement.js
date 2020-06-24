
// Aquesta funció quina funcio té? --> 
// Romà: ni idea, només era per provar d'ensenyar el valor d'unes variables
function echsel(txt = "") {
   document.getElementById("echo").innerHTML = txt + ".selected=" + selected + ".";
}

//<!-- Moviment dels little men -->
function movepers0(x) {
    if(selected != "") { //this means the human is already selected
        if(x.className==="earth" && x.id != notsel) {
            prevtile.innerHTML="";
            x.innerHTML=humanhtml;
            selected="", notsel="";
            if(prevtile.id===posh1) posh1 = x.id;
            if(prevtile.id===posh2) posh2 = x.id;
        }
        document.getElementById("echo").innerHTML = "class:" + x.className + " id: " + x.id;
    } else if ( x.id===posh1 || x.id===posh2 ){
        if(x.id===posh1) {selected=posh1; notsel=posh2}
        if(x.id===posh2) {selected=posh2; notsel=posh1}
        x.innerHTML = happyhuman;
        prevtile=x;
    }
}

function movepers2(x,posh1){
    if (posh2=="3-5"){
        x.innerHTML=humanhtml;
    }
}

//Romà 22.06.2020: he modificat la funció movepers() i  a la original la he anomenat movepers0()
function movepers(x) {
    if(selected != "") { //this means the human is already selected
        if(x.className==="earth" && x.id != posh2) {
            prevtile.innerHTML="";
            x.innerHTML=jug1html;
            document.getElementById("cara1").innerHTML =":)";
            selected="";
            posh1 = x.id;
        }
        document.getElementById("echo").innerHTML = "class:" + x.className + " id: " + x.id;
    } else if ( x.id===posh1 ){
        if(x.id===posh1) {selected=posh1;}
        x.innerHTML = jug1html;
        document.getElementById("cara1").innerHTML =":D";
        prevtile=x;
    }
}