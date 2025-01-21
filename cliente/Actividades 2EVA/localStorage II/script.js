const tabla = document.querySelector('table');
function guardar() {

    let datos = document.getElementsByTagName('td');
    let clave = datos[0].querySelector('input').value;
    let valor = datos[1].querySelector('input').value;
    localStorage.setItem(clave, valor);

}
function borrar(clave){
    let key=clave;
    localStorage.removeItem(key);
    let fila=document.getElementById(clave);
    fila.remove();
}
const body = document.querySelector('body');
let div = document.createElement('div');
div.id='contenedor';
body.append(div);

function mostrar() {
    let th1 = document.createElement('th');
    let th2 = document.createElement('th');
    th1.innerText = 'Clave';
    th2.innerText = 'Valor';
    let tr = document.createElement('tr');
    tr.append(th1);
    tr.append(th2);
    let table = document.createElement('table');
    table.append(tr);

    for (let i = 0; i < localStorage.length; i++) {
        let tr = document.createElement('tr');
        let td1 = document.createElement('td');
        let clave = localStorage.key(i);
        td1.innerText = clave;
        tr.append(td1);
        let td2 = document.createElement('td');
        let valor = localStorage.getItem(clave);
        td2.innerText = valor;
        tr.append(td2);
        tr.id=clave;
        let btn=document.createElement('button');
        btn.innerText="X";
        btn.style.color='red';
        btn.addEventListener('click',()=>borrar(clave));
        tr.append(btn);
        table.append(tr);

    }
    let contenedor=document.getElementById('contenedor');
    contenedor.innerText="";
    contenedor.append(table);
    
}