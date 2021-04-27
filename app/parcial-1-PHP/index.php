<?php
/*
A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a que archivo se debe incluir.
*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["peticion"])) 
{
    switch($_POST["peticion"])
    {
        case "HeladoConsultar":
            require("HeladoConsultar.php");
            break;
        case "AltaVenta":
            require("AltaVenta.php");
            break;
        default:
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["peticion"]))
{
    switch($_GET["peticion"])
    {
        case "HeladoCarga":
            require("HeladoCarga.php");
            break;
        case "ConsultaVentas":
            require("ConsultaVentas.php");
            break;
        default:
    }
}
else {
    echo "Error en la consulta. <br/>";
}

?>
