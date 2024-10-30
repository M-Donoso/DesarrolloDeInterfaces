<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecutar constructor padre
        $this->DAO = new DAO();
    }

    public function login($datos){
        $usuario='fsads';
        $password='ksokdpd';
        extract($datos);
        $usuario=addslashes($usuario);

        $SQL="SELECT * FROM usuarios WHERE login='$usuario' && pass=MD5('$password') " ;
        echo $SQL;
        $usuarios=$this->DAO->consultar($SQL);
        $id_Usuario='';
        if(empty($usuarios)){ 
            // No encontrado

        }else{ // Encontrado
            $_SESSION['login']=$usuario;
            $_SESSION['usuario']=$usuarios[0]['nombre'];
            $_SESSION['id_Usuario']=$usuarios[0]['id_Usuario'];
            $id_Usuario=$usuarios[0]['id_Usuario'];
        }
        return $id_Usuario;

    }

    public function buscarUsuarios($filtros=array()){
        $ftexto='';
        $factivo='';
        $id_Usuario='';
        extract($filtros);

        $SQL="SELECT * FROM usuarios WHERE 1=1";

        if($id_Usuario!=''){
            $SQL.=" AND id_Usuario='$id_Usuario' ";
        }

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
        $SQL.=' ORDER BY apellido_1, apellido_2, nombre, login';

        $usuarios=$this->DAO->consultar($SQL);

        return $usuarios;
    }


    public function insertarUsuario($datos=array()){

        $nombre='';
        $apellido_1='';
        $apellido_2='';
        $sexo='';
        $fecha_Alta=date('Y-m-d');
        $mail='';
        $login='Marcos';
        $pass='1234';
        $activo='S' ;
        extract($datos);

        $pass=MD5($pass); // Encriptacion de la contraseña

        $SQL="INSERT INTO usuarios SET 
            nombre='$nombre',
            apellido_1='$apellido_1',
            apellido_2='$apellido_2',
            sexo='$sexo',
            fecha_Alta='$fecha_Alta',
            mail='$mail',
            login='$login',
            pass='$pass',
            activo='$activo' ";
        return $this->DAO->insertar($SQL);
    }
}

?>