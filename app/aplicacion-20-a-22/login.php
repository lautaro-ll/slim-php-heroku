<?php

/*
Aplicación No 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario
*/

require "Usuario.php";
echo "Aplicación No 22 (Login)<br/>";

if(isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $usuarioIngresado = new Usuario(null, $clave, $mail);

    if(($resultado = Usuario::ValidarUsuario($usuarioIngresado)) == 1)
    {
        echo "Verificado. <br/>";
    }
    elseif ($resultado == -1) 
    {
        echo "Error en los datos. <br/>";
    }
    else 
    {
        echo "Usuario no registrado. <br/>";
    }
}
else
{
    echo "No se ingresó usuario. <br/>";
}

?>