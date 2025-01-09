const cookies=document.cookie.split("; ");
let arrayCookies={};
for(let cookie of cookies){
    const [clave, valor]=cookie.split("=");
    arrayCookies[clave]=valor;
}
if(arrayCookies['acepto']==undefined){
    let acepto=confirm("¿Aceptas las cookies?");
    let hoy=new Date();
    let expira=new Date(hoy.getTime()+(10*60*1000));
    document.cookie=`acepto=${acepto}; expires=${expira}`;
}
function crearCookie($minutosDuracion){
    let hoy=new Date();
    let expira=new Date(hoy.getTime()+($minutosDuracion*60*1000));
    document.cookie=`acepto=${acepto}; expires=${expira}`;
}