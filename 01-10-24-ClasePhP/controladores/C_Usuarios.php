<?php
require_once 'controladores/Controlador.php'; //Esto es como un Import , (cargar el fichero controlador si aun no esta cargado)
require_once 'modelos/M_Usuarios.php';
require_once 'vistas/Vista.php';

class C_Usuarios extends Controlador{
   private $modelo;

 public function __construct(){
    parent::__construct(); //Ejecutar constructor del padre.
    $this->modelo = new M_Usuarios();
 }

 public function getVistaFiltros($datos=array()){ //si ponemos = array estamos creando la variable (porque en php puede venir cualquier tipo de dato)) (esto significa q estamos esperando q nos venga un Array)
    Vista::render('vistas/Usuarios/V_Usuarios_Filtros.php');
 }
 public function getVistaNuevoEditar($datos=array()){ //si ponemos = array estamos creando la variable (porque en php puede venir cualquier tipo de dato)) (esto significa q estamos esperando q nos venga un Array)
   if(!isset($datos['id']) || $datos['id']==''){
      // nuevo
      Vista::render('vistas/Usuarios/V_Usuarios_NuevoEditar.php');
   }else{
      //editando
      $filtros['id_Usuario']=$datos['id'];
      $usuarios=$this->modelo->buscarUsuarios($filtros);
      Vista::render('vistas/Usuarios/V_Usuarios_NuevoEditar.php', array('usuario'=>$usuarios[0]));

   }
   

}
 public function getVistaListadoUsuarios($filtros=array()){
   //var_dump($filtros);
   $usuarios=$this->modelo->buscarUsuarios($filtros);
   Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios'=>$usuarios));
 }

 public function guardarUsuario($datos=array()){
   $respuesta['correcto']='S';
   $respuesta['msj']='Creado correctamente';

   $id=$this->modelo->insertarUsuario($datos);
   if($id>0){
      // nada, ok
   }else{
      $respuesta['correcto']='N';
      $respuesta['msj']='Error al crear';
   }
   echo json_encode($respuesta);
 }
 
}//fin clase Usuarios

?>