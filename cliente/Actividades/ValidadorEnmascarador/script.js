

let div= document.getElementById("div");
let lista1= document.createElement("ul");
let lista2= document.createElement("ul");
div.appendChild(lista1);
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
        
            let elementoli= document.createElement("li");
            elementoli.innerText=email;
            elementoli.style.display="none";
            console.log(email);
            listaInvalidos.appendChild(elementoli);
        }
    }else{
        //listaInvalidos.style.display="none";
        let elementoli= document.createElement("li");
        elementoli.innerText=email;
        //elementoli.style.display="none";
        console.log(email);
        listaInvalidos.appendChild(elementoli);
    }
}
function mostrarInvalidos(){
    listaInvalidos.style.display="block";
}