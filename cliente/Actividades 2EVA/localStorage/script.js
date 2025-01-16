const tabla = document.querySelector('table');
function guardar(){
    
    let jugadores = document.getElementsByTagName('tr');

    for(let jugador of jugadores){
        
        for(let campo of jugador.getElementsByTagName('td')){
            let input = campo.querySelector('input');
            let clave = input.id;
            let valor=input.value;

            localStorage.setItem(clave,valor);
            console.log(clave);
            console.log(valor);
            
        }
    }
}
function recuperar(){
    let jugadores = document.getElementsByTagName('tr');

    for(let jugador of jugadores){
        
        for(let campo of jugador.getElementsByTagName('td')){
            let input = campo.querySelector('input');
            input.value=localStorage.getItem(input.id);
            
        }
    }
}
function vaciar(){
    localStorage.clear();
}