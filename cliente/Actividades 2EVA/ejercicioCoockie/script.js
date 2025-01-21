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
if(arrayCookies['usuario']==undefined){
    crearLogin();
}
function crearCookie($minutosDuracion){
    let hoy=new Date();
    let expira=new Date(hoy.getTime()+($minutosDuracion*60*1000));
    document.cookie=`acepto=${acepto}; expires=${expira}`;
}
function crearLogin(){
    const body=document.querySelector('body');
    let titulo=document.createElement('h1');
    titulo.innerText='Inicia sesión';
    body.append(titulo);
    let formulario=document.createElement('form');
    let user= document.createElement('input');
    user.type='text';
    user.placeholder='Usuario';
    user.id='user';
    formulario.append(user);
    let pass= document.createElement('input');
    pass.type='text';
    pass.placeholder='Contraseña';
    pass.id='pass';
    formulario.append(pass);
    let btn= document.createElement('input');
    btn.type='button';
    btn.value='Entrar';
    btn.id='btn';
    btn.addEventListener('click', ()=>crearCookieUser)
    formulario.append(btn);
    body.append(formulario);
    
}
function crearCookieUser(){
    const user=document.getElementById('user');
    const pass=document.getElementById('pass');
    
}