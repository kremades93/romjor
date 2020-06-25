var comprov = "false";
var comprov2 = "false";

function loadmap() {
     while (comprov=="false"){
         var r1= Math.floor(Math.random() * 7);
         var r2= Math.floor(Math.random() * 7);
         posh1 = r1+"-"+r2;
         if(map[r1][r2]=="0"){
            document.getElementById(posh1).innerHTML = man1_pos_0;
            comprov = "true";
         }
         document.getElementById("comprov1").innerHTML = posh1;
     }
     while (comprov2=="false"){
         var r1= Math.floor(Math.random() * 7);
         var r2= Math.floor(Math.random() * 7);
         posh2 = r1+"-"+r2;
         if(map[r1][r2]=="0" && posh2 != posh1){
            document.getElementById(posh2).innerHTML = man2_pos_0;
            comprov2 = "true";
         }
         document.getElementById("comprov2").innerHTML = posh2;
     }
}