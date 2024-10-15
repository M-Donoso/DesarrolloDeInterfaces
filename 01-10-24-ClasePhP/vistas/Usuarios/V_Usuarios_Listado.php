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

if($fila['activo']=='N'){
$activo='INACTIVO';
}else{
    $activo='ACTIVO';
}
    $html.='<tr>
             <td nowrap>'.$fila['apellido_1'].' '.$fila['apellido_2'].$fila['nombre'].'</td>
             <td>'.$fila['mail'].'</td>
             <td>'.$fila['login'].'</td>
             <td>'.$activo.'</td>
            </tr>';

}
 $html.='</tbody>
    </table>
    </div>';

echo $html;
?>