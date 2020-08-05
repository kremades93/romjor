//               pos, select, name, id, visible, thirst,hunger,dead, html, moved=false

class person extends animal {
     constructor(pos, select, html, id, visible, thirst,hunger,dead, name, moved=false, cara=":S", carahtml) {
      super(     pos, select, html, id, visible, thirst,hunger,dead, name, moved);
      this._cara = cara;
      this._carahtml = carahtml;
  }
   
    get cara() {
      return this._cara;
    }
    
    set cara(ep) {
      this._cara = ep;
      document.getElementById(this._carahtml).innerHTML = this._cara;
    }
    
    somriu() {
        this.cara(":)");
    }
    happy() {
        this.cara(":D");
    }

}



