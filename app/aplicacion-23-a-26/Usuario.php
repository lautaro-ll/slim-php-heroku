<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;
    public $id;
    public $fechaDeRegistro;

    static $listado = array();

    function __construct($nombre, $clave, $mail, $id, $fechaDeRegistro)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
        $this->id = $id;
        $this->fechaDeRegistro = $fechaDeRegistro;
    }

    static function TraerUsuario ($id) 
    {    
        $listado = Usuario::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["id"] == $id) 
                {
                    return $listado[$i];
                }
            }
        }
        else 
        {
            return NULL;
        }
    }

    function GuardarArchivo ($archivo)
    {
        $destino = "Usuarios/Fotos/";

        if (!file_exists($destino)) 
        {
            mkdir($destino,0777,true);
        }

        if (move_uploaded_file($archivo["tmp_name"], $destino.$this->id."-".$archivo["name"])) 
        {
            return 1;
        } 
        else 
        {
            return 0;
        }
    }

    function GuardarEnJSON ()
    {
        if(!file_exists("usuarios.json") || is_writable("usuarios.json")) 
        {
            
            $archivo = fopen("usuarios.json", "a");
            fwrite($archivo, json_encode($this)."\n");
            fclose($archivo);
            
            return 1;
        }
        else {
            return 0;
        }
    }

    static function RetornarArrayDelJSON()
    {
        if(($archivo = fopen("usuarios.json","r")) !== FALSE) {

            $i = 0;
            while(!feof($archivo))
            {
                $jsonObj = fgets($archivo);
                $usuario = json_decode($jsonObj, true);
                if($usuario != NULL)
                    $listado[$i] = $usuario;
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
                echo "<li>Nombre: ".$usuario["nombre"]."</li>";
                echo "<li>Clave: ".$usuario["clave"]."</li>";
                echo "<li>Mail: ".$usuario["mail"]."</li>";
                echo "<li>Id: ".$usuario["id"]."</li>";
                echo "<br/>";
            }
            echo "</ul>";
        }
    }    
}

?>
