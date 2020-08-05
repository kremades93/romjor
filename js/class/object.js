class object {
    constructor(pos,selected, html, id, visible) {
      this._pos = pos;
      this._selected = selected;
      this._html = html;
      this._visible = visible;
      this._id = id;
    }
    
    get pos() {
      return this._pos;
    }
    get selected() {
      return this._selected;
    }
    get visible() {
        return this._visible;
    }
    get html() {
        return this._html;
    }
    get id() {
        return this._id;
    }

    set pos(ep) {
      this._pos = ep;
    }
    set selected(ep) {
      this._selected = ep;
    }
    set visible(ep) {
        this._visible = ep;
    }
    set html(ep) {
        this._html = ep;
    }
    set id(ep) {
        this._id = ep;
    }
    
    select() {
        this._selected = true;
    }
    
    deselect() {
        this._selected = false;
    }
    
    hide() {
        this._visible=false;
        document.getElementById(this._id).style.visibility = "hidden";
    }
    
    show() {
        this._visible=true;
        document.getElementById(this._id).style.visibility = "visible";

    }
    
    place(pos) {
        document.getElementById(this._pos).innerHTML = "";
        document.getElementById(pos).innerHTML = this._html;
        this._pos=pos;
    }
}

