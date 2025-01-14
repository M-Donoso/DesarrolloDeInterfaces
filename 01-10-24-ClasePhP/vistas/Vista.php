<?php
class Vista {
    static public function render($rutaVista, $datos = array()) {
        extract($datos); 
        if (file_exists($rutaVista)) {
            require($rutaVista); // Incluye la vista
        } else {
            echo "La vista $rutaVista no existe.";
        }
    }
}

?>