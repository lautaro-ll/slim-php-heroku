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

    function nuevoUsuario($nombre, $apellido, $clave, $mail, $fecha_de_registro, $localidad)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->clave = $clave;
        $this->mail = $mail;
        $this->fecha_de_registro = $fecha_de_registro;
        $this->localidad = $localidad;
    }

    static function RetornarUsuarios ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from usuario");
        $consulta->execute();			
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
        return $array;
    }

    static function TraerUsuarioDeBd($idUsuario) 
    {
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

    static function ValidarUsuarioEnBd($mail, $clave) 
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
                            return 1;
                        }
                        else {
                            return -1;
                        }
                    }
                }
            }
        }
        return 0;
    }

    static function ActualizarClaveEnBd($usuario, $claveNueva) 
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuario SET clave=:clave WHERE mail=:mail");
        $consulta->bindValue(':mail',$usuario->mail, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$claveNueva, PDO::PARAM_INT);

        return $consulta->execute();
    }

    static function AltaUsuarioEnBd($usuario) 
    {
        if($usuario->mail!=NULL && Usuario::TraerUsuarioDeBd($usuario->id))
        {
                return -1;
        }
        else {
            $nuevoId = Usuario::AgregarUsuarioEnBd($usuario);
            if($nuevoId!=NULL) {
                return $nuevoId;
            }
            return 0;
        }
    }

    static function AgregarUsuarioEnBd ($usuario)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `usuario`(`nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad)");
        $consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido',$usuario->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$usuario->clave, PDO::PARAM_INT);
        $consulta->bindValue(':mail',$usuario->mail, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_registro',$usuario->fecha_de_registro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad',$usuario->localidad, PDO::PARAM_STR);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
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
}
?>
