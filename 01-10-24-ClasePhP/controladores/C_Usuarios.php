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

 public function validarUsuario($datos = array()) {
   $id_Usuario = $this->modelo->login($datos);

   // Verifica si $id_Usuario es un array antes de intentar acceder a sus índices
   if ($id_Usuario != '') {
       return $id_Usuario;
   } else {
       // Maneja el caso en que no se devuelve un array
       return false;
   }
}

public function guardarUsuario($datos = array()) {
    $respuesta['correcto'] = 'S';
    $respuesta['msj'] = 'Creado correctamente';
    $login = $datos['login'];
    
    $id_Usuario = '';
    extract($datos);
 
    // Validación de campos vacíos
    $camposRequeridos = ['nombre', 'apellido_1', 'mail', 'login', 'sexo', 'fecha_Alta'];
    foreach ($camposRequeridos as $campo) {
        if (empty($datos[$campo])) {
            echo json_encode(["error" => true, "msj" => "El campo $campo es obligatorio."]);
            exit;
        }
    }

    if ($id_Usuario == '') {
        // Validación para la creación de usuario (nuevo login)
        $usuarioExistente = $this->modelo->validarLogin($login, $id_Usuario);
        
        // Validar si el login ya existe
        if ($usuarioExistente) {
            echo json_encode(["error" => true, "msj" => "El login ya existe."]);
            exit;
        }
 
        // Crear usuario
        $id = $this->modelo->insertarUsuario($datos);
        if ($id > 0) {
            $respuesta['msj'] = 'Creado correctamente';
        } else {
            $respuesta['correcto'] = 'N';
            $respuesta['msj'] = 'Error al crear';
        }
    } else {
        // Validación para la actualización de usuario (puede tener el mismo login)
        $usuarioExistente = $this->modelo->validarLogin($login, $id_Usuario);
        
        // Validar si el login ya existe
        if ($usuarioExistente) {
            echo json_encode(["error" => true, "msj" => "El login ya existe."]);
            exit;
        }
 
        // Actualizar usuario
        $actualizado = $this->modelo->updateUsuario($datos);
        if ($actualizado >= 0) {
            $respuesta['msj'] = 'Actualizado correctamente';
        } else {
            $respuesta['correcto'] = 'N';
            $respuesta['msj'] = 'Error al actualizar';
        }
    }
 
    echo json_encode($respuesta);
}


 public function actualizarEstadoUsuario() {
   $idUsuario = $_POST['id'];
   $activo = $_POST['activo'];

   // Llamar al modelo para actualizar el estado del usuario
   $resultado = $this->modelo->actualizarEstado($idUsuario, $activo);

   if ($resultado) {
       echo json_encode(["error" => false, "msj" => "Estado actualizado correctamente."]);
   } else {
       echo json_encode(["error" => true, "msj" => "Error al actualizar el estado."]);
   }
}

}//fin clase Usuarios

?>