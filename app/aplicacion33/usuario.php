<?php
require_once("AccesoDatos.php");

class Usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $fecha_de_registro;
    public $localidad;

    static $listado = array();

    function nuevoUsuario($nombre = "",$apellido = "",$clave = "",$mail = "",$fecha_de_registro = "", $localidad = "")
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->clave = $clave;
        $this->mail = $mail;
        $this->fecha_de_registro = $fecha_de_registro;
        $this->localidad = $localidad;
    }

    static function ActualizarClaveEnBd($usuario, $claveNueva) {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario SET clave=:clave WHERE mail=:mail");
        $consulta->bindValue(':mail',$usuario->mail, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$claveNueva, PDO::PARAM_INT);

        return $consulta->execute();
    }

    static function TraerUsuarioDeBd($idUsuario) {
        $listado = Usuario::RetornarUsuarios();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]->id == $idUsuario) 
                {
                    return $listado[$i];
                }
            }
        }
        return false;
    }

    static function ValidarUsuarioBd($mail, $clave) 
    {
        if($mail!=NULL && $clave!=NULL)
        {
            $arrayUsuarios = Usuario::RetornarUsuarios();
            if(!is_null($arrayUsuarios)) 
            {
                foreach($arrayUsuarios as $usuario)
                {
                    if($usuario->mail == $mail)
                    {
                        if($usuario->clave == $clave) {
                            //echo "Mail y Clave correctos<br/>";
                            return 1;
                        }
                        else {
                            //echo "Clave errónea<br/>";
                            return -1;
                        }
                    }
                }
            }
        }
        //echo "Usuario inexistente<br/>";
        return 0;
    }

    static function RetornarUsuarios ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from usuario");
        $consulta->execute();			
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
        return $array;
    }

    function AltaUsuario ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `usuario`(`nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$this->clave, PDO::PARAM_INT);
        $consulta->bindValue(':mail',$this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_registro',$this->fecha_de_registro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad',$this->localidad, PDO::PARAM_STR);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
}

    function GuardarArchivo ($archivo)
    {
        $destino = $this->nombre."/Fotos/";

        if (!file_exists($destino)) 
        {
            mkdir($destino,0777,true);
        }

        if (move_uploaded_file($archivo["tmp_name"], $destino.$archivo["name"])) 
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
                echo "<li>Nombre: ".$usuario->nombre."</li>";
                echo "<li>Apellido: ".$usuario->apellido."</li>";
                echo "<li>Clave: ".$usuario->clave."</li>";
                echo "<li>Mail: ".$usuario->mail."</li>";
                echo "<li>F. Registro: ".$usuario->fecha_de_registro."</li>";
                echo "<li>Localidad: ".$usuario->localidad."</li>";
                echo "<br/>";
            }
            echo "</ul>";
        }
    }    

    static function ValidarUsuario($mail, $clave) 
    {
        if(isset($mail) && isset($clave))
        {
            $arrayUsuarios = Usuario::RetornarArrayDelCSV();

            if(!is_null($arrayUsuarios)) 
            {
                foreach($arrayUsuarios as $usuario)
                {
                    if($usuario->mail == $mail)
                    {
                        if($usuario->clave == $clave) {
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

    static function TraerUsuario($id) {
        
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
        else {
            return NULL;
        }
        
    }
}

?>
