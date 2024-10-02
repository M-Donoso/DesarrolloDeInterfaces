<?php
class Vista{
    static public function render($rutaVista, $datos=array()){
        require($rutaVista); //include($rutaVista)
    }
}

?>