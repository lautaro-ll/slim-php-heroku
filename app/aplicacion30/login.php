<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST, crear un objeto y utilizar 
sus métodos para poder verificar si es un usuario registrado en la base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.
*/

require "usuario.php";
echo "Aplicación No 29( Login con bd)<br/>";

if(isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    $resultado = Usuario::ValidarUsuariobD($mail, $clave);

    if($resultado == 1){
        echo "Verificado";
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
