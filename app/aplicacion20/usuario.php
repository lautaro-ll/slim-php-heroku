<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;

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
}

?>