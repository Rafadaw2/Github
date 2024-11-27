let colores=["red","blue","yellow","pink","white","black","green"];
let boton=document.querySelector("button");
boton.addEventListener("click",crear);
let body=document.querySelector("body");

function crear(){
    let numero= document.querySelector("input");
    numero.remove();
    boton.remove();

    for(let i=0;i<4;i++){
        let btn= document.createElement("button");
        body.appendChild(btn);

    }
    let botones=document.querySelectorAll("button");
    botones[0].innerText="Poner color";
    botones[1].innerText="Poner color aleatorio";
    botones[2].innerText="Todos gris";
    botones[3].innerText="Carrusel";
    let inputN=document.createElement("input");
    inputN.type="number";
    body.appendChild(inputN);

    let inputT=document.createElement("input");
    inputN.type="text";
    body.appendChild(inputT);

    for(let i=0;i<Number(numero.value);i++){
        let div= document.createElement("div");
        div.style.width="100px";
        div.style.height="100px";
        div.style.backgroundColor="grey";
        div.style.border="border-solid 3px";
        div.onmouseover=()=>{div.style.backgroundColor="black"};
        div.onmouseout=()=>{div.style.backgroundColor="grey"};
        body.appendChild(div);

    }
    
}
