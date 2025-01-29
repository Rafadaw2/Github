/*
En javascript existen las clases pero no se suelen usar
debido a que los objetos son mutables por lo que las clases no aportan demasiado

Pero en typescript si tienen mucho uso
*/


// Clase básica nos dice que hay errores por la variables no están inicializadas
// class Persona {
//     private nombre:string;
//     private apellido:string;
//     constructor(){}
// }

// class Persona {
//     private nombre:string;
//     private apellido:string;
//     constructor(nombre:string,apellido:string){
//         this.nombre=nombre;
//         this.apellido=apellido;
//     }
//     public mostrar(){
//         console.log(`${this.nombre} ${this.apellido}`)
//     }
// }

// const p1=new Persona('juan','gris');
// console.table(p1)

/*
Podemos hacer una declaración corta que consiste en quitar los atributos y declararlos en el constructor
*/

// class Persona2 {
//     constructor(private nombre:string,private apellido:string){
//         this.nombre=nombre;
//         this.apellido=apellido;
//     }
//     public mostrar(){
//         console.log(`${this.nombre} ${this.apellido}`)
//     }
// }

// const p2=new Persona2('juan','gris');
// console.table(p2)

/* 
Permite herencia es decir podemos crear una clase que tenga todos los atributos de otra ademas de los suyos propios
*/

// class Empleado extends Persona {
//     constructor(
//         public cargo:string,
//         public direccion:string,
//         nombre: string,
//         apellido:string
//     ){
//         super(nombre,apellido)
//     }
// }

// const p3=new Empleado("CISO","calle 2","juan","james");
// console.table(p3);