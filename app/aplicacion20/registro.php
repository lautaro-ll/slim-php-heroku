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

//include "usuario.php";
class Usuario
{
    public $nombre;
    public $clave;
    public $mail;

    static function _validarUsuario(Usuario $usuario) 
    {
        if(isset($usuario->nombre) && isset($usuario->clave)  && isset($usuario->mail))
        {      
            $archivoUsuarios = fopen("usuarios.csv", "a");
            fwrite($archivoUsuarios, "$usuario->nombre, $usuario->clave, $usuario->mail \n");
            fclose($archivoUsuarios);  
        }
        else{
            echo "Faltan datos.";
        }
    }
}

$nuevoUsuario = new Usuario();
$nuevoUsuario->nombre = $_POST["nombre"];
$nuevoUsuario->clave = $_POST["clave"];
$nuevoUsuario->mail = $_POST["mail"];

echo Usuario::_validarUsuario($nuevoUsuario);

?>