<?php
require_once 'controladores/Controlador.php';
require_once 'vistas/Vista.php';
require_once 'Modelos/M_Menu.php';

class C_Menu extends Controlador{
    private $modelo;

    public function __construct(){
        parent::__construct(); //Ejecutar constructor del padre.
        $this->modelo = new M_Menu();
     }

     
    public function getVistaFiltros($datos=array()){ 
        Vista::render('vistas/Menus/V_Menu_Filtros.php'); 
    }
    public function cargarVistaMenu(){
        $datos=$this->modelo->obtenerMenu();
        Vista::render('vistas/Menus/V_Menu.php', $datos);
    }
    public function getVistaMenuEditar(){
        $datos=$this->modelo->obtenerMenu();
        Vista::render('vistas/Menus/V_Menu_EditarMenu.php',$datos);
    }
    public function crearNuevoApartado($datos = array()) {
        $id = $this->modelo->crearNuevoApartado($datos);
    
        if ($id > 0) {
            echo json_encode([
                "correcto" => true,
                "mensaje" => "Apartado creado correctamente.",
                "id_nuevo" => $id
            ]);
        } else {
            echo json_encode([
                "correcto" => false,
                "mensaje" => "Error al guardar el nuevo apartado."
            ]);
        }
    }
    public function updateApartado($datos = array()) {
        $id = $this->modelo->updateApartado($datos);
        echo json_encode([
            "correcto" => true,
            "mensaje" => "Apartado creado correctamente.",
            "id_nuevo" => $id
        ]);
    }
    public function eliminarApartado($datos = array()) {
        $id = $this->modelo->eliminarApartado($datos);
        if($id<0){
            echo json_encode([
                "correcto" => false,
                "mensaje" => "Error al borrar el apartado."
            ]);
        }else{
            echo json_encode([
                "correcto" => true,
                "mensaje" => "Apartado borrar correctamente.",
                "id_eliminado" => $id
            ]);
        }
    }
}
?>