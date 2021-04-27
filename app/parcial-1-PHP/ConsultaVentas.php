<?php

/*
4- (3 pts.)ConsultasVentas.php: necesito saber:
a- la cantidad de helados vendidos
SELECT SUM(cantidad) FROM `ventas`;
b- el listado de los usuarios que realizaron compras entre dos fechas.
SELECT mail FROM `ventas` WHERE fecha_de_venta BETWEEN "2020-01-01" AND "2021-01-01";
c- el listado de ventas de un usuario ingresado
SELECT * FROM `ventas` WHERE mail="asdasd@%";
d- el listado de ventas de un tipo ingresado
SELECT * FROM `ventas` WHERE tipo="";

*/

require "Helado.php";
require "Venta.php";

if(isset($_GET["consulta"]))
{
    $consulta = $_GET["consulta"];
    switch($consulta)
    {
        case "TotalVendidos":
            echo "Cantidad de helados vendidos: ".Ventas::obtenerTotalVendidos();
            break;
        case "ComprasEntreFechas":
            if(isset($_GET["fechaUno"]) && isset($_GET["fechaDos"])) 
            {
                $fechaUno = $_GET["fechaUno"];
                $fechaDos = $_GET["fechaDos"];
                $array = Ventas::obtenerComprasEntreFechas($fechaUno,$fechaDos);
                Ventas::DibujarListado($array);
            }
            else {
                echo "Error en los parámetros ingresados. <br/>";
            }
            break;
        case "VentasPorUsuario":
            if(isset($_GET["usuario"]))
            {
            $usuario = $_GET["usuario"];
            $array = Ventas::obtenerVentasPorUsuario($usuario);
            Ventas::DibujarListado($array);
            }
            else {
                echo "Error en los parámetros ingresados. <br/>";
            }
            break;
        case "VentasPorTipo":
            if(isset($_GET["tipo"]))
            {
                $tipo = $_GET["tipo"];
                $array = Ventas::obtenerVentasPorTipo($tipo);
                Ventas::DibujarListado($array);
            }
            else {
                echo "Error en los parámetros ingresados. <br/>";
            }
            break;
        default:
            echo "Consulta incorrecta. <br/>";
            break;
    }
}
else
{
    echo "No se ingresó consulta. <br/>";
}


?>
