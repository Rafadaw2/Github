/*
No es recomendable pasar muchos parámetros a una función se convierte en inmanejable
Podemos usar un parámetro que sea un array o un objeto
*/

//Esto no funciona porque aunque le paso un object no sabe definir si contiene el atributo vida o no
// let person:object={
//     nombre:"Gazkull",
//     raza:"Orko",
//     vida:70,
//     fuerza:80,
// }

// function aumentarVida(personaje:object,vidaExtra:number){
//     personaje['vida']+=vidaExtra
// }

// aumentarVida(person,3)

// console.log("Vida después de llamar a la función",person['vida'])


/*
La solución a esto es implementar una interfaz
*/

// interface Personaje{
//     nombre:string;
//     raza:string;
//     vida:number;
//     fuerza:number;
//     //vamos a definir un metodo
//     puntosVida:()=>void

// }

// let person:Personaje={
//     nombre: "Gazkull",
//     raza: "Orko",
//     vida: 70,
//     fuerza: 80,
//     puntosVida: function (): void {
//         console.log(`${this.nombre} ${this.vida}`)
//     }
// }

// function aumentarVida(personaje:Personaje,vidaExtra:number){
//     personaje['vida']+=vidaExtra
// }

// aumentarVida(person,10);

// console.log("Vida después de la función")
// person.puntosVida()


/*
Podemos crear interfaces compuesta para mejorar la legibilidad
*/

// interface Direccion{
//     calle:string;
//     numero:number;
//     portal:number;
//     codPostal:number;
// }

// interface Persona{
//     nombre:string;
//     apellido:string;
//     casa: Direccion;
// }

// let persona1:Persona={
//     nombre: "juan",
//     apellido: "gris",
//     casa: {
//         calle: "San benito bercigüellez",
//         numero: 3,
//         portal:3,
//         codPostal:88888
//     }
// }

// console.table(persona1);