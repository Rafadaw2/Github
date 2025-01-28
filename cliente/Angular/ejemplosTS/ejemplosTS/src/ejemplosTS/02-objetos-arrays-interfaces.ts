/*
Podemos declarar arrays de un solo tipo
con :tipo[]
*/

// let ejeArray1:string[]=['uno','dos','tres']
/*
Dara un error si intentamos asignar otro valor
Argument of type 'number' is not assignable to parameter of type 'string'.
*/
//ejeArray1.push(1234);

//Si asignamos una cadena no hay problemas
// ejeArray1.push('1234');
// console.log('array de cadenas',ejeArray1);

/*
Es muy común usar un array como un objeto donde guardar distintos
tipos.
Por ejemplo una persona que vamos a guardar
Nombre, edad, y si esta casado o soltero
*/ 

/*
para que se valido este tipo debemos 
El lo convierte en let persona1: (string | number | boolean)[]
*/
// let persona1=['juan',23,true];
// console.log('Array con distintos tipos',{
//     nombre:persona1[0],
//     edad:persona1[1],
//     soltero:persona1[2]
// })

//Nos permite insertar en el array cualquiera de los tipos.
// persona1.push("juan");
// persona1.push(false);
// persona1.push(123);
// console.log('Array con distintos tipos 2',persona1)

/*
Si queremos tener varias personas lo seria mas fácil usar un objeto
pero tenemos un problema typescript no nos permite tipar los objetos
*/

// no da ningun tipo de error pero no podemos ver el tipo en la declaración
// let persona2={
//     nombre: "juan",
//     edad:22,
//     soltero:true
// }

// console.log(persona2);
/* mal
let persona2={
    nombre:string: "juan",
    edad:number:22,
    soltero:boolean:true
}
*/


/*
Podemos usar las interfaces es una pseudo clase que permite definir objetos
Esto es muy util por que de esta forma podemos definir elementos complejos
En javascript no queda rastro de esto, porque no existen interfaces en js
*/

// interface Persona{
//     nombre:string;
//     edad:number;
//     soltero:boolean;
// }

// let listaPersonas:Persona[]=[
//     {
//         nombre:"juan",
//         edad:22,
//         soltero:false
//     },
//     {
//         nombre:"pedro",
//         edad:33,
//         soltero:true
//     }
// ]

// console.log('Uso de interfaces',listaPersonas)


//Si ponemos el cursos encima y damos a ctrl+. o comand+. nos añade las propiedades
// const persona3:Persona={
    
// }

/*
Podemos declara una interfaz pero a los mejor no todos lo campos son obligatorios
Por ejemplo podemos definir un interfaz empleado donde ciertos campos son obligatorios
pero algunos opciones para ello se pone ? en el campo opcional
*/

// interface Empleado{
//     nombre:string;
//     edad:number;
//     soltero:boolean;
//     direccion?:string;
//     correoPersonal?:string;
// }

// let listaEmpleados:Empleado[]=[
//     {
//         nombre:'juan',
//         edad:23,
//         soltero:true,
//     },
//     {
//         nombre:'pedro',
//         edad:65,
//         soltero:false,
//         direccion:"Calle san benito vercigüelles 23",
//         correoPersonal:'555-55555', 
//     }
// ]

// console.log('Lista empleados con atributos opcionales');
// console.table(listaEmpleados);

//Otra ventaja es que nos permite autocompletar simplemente escribiendo el objeto. y nos sale la lista de elementos
//listaEmpleados[0].