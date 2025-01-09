function comprar(){
let entradas_vip = 10, entradas_preferencial = 0, entradas_general = 10;
let precio_vip = 100, precio_preferencial = 70, precio_general = 40;

let entrada_solicitada = prompt("Selecciona un tipo de entrada entre: vip, preferencial,general");
let colectivo = prompt("Indica si perteneces o no a algun tipo de colectivo: estudiante, club de fans");
let edad = prompt("Indica tu edad en numeros");

entrada_solicitada.toLowerCase();
colectivo.toLowerCase();
let precio;


if (entrada_solicitada == "vip" && entradas_vip == 0) {
    alert("No quedan entradas VIP");
} else if (entrada_solicitada == "vip" && entradas_vip > 0 && colectivo == "si" && edad < 18) {
    entradas_vip = entradas_vip - 1;
    precio = precio_vip * 0.7;

} else if (entrada_solicitada == "vip" && entradas_vip > 0 && colectivo == "si" && edad > 18) {
    entradas_vip = entradas_vip - 1;
    precio = precio_vip * 0.8;

} else if (entrada_solicitada == "vip" && entradas_vip > 0 && colectivo == "no" && edad > 18) {
    entradas_vip = entradas_vip - 1;
    precio = precio_vip;

} else if (entrada_solicitada == "vip" && entradas_vip > 0 && colectivo == "no" && edad < 18) {
    entradas_vip = entradas_vip - 1;
    precio = precio_vip * 0.9;

} else if (entrada_solicitada == "preferencial" && entradas_preferencial == 0) {
    alert("No quedan entradas preferencial");

} else if (entrada_solicitada == "preferencial" && entradas_preferencial > 0 && colectivo == "si" && edad < 18) {
    entradas_preferencial = entradas_preferencial - 1;
    precio = precio_preferencial * 0.7;

} else if (entrada_solicitada == "preferencial" && entradas_preferencial > 0 && colectivo == "si" && edad > 18) {
    entradas_preferencial = entradas_preferencial - 1;
    precio = precio_preferencial * 0.8;

} else if (entrada_solicitada == "preferencial" && entradas_preferencial > 0 && colectivo == "no" && edad > 18) {
    entradas_preferencial = entradas_preferencial - 1;
    precio = precio_preferencial;

} else if (entrada_solicitada == "preferencial" && entradas_preferencial > 0 && colectivo == "no" && edad < 18) {
    entradas_preferencial = entradas_preferencial - 1;
    precio = precio_preferencial * 0.9;

} else if (entrada_solicitada == "general" && entradas_general == 0) {
    alert("No quedan entradas general");

} else if (entrada_solicitada == "general" && entradas_general > 0 && colectivo == "si" && edad < 18) {
    entradas_general = entradas_general - 1;
    precio = precio_vip * 0.7;

} else if (entrada_solicitada == "vip" && entradas_general > 0 && colectivo == "si" && edad > 18) {
    entradas_general = entradas_general - 1;
    precio = precio_general * 0.8;

} else if (entrada_solicitada == "vip" && entradas_general > 0 && colectivo == "no" && edad > 18) {
    entradas_general = entradas_general - 1;
    precio = precio_general;

} else if (entrada_solicitada == "vip" && entradas_general > 0 && colectivo == "no" && edad < 18) {
    entradas_general = entradas_general - 1;
    precio = precio_general * 0.9;
}

console.log(precio);
/*Si la entrada es vip, hay entradas */
}