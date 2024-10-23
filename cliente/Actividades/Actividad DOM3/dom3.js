function crearLista(){
    let saltoLinea=document.createElement("br");
    let uls=document.getElementsByTagName("ul");
    let lista=document.createElement("ul");
    lista.id=uls.length;
    let numeroLista=uls.length+1;
    let botonlista=document.createElement("button");
    botonlista.innerHTML="Añadir a lista "+numeroLista;
    indice=uls.length;
    botonlista.onclick=function(){anadirElementoLista(indice)};
    document.body.append(saltoLinea);
    document.body.append(botonlista);
    document.body.append(lista);
    
}
function anadirElementoLista(posicion){
    let li = document.createElement("li");
    li.innerHTML=prompt("Introduce el texto de la lista");
    let uls=document.getElementsByTagName("ul");
    uls[posicion].append(li);
}

