<?php
    define('HOST', '127.0.0.1');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'di24');

    class DAO{
		private $conexion; 
        private $error;
				
		public function __construct(){ //constructor
			$this->conexion= new mysqli(HOST,USER,PASS,DB);
			if($this->conexion->connect_errno){
				die('Error de conexión: '.$this->conexion->connect_error);
			}
			$this->error='';
		}

        public function consultar($SQL){
			//NO VISUALIZAR NADA AQUI PUES NO RETURN-ARA BIEN
			$res=$this->conexion->query($SQL,MYSQLI_USE_RESULT); //sin usar buffer mysql
			$filas=array();
			if ($this->conexion->errno) {
					die('Error en consulta: '.$this->conexion->error.' SQL: <b>'.$SQL.'</b>');
			}else{
				while($reg=$res->fetch_assoc()){
					$filas[]=$reg;
				}
			}
			return $filas;
		}

		public function insertar($SQL){
            $this->conexion->query($SQL, MYSQLI_USE_RESULT);
            if($this->conexion->connect_errno){
                die('Error consulta a BD: '.$SQL);
                return '';
            }else{
                return $this->conexion->insert_id;
            }
        }

        public function actualizar($SQL){
            $this->conexion->query($SQL, MYSQLI_USE_RESULT);
            if($this->conexion->connect_errno){
                die('Error consulta a BD: '.$SQL);
                return '';
            }else{
                return $this->conexion->affected_rows;
            }
        }

        public function borrar($SQL){
			$this->conexion->query($SQL);
			return $this->conexion->affected_rows;
		}
    }
?>