// Carrito inicial
let carrito = [];
let posicion=0;

// Función para añadir un producto al carrito
function agregarAlCarrito(producto,idboton) {
  console.log("Entra");
  carrito.push(producto);
  let boton=document.getElementById(idboton);
  boton.disabled=true;
  console.log("Antes"+idboton);
  actualizarCarrito();
  console.log(idboton);
}

// Función para actualizar la interfaz del carrito
function actualizarCarrito() {
  // Actualizar el contador del carrito
  const contador = document.getElementById('cart-count');
  contador.innerText = carrito.length;
}

function addElementoDiv(producto){
    // Seleccionar el primer producto del inventario
    //const producto = inventario[1]; // `carrito` proviene del archivo inventario.js
    
    
    const productosContainer = document.getElementById('productos');

    // Usamos boostrap
    let contenido = "";
    contenido += '<div class="row">';
    contenido += '  <div class="col-md-4">';
    contenido += '    <img src="' + producto['url_imagen'] + '" alt="' + producto['descripcion'] + '" class="img-fluid">';
    contenido += '  </div>';
    contenido += '  <div class="col-md-8">';
    contenido += '    <h5>' + producto['descripcion'] + '</h5>';
    contenido += '    <p>Precio: $' + producto['precio'] + '</p>';
    contenido += '    <p>Descuento: ' + producto['descuento'] + '</p>';
    contenido += '    <button class="btn btn-primary" id="'+posicion+'">Comprar</button>';
    contenido += '  </div>';
    contenido += '</div>';

    // Insertar el contenido generado al contenedor
    productosContainer.innerHTML += contenido;
    posicion++;
    
   
}
function mostrarProductos(){
  //Añade cada producto a la web
  for(producto of inventario){
    addElementoDiv(producto);
  }
  let posicion=0;
  for(producto of inventario){
    let boton=document.getElementById(posicion);
    console.log("antesvento"+posicion);
    /*La función flecha al tomar el valor de la variable, tomará la más global
    por tanto si le pongo posición tomara la posicion global que siempre es cero */
    let a=posicion;
    boton.addEventListener("click",()=>{agregarAlCarrito(producto,a)});
    console.log(posicion);
    posicion++;
  

  }
  posicion=0;
}
//Mostramos los productos
mostrarProductos();

// carrito.push(producto);
// actualizarCarrito()
// carrito.push(producto);
// actualizarCarrito()
// carrito.push(producto);
// actualizarCarrito()

/* Función para añadir productos al carrito
function agregarAlCarrito(descripcion) {
  alert("Has añadido al carrito: " + descripcion);

}*/
