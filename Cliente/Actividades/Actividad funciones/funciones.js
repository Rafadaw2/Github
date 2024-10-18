function calcularPromedio1() {
    
    let sumatorio=0;
    let promedio=0;
    for( let i=0; i<arguments.length;i++){
        sumatorio+=arguments[i];
   
        promedio=sumatorio/arguments.length;
    }
        return console.log(promedio);
    }
    calcularPromedio1();

function calcularPromedio2(...numeros){
    let sumatorio;
    for( let numero of numeros){
        sumatorio+=numero;
    }
    if(numeros==undefined){
        return console.log(0);
    }else{
        let promedio=sumatorio/numeros.length;
        return console.log(promedio);
    }
}
/*
function crearMensaje(nombre, saludo="Hola",...palabras){
    return saludo+" "+nombre+palabras.join(" ");
}

function imprimirObjeto(objeto){
    for(ob of objeto) {
        console.log(ob);
    }
}
function crearPersona(nombre, edad){
    let persona={
        nombre:nombre,
        edad: edad
    };
    return persona;
}
imprimirObjeto(crearPersona());

function calculadora(operacion, ...numeros){
    let resultado;
    if(operacion==sumar){
        for(num of numeros){
            resultado+=num;
        }
    }else if(operacion==restar){
        for(num of numero){
            resultado-=num;
        }
    }else if(operacion==multiplicar){
        for(num of numeros){
            resultado*=num;
        }
    }else if(operacion==dividir){
        for(num of numeros){
            resultado/=num;
        }
    }else{
        return console.log("La operacion introducida debe ser: sumar, restar, multiplicar o dividir");
    }
    return resultado;
}*/