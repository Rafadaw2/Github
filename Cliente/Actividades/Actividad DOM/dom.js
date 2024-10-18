function colorear() {
    let elementoLi = document.getElementsByTagName("li");
    for (let elemento in elementoLi) {
        if (elementoLi[elemento].style.length == 0) {
            if (elemento % 2 == 0) {
                elementoLi[elemento].style = "background-color: green";
            } else {
                elementoLi[elemento].style = "background-color: blue";
            }
        }else{
            elementoLi[elemento].style="";
        }
    }
}