<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;
    static $listado = array();

    function __construct($nombre = "",$clave = "",$mail = "")
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
    }
    
    function GuardarEnCSV ()
    {
        if(!file_exists("usuarios.csv") || is_writable("usuarios.csv")) 
        {
            $archivo = fopen("usuarios.csv", "a");
            fwrite($archivo, "$this->nombre, $this->clave, $this->mail\n");
            fclose($archivo);
            return 1;
        }
        else {
            return 0;
        }
    }

    static function RetornarArrayDelCSV()
    {
        if(($archivo = fopen("usuarios.csv","r")) !== FALSE) {
            $i = 0;
            while (($datos = fgetcsv($archivo, 1000, ",")) !== FALSE) {
                if(count($datos)==3) {
                    $nuevoUsuario = new Usuario($datos[0],$datos[1],$datos[2]);
                }
                $listado[$i] = $nuevoUsuario;
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
                echo "<li>".$usuario->nombre."</li>";
                echo "<li>".$usuario->clave."</li>";
                echo "<li>".$usuario->mail."</li>";
                echo "<br/>";
            }
            echo "</ul>";
        }
    }    
}

?>
