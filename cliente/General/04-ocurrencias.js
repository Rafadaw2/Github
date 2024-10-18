// Seleccionar siguientes ocurrencias de una palabra Teclas rápidas: 
// Windows/Linux: Ctrl + D
// Mac: Cmd + D
// Selecciona resultado dentro de la función solo calcularArea y renombrala por areaParcial
// 
// 
// Seleccionar todas las ocurrencias de una palabra teclas rápidas:
// Windows/Linux: Ctrl + Shift + L o Ctrl + F2
// Mac: Cmd + Shift + L o Cmd + F2
// Selecciona calcularArea todas y cambialas por obtenerArea


// Código original
function calcularArea(base, altura) {
    let resultado = base * altura;
    return resultado;
}

let areaRectangulo = calcularArea(5, 10);
console.log("El área del rectángulo es: " + areaRectangulo);

let areaTriangulo = calcularArea(5, 10) / 2;
console.log("El área del triángulo es: " + areaTriangulo);


// Código modificado
function obtenerArea(base, altura) {
    let areaParcial = base * altura;
    return areaParcial;
}

let areaRectangulo = obtenerArea(5, 10);
console.log("El área del rectángulo es: " + areaRectangulo);

let areaTriangulo = obtenerArea(5, 10) / 2;
console.log("El área del triángulo es: " + areaTriangulo);
