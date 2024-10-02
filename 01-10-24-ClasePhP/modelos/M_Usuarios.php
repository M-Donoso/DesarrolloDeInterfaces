<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecutar constructor padre
        $this->DAO = new DAO();
    }

}

?>