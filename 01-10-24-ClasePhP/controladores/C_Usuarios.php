<?php
require_once 'controladores/Controlador.php'; //Esto es como un Import , (cargar el fichero controlador si aun no esta cargado)
class C_Usuarios extends Controlador{
 public function __construct(){
    parent::__construct(); //Ejecutar constructor del padre.
 }

 public function getVistaFiltros($datos=array()){ //si ponemos = array estamos creando la variable (porque en php puede venir cualquier tipo de dato)) (esto significa q estamos esperando q nos venga un Array)
    require_once 'vistas/Vista.php';
    Vista::render('vistas/Usuarios/V_Usuarios_Filtros.php');
 }
 
}//fin clase Usuarios



?>