<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecutar constructor padre
        $this->DAO = new DAO();
    }

    public function buscarUsuarios($filtros=array()){
        $ftexto='';
        $factivo='';
        extract($filtros);

        $SQL="SELECT * FROM usuarios WHERE 1=1";

        if($ftexto!=''){
            $aPalabras=explode(' ', $ftexto);
            $union = [];

            foreach($aPalabras as $palabra) {
                $palabra = trim($palabra);
                if ($palabra != '') {
                    $union[] = "(nombre LIKE '%$palabra%'
                    OR apellido_1 LIKE '%$palabra%'
                    OR apellido_2 LIKE '%$palabra%' )";
                }
            }

            if (!empty($union)) {
                $SQL .= " AND (" . implode(' AND ', $union) . ")";
            }

            /* $SQL.=" AND (nombre LIKE '%$ftexto%'
            OR apellido_1 LIKE '%$ftexto%'
            OR apellido_2 LIKE '%$ftexto%' )";*/
        }

        if($factivo!=''){
            $SQL.=" AND activo = '$factivo' ";
        }

        $usuarios=$this->DAO->consultar($SQL);

        return $usuarios;
    }

}

?>