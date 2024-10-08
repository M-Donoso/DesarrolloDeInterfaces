<?php
$usuarios=$datos['usuarios'];
$usuarios=array();
extract($datos);

foreach($usuarios as $posicion=>$fila){

    echo $fila['nombre'];
    echo '<br>';
}

?>