const enviar = document.getElementById("btnEnviar");
const nombre = document.getElementById("txtNombre");
const mensaje = document.getElementById("txtComentario");

enviar.addEventListener('click', function() {
    //utilizando el PI Fetch
    fetch('http://localhost/app_web/servidor_V4/php/script_form_mensajes.php', {
            method: 'POST',
            headers: {
                "Content-type": "application/json; charset=utf-8"
            },
            body: JSON.stringify({
                _nombre: nombre.value,
                _comentario: mensaje.value
            })
        })
        .then(function(respuesta) {
            return respuesta.json();
        })
        .then(function(json) {
            console.log(json);
            document.getElementById('respuesta').innerHTML = "";

            let respuesta = `<tr> 
                              <th>NOMBRE</th> 
                              <th>COMENTARIO</th>
                         </tr>`;
            //PROCESAR EL OBJETO JASON
            json.forEach(function(info) {
                respuesta += `<tr>
                            <td>${info.C_nombre}</td>
                            <td>${info.C_comentario}</td>
                        </tr>`;
            });

            document.getElementById('respuesta').innerHTML = respuesta;

        })
        .catch(function(error) {
            console.error("ERROR: ", error);
        });
});