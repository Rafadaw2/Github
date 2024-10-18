let libros = [
    { id: 1, titulo: "El Hobbit", autor: "J.R.R. Tolkien", año: 1937 },
    { id: 2, titulo: "1984", autor: "George Orwell", año: 1949 },
    { id: 3, titulo: "Cien años de soledad", autor: "Gabriel García Márquez", año: 1967 },
    { id: 4, titulo: "Cien años de soledad", autor: "Gabriel García Márquez", año: 1967 },
    // ... más libros
];

let usuarios = [
    { id_usuario: 1, nombre: "Alice", libros_prestados: [1, 2] },
    { id_usuario: 2, nombre: "Bob", libros_prestados: [2, 3] },
    { id_usuario: 3, nombre: "Carol", libros_prestados: [1, 3] },
    // ... más usuarios
];

let historialPrestamos = [
    { id_usuario: 1, id_libro: 1, fecha: "2021-06-12" },
    { id_usuario: 2, id_libro: 2, fecha: "2021-06-15" },
    { id_usuario: 3, id_libro: 3, fecha: "2021-06-17" },
    { id_usuario: 1, id_libro: 2, fecha: "2021-07-01" },
    // ... más registros de préstamos
];
//Implementa una función para listar todos los libros que no están prestados actualmente.
function buscarLibrosDisponibles() {
    let librosNoPrestados = [];
    for (let libro of libros) {
        let libroBuscado = libro.id;
        let contador = 0;

        for (let usuario of usuarios) {

            if (usuario["libros_prestados"].includes(libroBuscado) == false) {
                contador++;
            };
        }
        if (contador == usuarios.length) {
            librosNoPrestados.push(libro.titulo);

        }


    }
    console.log("Los libros disponibles son:")
    console.log(librosNoPrestados);
}

//Implementa una función que, dado un id_usuario, muestre todos los libros que tiene prestados.
function buscarInfoUser() {
    usuarioSolicitado = prompt("Introduce el id del usuario del que deseas información");
    let librosPrestados;
    for(let usuario of usuarios){
        if(usuario["id_usuario"]== usuarioSolicitado){
            console.log("El usuario "+usuario["nombre"]+" tiene actualmente:")
            for(let libro of libros){
                if(usuario["libros_prestados"].includes(libro["id"])){
                    
                    console.log(libro);
                }
            }
        }
    }
}

//Implementa una función que, dado un id_libro, encuentre todos los usuarios que lo han prestado.

function buscarInfoLIbro(){
    libroSolicitado=prompt("Introduce el id del libro buscado");
    for(let libro of libros){
        if(libro["id"]==libroSolicitado){
            console.log("El libro "+libro["titulo"]+" ha sido prestado por:")
            for(let usuario of usuarios){
                if(usuario["libros_prestados"].includes(libro["id"])==true){
                    console.log(usuario["nombre"]);
                }
            }
        }
    }
}

//Implementa una función que calcule para cada libro el número total de veces que ha sido prestado.

function mostrarResumenPrestamos(){
    for(let libro of libros){
        let prestamos=0;
        for(let prestamo of historialPrestamos){
            if(libro["id"]==prestamo["id_libro"]){
                prestamos++;
            }
        }
        console.log("El libro "+libro["titulo"]+" ha sido prestado : "+prestamos+" veces.")
    }
}