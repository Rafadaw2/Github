/*captura
let div1=document.getElementById("id1");
div1.addEventListener("click",fDiv1);
let div2=document.getElementById("id2");
div2.addEventListener("click",fDiv2);
let div3=document.getElementById("id3");
div3.addEventListener("click",fDiv3);
let div4=document.getElementById("id4");
div4.addEventListener("click",fDiv4);
*/
/*burbuja 
let div1=document.getElementById("id1");
div1.addEventListener("click",fDiv1,true);
let div2=document.getElementById("id2");
div2.addEventListener("click",fDiv2,true);
let div3=document.getElementById("id3");
div3.addEventListener("click",fDiv3,true);
let div4=document.getElementById("id4");
div4.addEventListener("click",fDiv4,true);
*/
//solo uno
let div1=document.getElementById("id1");
div1.addEventListener("click",fDiv1);
let div2=document.getElementById("id2");
div2.addEventListener("click",fDiv2);
let div3=document.getElementById("id3");
div3.addEventListener("click",fDiv3);
let div4=document.getElementById("id4");
div4.addEventListener("click",(event)=>{alert("Has clickado en div4"); event.stopPropagation();});


function fDiv1(){
    alert("Has clickado en div1");
}
function fDiv2(){
    alert("Has clickado en div2");
}
function fDiv3(){
    alert("Has clickado en div3");
}
function fDiv4(){
    alert("Has clickado en div4");
    
}