alert("Bienvenido a la calculadora dinamica de Rafa, primero te vamos a pedir dos numeros con los cuales"+
    "vamos a operar y por último el tipo de operación que deseas realizar estan habilitadas sumas, restas,"+
    " multiplicaciones y divisiones.");

let dato1=prompt("Introduce el primer número.");
let dato2=prompt("Introduce el segundo número.");
let operación=prompt("Introduce la operación que deseas realizar.");

if(operación.toLowerCase=="suma"){
    let resultado=dato1+dato2;
    alert("El resultado es: "+resultado);
}else if(operación.toLowerCase=="resta"){
    resultado=dato1-dato2;
    alert("El resultado es: "+resultado);
}else if(operación.toLowerCase=="multiplicacion"){
    resultado=dato1*dato2;
    alert("El resultado es: "+resultado);
}else if(operación.toLowerCase=="division"){
    resultado=dato1/dato2;
    alert("El resultado es: "+resultado);
}else{
    alert("Los datos o la operación selecionada no son validos");
};

