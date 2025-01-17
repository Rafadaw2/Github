function cuentaAtras() {
    let min, seg;
    min = 3;
    seg = 0;
    /*Es importante tener en cuenta que al usar tagname
    te devuelve un array aunque solo haya un elemento*/
    let cuenta = document.getElementsByTagName("h1")[0];
    let body = document.getElementsByTagName("body")[0];
    body.style.backgroundColor = "gray";
    body.style.color = "white";


    cronometro=setInterval(() => {
        if (seg < 0) {
            min--;
            seg = 59;
        }
        if (seg < 10) {
            cuenta.innerText = min + ":" + "0" + seg--;
        } else {
            cuenta.innerText = min + ":" + seg--;
        }
        if (min == 0 && seg < 0) {
            clearInterval(cronometro);
            body.style.backgroundColor = "pink";
            div = document.getElementById("gif");
            /*innerHTML reemplaza lo que hay anidado por debajo del
            elemento en el que has apuntado*/
            div.innerHTML = "<img src='./img/emergencia.gif'></img>";
            let audio = document.getElementById("audio");

            audio.play();
        }


    }, 1000);



}

