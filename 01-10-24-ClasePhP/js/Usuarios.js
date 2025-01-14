function guardarUsuario() {
    console.log('Guardando...');

    let opciones = { method: "POST", headers: { "Content-Type": "application/x-www-form-urlencoded" } };
    let parametros = "controlador=Usuarios&metodo=guardarUsuario";
    parametros += '&' + new URLSearchParams(new FormData(document.getElementById('formularioEdicion'))).toString();

    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res => res.json())
        .then(resultado => {
            if (resultado.error) {
                // Mostrar el mensaje de error en pantalla si el login ya existe
                document.getElementById('msjError').innerHTML = resultado.msj;
            } else {
                // Mostrar el mensaje de éxito
                document.getElementById('capaEditarCrear').innerHTML = resultado.msj;
            }
        })
        .catch(err => {
            console.error("Error al guardar", err.message);
            document.getElementById('msjError').innerHTML = "Ocurrió un error al intentar guardar.";
        
        });
}

function actualizarEstadoUsuario(idUsuario, estadoActivo) {
    // Determinar el valor de estado a enviar a la base de datos
    let nuevoEstado = estadoActivo ? 'S' : 'N';

    // Configurar la solicitud de actualización
    let opciones = {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `controlador=Usuarios&metodo=actualizarEstadoUsuario&id=${idUsuario}&activo=${nuevoEstado}`
    };

    // Realizar la solicitud al backend
    fetch("C_Frontal.php", opciones)
        .then(res => res.json())
        .then(resultado => {
            if (resultado.error) {
                document.getElementById('msjError').innerHTML = resultado.msj;
            } else {
                // Cambiar el estilo de la fila según el estado
                let estilo = estadoActivo ? 'color: black;' : 'color: red;';
                document.getElementById('apellido_' + idUsuario).style = estilo;
                document.getElementById('mail_' + idUsuario).style = estilo;
                document.getElementById('login_' + idUsuario).style = estilo;
                document.getElementById('estado_' + idUsuario).style = estilo;

                // Actualizar el texto de la columna de estado
                document.querySelector('.estado-usuario_' + idUsuario).innerText = estadoActivo ? 'ACTIVO' : 'INACTIVO';
            }
        })
        .catch(err => {
            console.error("Error al actualizar estado", err.message);
            document.getElementById('msjError').innerHTML = "Ocurrió un error al intentar actualizar el estado.";
        });
}


