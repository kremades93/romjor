
// Aquesta funció quina funcio té? --> 
// Romà: ni idea, només era per provar d'ensenyar el valor d'unes variables
function echsel(txt = "") {
   document.getElementById("position_man1").innerHTML = txt + ".selected=" + selected + ".";
}

function movepers2(x,posh1){
    if (posh2=="3-5"){
        x.innerHTML=humanhtml;
    }
}

//Aquesta funció ha quedat obsoleta!!!!
function movepers0(x) {
    if(selected != "") { //this means the human is already selected
        if(x.className==="earth" && x.id != notsel) {
            prevtile.innerHTML="";
            x.innerHTML=humanhtml;
            selected="", notsel="";
            if(prevtile.id===posh1) posh1 = x.id;
            if(prevtile.id===posh2) posh2 = x.id;
        }
        document.getElementById("position_man1").innerHTML = "class:" + x.className + " id: " + x.id;
    } else if ( x.id===posh1 || x.id===posh2 ){
        if(x.id===posh1) {selected=posh1; notsel=posh2}
        if(x.id===posh2) {selected=posh2; notsel=posh1}
        x.innerHTML = happyhuman;
        prevtile=x;
    }
}

//Romà 22.06.2020: he modificat la funció movepers() i  a la original la he anomenat movepers0()
//Jordi: no s'utilitza aquesta funció ara... s'utilitza la movepers0
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