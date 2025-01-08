// Carrito inicial
let carrito = [];
let posicion = 0;

// Función para añadir un producto al carrito
function agregarAlCarrito(producto, idboton) {
  let productoPasado = producto;

  carrito.push(productoPasado);

  let boton = document.getElementById(idboton);
  boton.disabled = true;

  actualizarCarrito();

}

// Función para actualizar la interfaz del carrito
function actualizarCarrito() {
  // Actualizar el contador del carrito
  const contador = document.getElementById('cart-count');
  contador.innerText = carrito.length;
}

function addElementoDiv(producto) {
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
  contenido += '    <button class="btn btn-primary" id="' + posicion + '">Comprar</button>';
  contenido += '  </div>';
  contenido += '</div>';

  // Insertar el contenido generado al contenedor
  productosContainer.innerHTML += contenido;
  posicion++;


}
function mostrarProductos() {
  //Añade cada producto a la web
  for (let producto of inventario) {
    addElementoDiv(producto);
  }
  posicion = 0;
  for (let producto of inventario) {
    let boton = document.getElementById(posicion);
    console.log("antesvento" + posicion);
    /*La función flecha al tomar el valor de la variable, tomará la más global
    por tanto si le pongo posición tomara la posicion global que siempre es cero */
    let a = posicion;
    let item = producto;
    boton.addEventListener("click", () => { agregarAlCarrito(item, a) });
    console.log(item);
    posicion++;


  }
  posicion = 0;
  const btnCarrito = document.getElementById("cart-button");
  btnCarrito.onclick = mostrarCarrito;
}
//Mostramos los productos
mostrarProductos();

function mostrarCarrito() {
  console.log("Entra en mostrarCarrito");
  const tabla = document.createElement("table");
  let contenido = "";
  contenido = "<tr>" +
    "<th>Producto</th>" +
    "<th>Precio sin IVA</th>" +
    "<th>Precio IVA incluido</th>" +
    "</tr>";
  tabla.innerHTML = contenido;
  let totalCarrito = 0;
  for (let product of carrito) {
    let fila = document.createElement("tr");

    let nombre = document.createElement("td");
    nombre.innerText = product['descripcion'];
    fila.append(nombre);
    let precio = document.createElement("td");
    precio.innerText = calcularPrecio(product).toFixed(2) + ' €';
    fila.append(precio);
    let precioIVA = document.createElement("td");
    precioIVA.innerText = (calcularPrecio(product) * 1.21).toFixed(2) + ' €';
    fila.append(precioIVA);
    totalCarrito += calcularPrecio(product) * 1.21;

    tabla.append(fila);
  }
  let divProductos = document.getElementById('productos');
  divProductos.innerHTML = "";
  divProductos.append(tabla);
  console.log("Total carro:" + totalCarrito);

  divProductos.innerHTML += " <h3>Total: " + totalCarrito.toFixed(2) + "</h3>" +
    "<button id='finalizarCompra' onclick='finalizarCompra()'>Finalizar compra</button>";


}
function calcularPrecio(p) {
  if (p['descuento'] == 'black friday') {
    return p['precio'] * 0.75;
  } else if (p['descuento'] == 'normal') {
    return p['precio'] * 0.93;
  } else {
    return p['precio'];
  }
}
function finalizarCompra() {
  console.log("COmpra finalizada");

  for(let i=inventario.length-1;i>=0;i--){
    for(let pComprado of carrito){
      if(inventario[i]==pComprado){
        inventario.splice(i,1);
      }
    }
  }
  carrito=[];
  actualizarCarrito();
  alert("Gracias por tu compra");
  let productosContainer = document.getElementById('productos');
  productosContainer.innerHTML="";
  mostrarProductos();

}

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
