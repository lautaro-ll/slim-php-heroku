<?php

/*
Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario
*/
require "usuario.php";

echo "Aplicación No 20 (Registro CSV)<br/>";

if(isset($_POST["usuario"]))
{
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    $nuevoUsuario = new Usuario($nombre, $clave, $mail);

    if($nuevoUsuario->GuardarEnCSV()) {
        echo "Se pudo agregar usuario <br/>";
    }
    else {
        echo "No se pudo agregar usuario <br/>";
    }
}

?>