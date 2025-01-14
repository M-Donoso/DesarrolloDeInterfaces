<?php
    $getPost=array_merge($_GET, $_POST, $_FILES ); // $getPost ES UNA VARIABLE QUE GUARDA TODO LO Q VENGA DE METODOS POST Y GET Y FILES EN EL MISMO ARRAY

    if(isset($getPost['controlador']) && $getPost['controlador']!=''){ //comprobamos q el controlador q nos viene en la variable getPost existe && si es igual a vacio
        //recibido controlador
        $controlador='C_'.$getPost['controlador']; //se concatena con el . en vez de con el + como en java
        if(file_exists('./controladores/'.$controlador.'.php')){
            //Existe el controlador
            $metodo=$getPost['metodo'];
            
    require_once 'controladores/'.$controlador.'.php';

            $objetoControlador=new $controlador();  
            if(method_exists($objetoControlador,$metodo)){
                $objetoControlador->$metodo($getPost);
            }else{
                echo ' Error CF-03'; //no existe el metodo
            }
        }else{
            echo ' Error CF-NFC-02'; //no existe el fichero controlador
        }

    }else{
     //no he recibido nada
        echo 'Error CF-01';
    }
?>