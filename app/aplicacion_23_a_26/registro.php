<?php
/*
LEMOS LAUTARO LUCAS

Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario (nombre, clave,mail) por POST,
crea un ID autoincremental (emulado, puede ser un random de 1 a 10.000).
crear un dato con la fecha de registro , toma todos los datos y 
utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/. retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.
*/
include "Usuario.php";

if(isset($_POST["nombre"]) && isset($_POST["clave"]) && isset($_POST["mail"]) && isset($_FILES["archivo"]))
{
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $archivo = $_FILES["archivo"];
    $id = rand(1,10000);
    $fechaDeRegistro = date("d.m.Y");
    $nuevoIngresado = new Usuario($nombre, $clave, $mail, $id, $fechaDeRegistro, $archivo);

    if($nuevoIngresado->GuardarEnJSON()) 
    {
        echo "Se pudo agregar usuario. <br/>";
    }
    else 
    {
        echo "No se pudo agregar usuario. <br/>";
    }

    if($nuevoIngresado->GuardarArchivo($archivo)) 
    {
        echo "El archivo ha sido subido exitosamente. <br/>";
    }
    else 
    {
        echo "El archivo no pudo ser subido. <br/>";
    }

} 
else
{
    echo "No se ingresó usuario. <br/>";
}


?>
