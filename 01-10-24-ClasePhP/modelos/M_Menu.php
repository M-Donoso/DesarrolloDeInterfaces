<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Menu extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); 
        $this->DAO = new DAO();
    }

    public function obtenerMenu() {
        $sql = "SELECT * FROM menu WHERE activo = 1 ORDER BY id_padre, posicion";
        return $this->DAO->consultar($sql);
    }

    public function updateApartado($datos = array()){
        $id='';
        $nombre='';
        $url='';
        extract($datos);
        $sql = "UPDATE menu SET url= '$url', titulo= '$nombre' WHERE id = '$id'";
        $id_apartado=$this->DAO->actualizar($sql);
        return $id_apartado;
    }
    public function eliminarApartado($datos = array()){
       $id='';
       extract($datos);
       $sql = "DeLETE FROM menu WHERE id = '$id'";
       $id=$this->DAO->borrar($sql);
        return $id;
    }

    
    public function crearNuevoApartado($datos = array()) {
        $id_padre = '';
        $titulo = '';
        $posicion = '';
        $url = '';
        $id_padre = null;
    
        // Extraer los valores del array $datos
        extract($datos);
    
        if (is_null($id_padre)) {
            // Actualizar las posiciones de apartados principales antes de insertar
            $sqlUpdate = "UPDATE `menu` 
                          SET `posicion` = `posicion` + 1 
                          WHERE `posicion` >= '$posicion';";
            $this->DAO->actualizar($sqlUpdate);
    
            // Insertar el nuevo apartado principal
            $sql = "INSERT INTO `menu` (`titulo`, `url`, `id_padre`, `posicion`, `activo`) 
                    VALUES ('$titulo', '$url', NULL, '$posicion', '1');";
            $id_apartado = $this->DAO->insertar($sql);
    
            return $id_apartado;
        } else {
            // Actualizar las posiciones de submenús antes de insertar
            $sqlUpdate = "UPDATE `menu` 
                          SET `posicion` = `posicion` + 1 
                          WHERE `posicion` >= '$posicion';";
            $this->DAO->actualizar($sqlUpdate);
    
            // Insertar el nuevo submenú
            $sql = "INSERT INTO `menu` (`titulo`, `url`, `id_padre`, `posicion`, `activo`) 
                    VALUES ('$titulo', '$url', '$id_padre', '$posicion', '1');";
            $id_submenu = $this->DAO->insertar($sql);
    
            return $id_submenu;
        }
    }
    
    
}
?>