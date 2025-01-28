/* podemos declarar variables sin tipo
En el momento de asignar la variable coge el tipo
*/
// let nombre="Jose";

/*
Si intentamos asignar otro tipo nos da un error.
Type 'number' is not assignable to type 'string'
Esa variable ya tiene un tipo para todo el programa 
*/
//no deja
//nombre=123;
//si deja
// nombre='123';

// console.log(nombre)

/* 
Para mayor legibilidad es mejor asignar un tipo
De esta forma siempre que pongamos el cursor encima
Nos mostrara el tipo
*/

// let nombre2:string="Jose2";
// console.log(nombre2);

/*
Una variable puede admitir dos tipos distintos.
Esto permite un poco la flexibilidad de javascript y 
ser mas estrictos. 
*/

// let nombre3: string | number ='juan';
// nombre3=9999;
// console.log(nombre3);

/* 
Podemos decir que una elemento sea de un tipo
o permitir un solo valor de otro tipo.
Por ejemplo una función que devuelve un entero si encuentra el valor
y un 'error' si ha tenido algún tipo de error
*/

// let var1: number| 'ERROR'=3;
// var1=5;
// var1='ERROR';
// console.log(var1);