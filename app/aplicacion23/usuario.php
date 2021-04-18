<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;
    public $id;
    public $fechaDeRegistro;
    public $archivo;

    static $listado = array();

    function __construct($nombre = "",$clave = "",$mail = "",$id = "",$fechaDeRegistro = "")
    {
        //usar setter y getter
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
        $this->id = $id;
        $this->fechaDeRegistro = $fechaDeRegistro;
    }

    function GuardarArchivo ($archivo)
    {
        $this->archivo = $archivo;

        $destino = "Fotos/".$this->archivo["archivo"]["name"];

        if (file_exists($destino)) 
        {
            return 0;
            //echo "<br/>El archivo ya existe.";
        }

        if (move_uploaded_file($this->archivo["archivo"]["tmp_name"], $destino)) 
        {
            return 1;
            //echo "<br/>El archivo ha sido subido exitosamente.";
        } 
        else 
        {
            return -1;
            //echo "<br/>Lamentablemente ocurrio un error y no se pudo subir el archivo.";
        }
    }

    function GuardarEnJSON ()
    {
        if(!file_exists("usuarios.json") || is_writable("usuarios.json")) 
        {
            
            $archivo = fopen("usuarios.json", "a");
            fwrite($archivo, json_encode($this)."<br/>");
            fclose($archivo);
            
            return 1;
        }
        else {
            return 0;
        }
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

    static function ValidarUsuario(Usuario $usuarioAValidar) 
    {
        if(isset($usuarioAValidar->mail) && isset($usuarioAValidar->clave))
        {
            $arrayUsuarios = Usuario::RetornarArrayDelCSV();

            if(!is_null($arrayUsuarios)) 
            {
                foreach($arrayUsuarios as $usuario)
                {
                    if($usuario->mail == $usuarioAValidar->mail)
                    {
                        if($usuario->clave == $usuarioAValidar->clave) {
                            //echo "Mail y Clave correctos";
                            return 1;
                        }
                        else {
                            //echo "Clave errónea";
                            return -1;
                        }
                    }
                }
            }
        }
        //echo "Usuario inexistente";
        return 0;
    }
}

?>
