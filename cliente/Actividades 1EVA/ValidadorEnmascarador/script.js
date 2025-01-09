

let div= document.getElementById("div");
let lista1= document.createElement("ul");
let lista2= document.createElement("ul");
let h2=document.createElement("h2");
h2.style.display="none";
h2.innerText="Lista Invalidos";
div.appendChild(lista1);
div.appendChild(h2);
div.appendChild(lista2);
let listas=document.querySelectorAll("ul");
let listaValidos=listas[0];
let listaInvalidos=listas[1];



function validarEmail() {
    let email=document.getElementById("1").value;

    if(email.includes("@")==true){
        let emailDividido=email.split("@");
        if(emailDividido[1].includes(".")==true){
            
            let elemento=document.createElement("li");
            let subcadena = emailDividido[0].substring(1,emailDividido[0].length);
            emailDividido[0]=emailDividido[0].replace(subcadena,"***");
            elemento.innerText=emailDividido.join('@');
            listaValidos.appendChild(elemento);

        }else{
            listaInvalidos.style.display="none";
            let elementoli= document.createElement("li");
            elementoli.innerText=email;
            console.log(email);
            listaInvalidos.appendChild(elementoli);
        }
    }else{
        listaInvalidos.style.display="none";
        let elementoli= document.createElement("li");
        elementoli.innerText=email;
        console.log(email);
        listaInvalidos.appendChild(elementoli);
    }
}
function mostrarInvalidos(){
    /*Nota si para faiclitar la lectura intentas parar el display por una variable:
    let display=lista.Invalidos.style.display;
    y luego intentas modificar display asignandole none o block NO ES VALIDO*/
    if(listaInvalidos.style.display=="block"){
        listaInvalidos.style.display="none";
        h2.style.display="none";
    }else{
        listaInvalidos.style.display="block";
        h2.style.display="block";
    }
}