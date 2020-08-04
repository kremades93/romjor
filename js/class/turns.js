/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class turn {
    constructor(ended=false) {
      this._ended = ended;
    }
    
    get ended() {
      return this._ended;
    }

    set ended(ep) {
      this._ended = ep;
    }
    
    end() {
        this._ended = true;
    }   
    
    loadplayas() {
        document.getElementById("loadplayas").style.visibility = "hidden";
        jugad1.place(posh1);
        jugad2.place(posh2);
        //availableturn = true;
    }

    saveplaypos() {
        document.getElementById("formpos").value = jugad1.pos;
        if(jugd1.moved) moved="1"; else {moved="0"};
        document.getElementById("formmoved").value = moved ;
        document.getElementById("userr").value =jugad1.name ;
        document.getElementById("fromhung").value =jugad1.hunger ;
        document.getElementById("formthirst").value = jugad1.thirst;     
    }

    writestatus() {
        document.getElementById("playname").innerHTML ="<b> You play as: '" + jugad1.name + "'</b>,";
        document.getElementById("playpos").innerHTML ="position: <b>" + jugad1.pos +"</b>,";
        document.getElementById("playmoved").innerHTML ="moved status: <b>" + jugad1.moved + "</b>,";
        document.getElementById("play2name").innerHTML ="player 2: '" + jugad2.name + "',";
        document.getElementById("play2pos").innerHTML ="position: " + jugad2.pos;
        document.getElementById("play2moved").innerHTML ="moved status: " + jugad2.moved + ",";
    }

    updategroceries() {
        document.getElementById("hunger1").style.width = jugad1.hunger*10 + "%";
        document.getElementById("waterl").style.width = jugad1.thirst*10 + "%";
    }
    
    finishturn() {
        this.end();
        turn.saveplaypos();
        //availableturn = false;
        document.getElementById("nextturnbut").style.visibility = "visible";
        document.getElementById("mambon5").innerHTML = "turn ended";
    }
    
    checkturn() {
        if(jugad1.moved) {
           turn.refresh(12);
        }   
    }
     
    refresh(sec=12) {
          document.getElementById("user").value = jugad1.name;
          setTimeout(function(){ document.getElementById("refresh").submit(); }, sec*1000);
    }
    
}



