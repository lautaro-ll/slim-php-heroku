<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario (nombre, clavenueva, clavevieja, mail) por POST,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave
*/

require "usuario.php";
echo "Aplicación No 32 (Modificacion BD)<br/>";

if(isset($_POST["nombre"]) && isset($_POST["mail"]) && isset($_POST["clave"]) && isset($_POST["claveNueva"]))
{
    $nombre = $_POST["nombre"];
    $mail = $_POST["mail"];
    $clave = $_POST["clave"];
    $claveNueva = $_POST["claveNueva"];

    $resultado = Usuario::ValidarUsuariobD($mail, $clave);
    $usuario = new Usuario();
    $usuario->nuevoUsuario($nombre,"",$clave,$mail);

    if($resultado == 1){
        if(Usuario::ActualizarClaveEnBd($usuario, $claveNueva)) {
            echo "Clave Actualizada";
        }
    }
    elseif ($resultado == -1) {
        echo "Error en los datos"; //clave errónea.
    }
    else {
        echo "Usuario no registrado"; //mail erróneo.
    }
}
else
{
    echo "No se ingresó usuario";
}


?>
