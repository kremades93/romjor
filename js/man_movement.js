
<!-- Aquesta funció quina funcio té? -->
function echsel(txt = "") {
   document.getElementById("echo").innerHTML = txt + ".selected=" + selected + ".";
}

<!-- Moviment dels little men -->
function movepers(x) {
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
