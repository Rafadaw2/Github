let array_fotos = [
    '<img id="img" src="./img/paisaje1.jpg">',
    '<img id="img" src="./img/paisaje2.jpg">',
    '<img id="img" src="./img/paisaje3.jpg">'

]
function cambiarFotoI() {
    let div = document.querySelectorAll("div")[2];
    let radioButtons = document.getElementsByName("marcador");
    let posicion = array_fotos.indexOf(div.innerHTML);

    nuevoIndice = posicion - 1;
    if (nuevoIndice < 0) {
        div.innerHTML = array_fotos[array_fotos.length - 1];
        radioButtons[array_fotos.length - 1].checked = true;
    } else {
        div.innerHTML = array_fotos[nuevoIndice];
        radioButtons[nuevoIndice].checked = true;
    }




}
function cambiarFotoD() {
    let div = document.querySelectorAll("div")[2];
    let posicion = array_fotos.indexOf(div.innerHTML);
    let radioButtons = document.getElementsByName("marcador");


    nuevoIndice = posicion + 1;
    if (nuevoIndice == array_fotos.length) {
        div.innerHTML = array_fotos[0];
        radioButtons[0].checked = true;
    }else{
    div.innerHTML = array_fotos[nuevoIndice];
    radioButtons[nuevoIndice].checked = true;
    }


}