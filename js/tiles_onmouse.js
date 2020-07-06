//<!-- Fa grossa la tile si el mouse passa per sobre -->
function bigImgE(x) {
  if(x.className=="earth") {
    if(validmove(x.id,posh1)) {
        x.style.backgroundColor = "GreenYellow";
    }  else { x.style.backgroundColor = "MediumSeaGreen";}
  } else if(x.className=="water") {
      if(validmove(x.id,posh1)) {
        x.style.backgroundColor = "aqua";
    }  else { x.style.backgroundColor = "LightSkyBlue";}
  } else if(x.className=="mineral") {
      if(validmove(x.id,posh1)) {
        x.style.backgroundColor = "coral";
    }  else { x.style.backgroundColor = "burlywood";}
  }  
}

//<!-- Retorna el style inicial a la tile després dhaverla destacat -->
function normalImgE(x) {
   if(x.className=="earth") {
    x.style.backgroundColor = "lightgreen";
  } else if(x.className=="water") {
      x.style.backgroundColor = "lightblue";
  } else if(x.className=="mineral") {
      x.style.backgroundColor = "pink";
  }  
  
}
