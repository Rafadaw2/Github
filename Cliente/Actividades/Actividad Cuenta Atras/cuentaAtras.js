function cuentaAtras() {
    let min, seg;
    min = 3;
    seg = 0;
    let cuenta = document.getElementsByTagName("h1");
    let body = document.getElementsByTagName("body");
    body.style = "background-color= grey color: white";


    cuenta.innerText = setInterval(() => {
        if (seg == 0) {
            min--;
            seg = 59;
        }
        return console.log(min + ":" + seg--)
    }, 1000);
    let tiempo = [min, seg];
    return tiempo;

}

if (cuentaAtras()[0] == 0 && cuentaAtras()[1] == 0) {
    let body = document.getElementsByTagName("body");
    body.style = "background-color= pink ";
}