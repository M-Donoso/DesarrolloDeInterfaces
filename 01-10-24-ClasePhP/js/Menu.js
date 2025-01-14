function crearNuevoApartado(btn, posicion, id_padre) {
    const card = btn.closest('.card');
    const nombreInput = card.querySelector('.nuevo-nombre');
    const funcionInput = card.querySelector('.funcion');

    const titulo = nombreInput ? nombreInput.value.trim() : '';
    const funcion = funcionInput ? funcionInput.value.trim() : '';

    if (!titulo) {
        alert('El nombre no puede estar vacío.');
        return;
    }

    if (!funcion) {
        alert('La función no puede estar vacía.');
        return;
    }
    const positionContainer = btn.closest('.position-absolute');
    if (positionContainer) {
        if (positionContainer.classList.contains('bottom-0')) {
            posicion += 1; // Si es el botón de abajo, sumamos 1 a la posición
        } else {
            posicion -= 1; // Si es el botón de arriba, restamos 1 a la posición
        }
    } else {
        console.warn("No se pudo determinar si el botón es de arriba o abajo. Posición no modificada.");
    }
    
    const url = funcion; 

    let parametros = "controlador=Menu&metodo=crearNuevoApartado";
    parametros += '&titulo=' + titulo + '&posicion=' + posicion + '&url=' + url + '&id_padre=' + id_padre;

    console.log("Datos enviados:  ", "   titulo:   ", titulo, "   Posición:    ", posicion, "   URL:   ", url, "   Parámetros:   ", parametros, "  id_padre:  ", id_padre);

    let opciones = { method: "GET" };

    fetch('C_Frontal.php?' + parametros, opciones)
        .then(res => {
            if (res.ok) {
                return res.json();
            }
            throw new Error(res.status);
        })
        .then(resultado => {
            if (resultado.correcto) {
                card.style.display = 'none';  
            } else {
              
            }
        })
        .catch(err => {
            console.error('Error al guardar el nuevo apartado o submenú:', err);
            alert('Hubo un error al guardar el apartado o submenú.');
        });
}

function updateApartado(id, nombre, url) {

  console.log(id,nombre,url);
    let parametros = "controlador=Menu&metodo=updateApartado";
    parametros += '&id=' + id + '&nombre='+nombre+'&url='+ url;

    let opciones = { method: "POST" };

    fetch('C_Frontal.php?' + parametros, opciones)
    .then(res => {
        if (res.ok) {
            return res.json();
        }
        throw new Error(res.status);
    })
    .then(resultado => {
        if (resultado.correcto) {
            
            if (document.getElementById('editForm' + id)) {
                document.getElementById('editForm' + id).style.display = 'none';
            }
          
            if (document.getElementById('editFormSubmenu' + id)) {
                document.getElementById('editFormSubmenu' + id).style.display = 'none';
            }
        } else {
            alert("error");
        }
    })
    .catch(err => {
        console.error('Error al guardar el nuevo apartado o submenú:', err);
        alert('Hubo un error al guardar el apartado o submenú.');
    });
}
function eliminarApartado(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este apartado o submenú?")) {
        let parametros = "controlador=Menu&metodo=eliminarApartado";
        parametros += '&id=' + id;

        let opciones = { method: "POST" };

        fetch('C_Frontal.php?' + parametros, opciones)
            .then(res => {
                if (res.ok) {
                    return res.json();
                }
                throw new Error(res.status);
            })
            .then(resultado => {
                if (resultado.correcto) {
                    // Intentamos eliminar tanto los menús principales como los submenús
                    const item = document.querySelector(`[data-id='${id}']`) 
                                || document.getElementById(`editFormSubmenu${id}`)
                                || document.getElementById(`editForm${id}`);
                    
                    if (item) {
                        item.closest('.card, .list-group-item').remove(); // Eliminamos el contenedor más cercano
                    } else {
                        console.warn(`No se encontró un elemento con el id ${id}`);
                    }
                } else {
                    alert('Error al eliminar el apartado o submenú en el servidor.');
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                alert('Hubo un error al procesar la solicitud de eliminación.');
            });
    }
}
