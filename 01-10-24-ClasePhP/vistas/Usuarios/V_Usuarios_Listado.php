<?php
$usuarios=$datos['usuarios'];
$usuarios=array();
extract($datos);

$html='';
$html.='<div class="table-responsive"></div>
        <table class="table table-sm table-striped">';
$html.='<thead>
            <tr>
                <th>apellidos, nombre</th>
                <th>mail</th>
                <th>login</th>
                <th>¿Activo?</th>
            </tr>
        </thead>
        <tbody>';
$activo='';
foreach($usuarios as $posicion=>$fila){
    //echo $fila['nombre'];
$estilo='';
if($fila['activo']=='N'){
$activo='INACTIVO';
$estilo='color:red;';
}else{
    $activo='ACTIVO';
}
    $html.='<tr>
             <td nowrap style="'.$estilo.'">'.$fila['apellido_1'].' '.$fila['apellido_2'].', '.$fila['nombre'].'</td>
             <td>'.$fila['mail'].'</td>
             <td>'.$fila['login'].'</td>
             <td>'.$activo.'</td>
             <td style="'. $estilo .'"><Button class="btn btn-outline-secondary" onclick="obtenerVista_EditarCrear(\'Usuarios\', \'getVistaNuevoEditar\', \'capaResultadosBusqueda\', '.$fila['id_Usuario'].')">Editar</Button></td>
            </tr>';

}
 $html.='</tbody>
    </table>
    </div>';

echo $html;
?>