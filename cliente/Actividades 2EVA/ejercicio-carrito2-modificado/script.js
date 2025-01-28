// Carrito inicial
let carrito = [];
let posicion = 0;
function añadirStock(stock) {
  for (let product of inventario) {
    product['stock'] = Number(stock);
  }
}
añadirStock(10);
if(localStorage.length>0){
  for(let i=0; i<localStorage.length;i++){
    let clave=localStorage.key(i);
    let valor=localStorage.getItem(clave);
    let producto=JSON.parse(valor);
    carrito.push(producto);
    for(let p of inventario){
      if(p['descripcion']==producto['descripcion']){
        p['stock']=producto['stock'];
      }
    }

  }
  actualizarCarrito();
}


// Función para añadir un producto al carrito
function agregarAlCarrito(producto, idboton) {
  let productoPasado = producto;

  carrito.push(productoPasado);
  inventario[idboton]['stock']--;
  console.log(idboton);


  actualizarCarrito();
  let productosContainer = document.getElementById('productos');
  productosContainer.innerHTML = "";
  mostrarProductos();
  if(inventario[idboton]['stock']==0){
    let boton = document.getElementById(idboton);
    boton.disabled = true;
    boton.style.backgroundColor="red";
    boton.style.opacity=0.3;
  }



}

// Función para actualizar la interfaz del carrito
function actualizarCarrito() {
  // Actualizar el contador del carrito
  const contador = document.getElementById('cart-count');
  contador.innerText = carrito.length;
}

function addElementoDiv() {
  // Seleccionar el primer producto del inventario
  //const producto = inventario[1]; // `carrito` proviene del archivo inventario.js


  const productosContainer = document.getElementById('productos');

  // Usamos boostrap
  let contenido = "";
  contenido += '<div class="row">';
  contenido += '  <div class="col-md-4">';
  contenido += '    <img src="' + inventario[posicion]['url_imagen'] + '" alt="' + inventario[posicion]['descripcion'] + '" class="img-fluid">';
  contenido += '  </div>';
  contenido += '  <div class="col-md-8">';
  contenido += '    <h5>' + inventario[posicion]['descripcion'] + '</h5>';
  contenido += '    <p>Precio: $' + inventario[posicion]['precio'] + '</p>';
  contenido += '    <p>Descuento: ' + inventario[posicion]['descuento'] + '</p>';
  contenido += '    <p>Stock: ' + inventario[posicion]['stock'] + '</p>';
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
    addElementoDiv();
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
    if(inventario[a]['stock']==0){
      let boton = document.getElementById(a);
      boton.disabled = true;
    }
    posicion++;

  }
  posicion = 0;
  const btnCarrito = document.getElementById("cart-button");
  btnCarrito.onclick = mostrarCarrito;
  let btnGuardar=document.createElement('button');
  btnGuardar.innerText='Guardar Carrito';
  btnGuardar.className='btn btn-primary';
  btnGuardar.addEventListener('click',()=>persistir());
  let divBtn=document.querySelector('.btnGuardar');
  divBtn.innerText="";
  divBtn.style.display='inline-block';

  divBtn.append(btnGuardar);
}
//Mostramos los productos
mostrarProductos();
function persistir(){
  for( let producto of carrito){
    localStorage.setItem(producto['descripcion'],JSON.stringify(producto));
  }
}

function mostrarCarrito() {
  console.log("Entra en mostrarCarrito");
  const tabla = document.createElement("table");
  let contenido = "";
  contenido = "<tr>" +
    "<th>Unidades</th>" +
    "<th>Producto</th>" +
    "<th>Precio sin IVA</th>" +
    "<th>Precio IVA incluido</th>" +
    "</tr>";
  tabla.innerHTML = contenido;
  let totalCarrito = 0;
  for (let product of carrito) {
    let id = product['descripcion'];
    let articulo=document.getElementById(id);
    console.log(articulo);
    let fila = document.createElement("tr");

    if(articulo!=null){
      articulo.innerText=Number(articulo.innerText)+1;
      totalCarrito += calcularPrecio(product) * 1.21;
    }else{
      let unidades = document.createElement("td");
      unidades.innerText = 1;
      unidades.id=product['descripcion'];
      fila.append(unidades);

      let nombre = document.createElement("td");
      nombre.innerText = product['descripcion'];
      fila.append(nombre);
  
      let precio = document.createElement("td");
      precio.innerText = calcularPrecio(product).toFixed(2) + ' $';
      fila.append(precio);
  
      let precioIVA = document.createElement("td");
      precioIVA.innerText = (calcularPrecio(product) * 1.21).toFixed(2) + ' $';
      fila.append(precioIVA);
  
      totalCarrito += calcularPrecio(product) * 1.21;
  
      tabla.append(fila);
    }
    

    let divProductos = document.getElementById('productos');
    divProductos.innerHTML = "";
    divProductos.append(tabla);
  }
  console.log("Total carro:" + totalCarrito);
  let divProductos = document.getElementById('productos');
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

  for (let i = inventario.length - 1; i >= 0; i--) {
    for (let pComprado of carrito) {
      if (inventario[i] == pComprado && inventario[i]['stock'] == 0) {
        
      }
    }
  }
  carrito = [];
  localStorage.clear();
  actualizarCarrito();
  alert("Gracias por tu compra");
  let productosContainer = document.getElementById('productos');
  productosContainer.innerHTML = "";
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
