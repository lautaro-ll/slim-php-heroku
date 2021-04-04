<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;
    static $listado = array();

    function __construct($nombre = "",$usuario = "",$mail = "")
    {
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->mail = $mail;
    }
    
    function GuardarEnCSV ()
    {
        if(!file_exists("usuarios.csv") || is_writable("usuarios.csv")) 
        {
            $archivo = fopen("usuarios.csv", "a");
            fwrite($archivo, "$this->nombre, $this->usuario, $this->mail\n");
            fclose($archivo);
            return 1;
        }
        else {
            return 0;
        }
    }

    static function RetornarArrayDelCSV()
    {
        if($archivo = fopen("usuarios.csv","r") !== FALSE) {
            $i = 0;
            while (($datos = fgetcsv($archivo, 0, ",")) !== FALSE) {
                $listado[$i] = $datos;
                $i++;
            } 
            fclose($archivo);
            return $listado;
        }
        else {
            return null;
        }
    }

    static function DibujarListado($listado)
    {
        if(!is_null($listado) && is_array($listado)) 
        {
            echo "<ul>";
            foreach($listado as $usuario)
            {
                echo "<li>";
                foreach($usuario as $dato)
                {
                    echo $dato." ";
                }
                echo "</li>";
            }
            echo "</ul>";
        }
    }    
}

?>
