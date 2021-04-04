<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;

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
}

?>