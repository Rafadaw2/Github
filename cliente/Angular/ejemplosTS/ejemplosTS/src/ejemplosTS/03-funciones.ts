/*
Se permiten funciones al estilo javascript
Pero si tenemos parametros de entrada necesitan tipo sino me da eror
*/

// no esta permitido definirla asi
// function f1(a){
//     return a*2;
// }

//debemos ponerle un tipo el tipo de retorno lo coge automáticamente
// function f1(a:number){
//     return a*2;
// }
// console.log("Función un una valor",f1(2));

//Es mejor definir que tipo devuelve para que no haya problemas

// function f2(a:number){
//     return {cuadrado:a*a, cubo:a*a*a};
// }
// console.log("Devuelve un objeto sin tipo")
// console.table(f2(2));

//Queda mejor explicada
// interface Calculo1{
//     cuadrado:number;
//     cubo:number;
// }

// function f3(a:number):Calculo1{
//     return {cuadrado:a*a, cubo:a*a*a};
// }
// console.log("Devuelve un objeto usando una interfaz")
// console.table(f3(2));

/*
Lo mismo se puede hacer con funciones de flecha
*/
// const f4=(a:number):Calculo1=>{
//     return {cuadrado:a**2,cubo:a**3}
// }

// console.log("Usando una interfaz para retornar un elemento",f4(3))

/*
Funciones con parámetros opcionales
Podemos colocar parámetros opciones junto con parámetros obligatorios.
Para declara un parámetro opcional hay que añadir una ?  
*/

// function f5(obligatorio:number,opcional?:number,valorPorDefecto:number=2):number{
//     if(opcional!=null)
//         console.log("valor opcional",opcional)

//     return obligatorio*valorPorDefecto
// }

// //Con un solo valor
// console.log("función con valor por defecto con un parámetro",f5(3));

// //Con dos valores 
// console.log("función con valor por defecto con dos parámetros",f5(3,5));

// //Con tres valores 
// console.log("función con valor por defecto con tres parámetros",f5(3,5,7));
