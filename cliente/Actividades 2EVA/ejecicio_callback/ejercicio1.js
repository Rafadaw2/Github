function servidorEventos(callback) {
    const eventos = [
        { tipo: "temperatura", valor: Math.random() * 40 }, 
        { tipo: "usuario", valor: `Usuario${Math.floor(Math.random() * 100)}` }, 
        { tipo: "error", valor: "Conexión perdida" }
    ];

    // Tiempo aleatorio entre 1 y 3 segundos para simular asincronía
    const tiempo = Math.floor(Math.random() * 3000) + 1000;

    setTimeout(() => {
        const eventoAleatorio = eventos[Math.floor(Math.random() * eventos.length)];
        //Aqui debe ir el callback y recoger el Evento aleatorio
        callback(eventoAleatorio);
    }, tiempo);
}
function a(evento){
console.log(evento);
} 
servidorEventos(a);