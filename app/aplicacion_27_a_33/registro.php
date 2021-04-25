<?php
/*
LEMOS LAUTARO LUCAS

Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos retorna si se pudo agregar o no.

*/
include "Usuario.php";
echo "Aplicación No 27 (Registro BD)<br/>";

if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["clave"]) && isset($_POST["mail"]) && isset($_POST["localidad"]))
{
    $nombre = $_POST["nombre"];    
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $fechaDeRegistro = date("Y-m-d");
    $localidad = $_POST["localidad"];

    $nuevoUsuario = new Usuario();
    $nuevoUsuario->nuevoUsuario($nombre, $apellido, $clave, $mail, $fechaDeRegistro, $localidad);

    if(($nuevoId = Usuario::AltaUsuarioEnBd($nuevoUsuario)) > 0) 
    {
        echo "Se pudo agregar usuario. <br/>";
        echo "Nuevo Id: ".$nuevoId." <br/>";
    }
    else if($nuevoId == -1)
    {
        echo "Ya existe un usuario con ese mail. <br/>";        
    }
    else
    {
        echo "No se pudo agregar usuario. <br/>";        
    }
} 
else
{
    echo "No se ingresó usuario. <br/>";
}


?>
