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
    public $arrayUsuario = array("nombre"=>null,"clave"=>null,"mail"=>null);
    /*
    public $nombre;
    public $clave;
    public $mail;
    */
    static function _validarUsuario(Usuario $usuario) 
    {
        if(isset($usuario->arrayUsuario["nombre"]) && isset($usuario->arrayUsuario["clave"])  && isset($usuario->arrayUsuario["mail"]))
        {      
            $archivoUsuarios = fopen("usuarios.csv", "a");
            fwrite($archivoUsuarios, "\n".implode(",",$usuario->arrayUsuario));
            //fwrite($archivoUsuarios, "$usuario->nombre, $usuario->clave, $usuario->mail \n");
            fclose($archivoUsuarios);  
        }
        else{
            echo "Faltan datos.";
        }
    }
}

$nuevoUsuario = new Usuario();
$nuevoUsuario->arrayUsuario["nombre"] = $_POST["nombre"];
$nuevoUsuario->arrayUsuario["clave"] = $_POST["clave"];
$nuevoUsuario->arrayUsuario["mail"] = $_POST["mail"];

echo Usuario::_validarUsuario($nuevoUsuario);

?>