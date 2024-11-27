
let botones=document.querySelectorAll("input");
botones[0].addEventListener("click",mostrarUsuarios);
let mediasExamen=[];
let mediasPracticas=[];
let mediasTotal=[];

function mostrarUsuarios(){
    let div=document.getElementById("resultado");
    let ul=document.getElementsByTagName("ul");
    if(ul.length>0){
        ul[0].remove();
    }
    let lista=document.createElement("ul");
    
    for(let user of listaUsuarios){
        let elemento=document.createElement("li");
        elemento.innerText="Nombre: "+user.nombre+" / Curso: "+user.curso+" Notas examenes: "+user.notasExamenes+"/ Notas Practicas: "+user.notasPracticas;
        /*let boton=document.createElement("button");
        boton.id=identificador;
        boton.onclick=(event) => borrarUser(event);
        boton.innerText="Borrar";
        elemento.appendChild(boton);*/
        lista.appendChild(elemento);
    }
    div.appendChild(lista);
}

botones[1].addEventListener("click",mostrarAprobadosSuspensos);

function mostrarAprobadosSuspensos(){
    let div=document.getElementById("resultado");
    div.innerHTML="";
    let ul=document.getElementsByTagName("ul");
    if(ul.length>0){
        ul[0].remove();
    }
    let lista=document.createElement("ul");
    
    for(let user of listaUsuarios){
        let elemento=document.createElement("li");
        let notasExa=user.notasExamenes;
        let notasPrac=user.notasPracticas;
        let notaTotal=calculaMediaTotal(notasExa,notasPrac);
        mediasTotal.push(notaTotal);
        let resultado="";
        let span=document.createElement("span");
        if(notaTotal>=5){
            resultado="Aprobado";
            span.innerText=resultado;
            span.style.color="green";
        }else{
            resultado="Suspenso";
            span.innerText=resultado;
            span.style.color="red";
        }
        elemento.innerText="Nombre: "+user.nombre+" / Curso: "+user.curso+" Notas total: "+notaTotal;
        elemento.appendChild(span);
        /*let boton=document.createElement("button");
        boton.id=identificador;
        boton.onclick=(event) => borrarUser(event);
        boton.innerText="Borrar";
        elemento.appendChild(boton);*/
        lista.appendChild(elemento);
    }
    div.appendChild(lista);
}

function calculaMediaTotal(arrayNotasExamenes, arrayNotasPracticas){
    let sumatorioNExa=0;
    let sumatorioNPrac=0;
    let promedioNExa=0;
    let promedioNPrac=0;
    let notaTotal=0;
    for(let nota of arrayNotasExamenes){
        sumatorioNExa+=nota;
    }
    promedioNExa=sumatorioNExa/arrayNotasExamenes.length;
    mediasExamen.push(promedioNExa);
    for(let notaP of arrayNotasPracticas){
        sumatorioNPrac+=notaP;
    }
    promedioNPrac=sumatorioNPrac/10;
    mediasPracticas.push(promedioNPrac);
    notaTotal=promedioNExa*0.6+promedioNPrac*0.4;

    return notaTotal;

}

botones[2].addEventListener("click",mostrarEstadisticas);

function mostrarEstadisticas(){
    let mediaCursoExa=0;
    let sumaExa=0;
    let mediaCursoPrac=0;
    let sumaPrac=0;
    let mediaCursoTotal=0;
    let sumaTot=0;

    for(let nota of mediasExamen){
        sumaExa+=nota;
    }
    mediaCursoExa=sumaExa/mediasExamen.length;
    for(let nota of mediasPracticas){
        sumaPrac+=nota;
    }
    mediaCursoPrac=sumaPrac/mediasPracticas.length;
    mediaCursoTotal=mediaCursoExa*0.6+mediaCursoPrac*0.4;

    let ul=document.createElement("ul");
    let elemento1=document.createElement("li");
    let elemento2=document.createElement("li");
    let elemento3=document.createElement("li");
    elemento1.innerText="Media global examen: "+mediaCursoExa;
    elemento2.innerText="Media global practicas: "+mediaCursoPrac;
    elemento3.innerText="Media global total: "+mediaCursoTotal;
    ul.appendChild(elemento1);
    ul.appendChild(elemento2);
    ul.appendChild(elemento3);
    let div=document.getElementById("resultado");
    div.innerHTML="";
    div.appendChild(ul);
    


}