<?php
$usuarios=$datos['usuarios'];
$usuarios=array();
extract($datos);

$html = '';
$html .= '<div class="table-responsive">
            <table class="table table-sm table-striped">

                <thead>
                    <link rel="stylesheet" href="librerias/bootstrap-5.3.3-dist/css/bootstrap.min.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
                    <script src="librerias/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
                    <link rel="stylesheet" href="css/usuarios.css"> 
                    <tr>
                        <th>apellidos, nombre</th>
                        <th>mail</th>
                        <th>login</th>
                        <th>¿Activo?</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

foreach ($usuarios as $posicion => $fila) {
    $activo = '';
    $estilo = '';
    $toggleChecked = '';
    $rowClass = '';
                
    // Determinar el estado activo/inactivo
    if ($fila['activo'] == 'N') {
        $activo = 'INACTIVO';
        $estilo = 'color: red;';
        $rowClass = 'inactivo'; // Añadir clase 'inactivo' si está inactivo
    } else {
        $activo = 'ACTIVO';
        $toggleChecked = 'checked';
        $rowClass = 'activo'; // Añadir clase 'activo' si está activo
    }
                
    // Generar cada fila de la tabla
    $html .= '<tr id="' . $fila['id_Usuario'] . '" class="' . $rowClass . '">
        <td id="apellido_' . $fila['id_Usuario'] . '" nowrap style="' . $estilo . '">' . $fila['apellido_1'] . ' ' . $fila['apellido_2'] . ', ' . $fila['nombre'] . '</td>
        <td id="mail_' . $fila['id_Usuario'] . '" style="' . $estilo . '">' . $fila['mail'] . '</td>
        <td id="login_' . $fila['id_Usuario'] . '" style="' . $estilo . '">' . $fila['login'] . '</td>
        <td id="estado_' . $fila['id_Usuario'] . '" class="estado-usuario_' . $fila['id_Usuario'] . '" style="' . $estilo . '">' . $activo . '</td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault_' . $fila['id_Usuario'] . '" ' . $toggleChecked . ' onchange="actualizarEstadoUsuario(' . $fila['id_Usuario'] . ', this.checked)">
                <label class="form-check-label" for="flexSwitchCheckDefault_' . $fila['id_Usuario'] . '"></label>
            </div>
        </td>
        <td style="' . $estilo . '">
            <button class="btn btn-outline-secondary" onclick="obtenerVista_EditarCrear(\'Usuarios\', \'getVistaNuevoEditar\', \'capaResultadosBusqueda\', ' . $fila['id_Usuario'] . ')">
            <i class="bi bi-pencil"></i>
            </button>
        </td>
        </tr>';
    }
                
    $html .= '</tbody>
        </table>
        </div>';
                
echo $html;
?>
