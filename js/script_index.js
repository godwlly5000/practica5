const elemth4=document.getElementById('contenido');

//Añadir un escuchador
document.addEventListener('DOMContentLoaded',function(){

    //implementar el appi XHLHTPRequet
    implement_ajax();
    //implementar el API fecht
    //implement_fetch();

});

function implement_ajax(){
    let obj_ajax=new XMLHttpRequest();
    obj_ajax.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {
            elemth4.innerHTML=this.responseText;
        }

    };

    //obj_ajax.open("GET","../files/archivo_texto.txt");//ruta relativa
    obj_ajax.open("GET","http://localhost/app_web/servidor/files/archivo_texto.txt",true);//ruta absoluta
    obj_ajax.send();

}

function implement_fetch(){
    fetch("http://localhost/app_web/servidor/files/archivo_texto_fetch.txt")
    .then(function(respuesta){
        return respuesta.text();
    })
    .then(function(texto){
        elemth4.innerHTML=texto;
    })
};