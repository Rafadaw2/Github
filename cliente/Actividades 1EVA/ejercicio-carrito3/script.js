// Carrito inicial
let carrito = [];
let posicion = 0;


function añadirStock(stock) {
  for (let product of inventarioPersistente) {
    product['stock'] = Number(stock);
  }
}

//Función que crea un id para cada producto
function añadirIdentificador() {
  for (let product in inventarioPersistente) {
    inventarioPersistente[product]['identificador'] = product;
  }
}
añadirStock(10);
añadirIdentificador();
/*
Si lo haces asi:
let inventario=inventarioPersistente;
los cambios de inventario se harán en inventarioPersistnete porque
esta apuntando a la misma posicion de memoria.
Debes clonar el array asi:*/
let inventario=JSON.parse(JSON.stringify(inventarioPersistente));

function barraSeleccion(){

}

// Función para añadir un producto al carrito
function agregarAlCarrito(producto, idboton) {
  let productoPasado = producto;

  carrito.push(productoPasado);
  inventario[idboton]['stock']--;
  console.log(idboton);


  actualizarCarrito();

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

function insertarBarraFiltrado(){
  
  let contenido='';
  contenido+='<div class="col">';
  contenido+='  <label for="opciones">Elementos por página:</label>';
  contenido+='  <select name="opciones" id="numelementos">';
  contenido+='    <option value="3">3</option>';
  contenido+='    <option value="5">5</option>';
  contenido+='    <option value="10">10</option>';
  contenido+='    <option value="todos" selected>todos</option>';
  contenido+='  </select>';
  contenido+='</div>';
  contenido+='<div class="col">';
  contenido+='  <label for="opciones">Ordenar por:</label>';
  contenido+='  <select name="opciones" id="orden">';
  contenido+='    <option value="" selected>Selecciona una opción</option>';
  contenido+='    <option value="">Precio descendente</option>';
  contenido+='    <option value="">Precio ascendente</option>';
  contenido+='    <option value="">Descuento</option>';
  contenido+='  </select>';
  contenido+='</div>';
  contenido+='<button class=" btn btn-secondary w-25" id="ordenar">Ordenar</button>';

  const contenedor= document.getElementById('select');
  contenedor.innerHTML=contenido;

  const botonOrdenar=document.getElementById('ordenar');
  botonOrdenar.addEventListener('click',ordenar);

}

insertarBarraFiltrado();

function mostrarProductos(elementos, orden) {
  if(elementos=='3'){

  }
  let productosContainer = document.getElementById('productos');
  productosContainer.innerHTML = "";
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
    if(inventario[a]['stock']<=0){
      let boton = document.getElementById(a);
      boton.disabled = true;
    }
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

  for (let i = inventarioPersistente.length - 1; i >= 0; i--) {
    for (let pComprado of carrito) {
      if (inventarioPersistente[i]['identificador'] == pComprado['identificador']) {
          inventarioPersistente[i]['stock']--;
      }
    }
  }
  inventario=JSON.parse(JSON.stringify(inventarioPersistente));
  carrito = [];
  actualizarCarrito();
  alert("Gracias por tu compra");
  mostrarProductos();

}

function insertarBotones(elementos){
  let fracciones=elementos;
  let numeroBotones=inventario.length/fracciones;
  const contenedor=document.getElementsByClassName('container my-4');
  let botonRetroceder=document.createElement('button');
  botonRetroceder.innerText='<';
  contenedor.append(botonRetroceder);
  let numPagina=1;

  for(let i=0;i<numeroBotones;i++){
    let boton=document.createElement('button');
    boton.innerText=numPagina;
    boton.addEventListener('click', ()=>cambiarPagina(fracciones));
    numPagina++;
    const divProductos = document.getElementById('productos');
    divProductos.append(boton);
  }

  let botonAvanzar=document.createElement('button');
  botonRetroceder.innerText='>';
  contenedor.append(botonAvanzar);
}

function insertarBarraAvance(){
  const select=document.getElementById('numelementos');
  let elementosSeleccionados = select.value;
 
}
function cambiarPagina(indice){

}

function ordenar(){
 alert("Ordenado");
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
