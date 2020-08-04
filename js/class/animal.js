/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* the html variables is the html code of the animal in particular. It contains its layout.  */
class animal extends object { 
     constructor(pos, select, name, id, visible, thirst,hunger,dead, html, moved=false) {
      super(     pos, select, html, id, visible);
      this._name = name;
      this._thirst = thirst;
      this._hunger = hunger;
      this._dead = dead;
      this._moved = moved;
      this._deathreason = "alive";
  }
    

    get name() {
      return this._name;
    }
    get thirst() {
      return this._thirst;
    }
    get hunger() {
      return this._hunger;
    }
    get dead() {
      return this._dead;
    }
    get moved() {
      return this._moved;
    }
    get deathreason() {
        return this._deathreason;
    }


    set name(ep) {
      this._name = ep;
    }
    set thirst(ep) {
      this._thirst = ep;
    }
    set hunger(ep) {
      this._hunger = ep;
    }
    set dead(ep) {
      this._dead = ep;
  }
    set moved(ep) {
      this._moved = ep;
    }
    set deathreason(ep) {
        this._deathreason = ep;
    }
    
    drink() {
        this._thirst = 10;
    }
    
    eat() {
        this._hunger = 10;
    }
    
    die(reason) {
        this._dead = true;
        this._deathreason = reason;
    }
   
    
    move(newpos) {
        newtile = document.getElementById(newpos);
        prevtile = document.getElementById(this._pos);
        
        newtile.innerHTML = html;
        prevtile.innerHTML = "";
        
        this._pos = newpos;       
    }
    
    famish(starve=0.2, dehydrate=1) {
        this._thirst -= dehydrate;
        this._hunger -= starve;
        
        this.amIdead();
    }
    
    amIdead() {
     if(this._hunger <=0) {
            this._dead = true;
            this._deathreason = "hunger";
        } else if(this._thirst <= 0) {
            this._dead = true;
            this._deathreason = "thirst";
        }
    }
    reportdeath(id) {
        if(hunger <= 0) document.getElementById(id).innerHTML = " You DIeD out of hunger! ";
        else if(thirst <=0) document.getElementById(id).innerHTML = " You DIeD out of thirst! ";
        else document.getElementById(id).innerHTML = " Error: in fn reportdeath(): player not dead!  ";
    }
    
    writestatus(id, tile) {
      document.getElementById(id).innerHTML ="posh1: "+ this._pos + ", x.id: " + tile.id + ", valid move:" + validmove(this._pos, tile.id);
    }

}

