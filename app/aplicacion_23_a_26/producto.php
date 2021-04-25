<?php

class Producto
{
    public $numeroSerie;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $id;

    function __construct($numeroSerie, $nombre, $tipo, $stock, $precio, $id)
    {
        $this->numeroSerie = $numeroSerie;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->id = $id;
    }

    static function DarDeAlta($producto) {
        if(file_exists("productos.json") && Producto::VerificarSiExiste($producto))
        {
            if(Producto::AumentarStock($producto)) {
                return 1;
            }
            return 0;
        }
        else {
            if(Producto::AgregarProducto($producto)) {
                return 1;
            }
            return 0;
        }
    }
    static function VerificarSiExiste($numeroSerie) {
        $listado = Producto::RetornarArrayDelJSON();

        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["numeroSerie"] == $numeroSerie) 
                {
                    return 1;
                }
            }
        }
        return 0;
    }
    static function AumentarStock($numeroSerie) {
        
        $listado = Producto::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["numeroSerie"] == $numeroSerie) 
                {
                    $listado[$i]["stock"]++;
                }
            }
            unlink("productos.json");
            for($i=0;$i<sizeof($listado);$i++) 
            {
                Producto::AgregarProducto($listado[$i]);
            }
            return 1;
        }
        else {
            return 0;
        }        
    }
    static function AgregarProducto($producto) {

        if(!file_exists("productos.json") || is_writable("productos.json")) 
        {
            $archivo = fopen("productos.json", "a");
            fwrite($archivo, json_encode($producto)."\n");
            fclose($archivo);
            return 1;
        }
        else {
            return 0;
        }
    }
    static function RetornarArrayDelJSON()
    {
        if(($archivo = fopen("productos.json","r")) !== FALSE) {

            $i = 0;
            while(!feof($archivo))
            {
                $jsonObj = fgets($archivo);
                $producto = json_decode($jsonObj,true);
                if($producto != NULL)
                    $listado[$i] = $producto;
                $i++;                      
            }
            fclose($archivo);
            return $listado;
        }
        else {
            return null;
        }
    }
    static function TraerProducto($numeroSerie) {
        
        $listado = Producto::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["numeroSerie"] == $numeroSerie) 
                {
                    return $listado[$i];
                }
            }
        }
        else {
            return NULL;
        }
        
    }

    static function DisminuirStock($numeroSerie) {
        
        $listado = Producto::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["numeroSerie"] == $numeroSerie) 
                {
                    $listado[$i]["stock"]--;
                }
            }
            unlink("productos.json");
            for($i=0;$i<sizeof($listado);$i++) 
            {
                Producto::AgregarProducto($listado[$i]);
            }
            return 1;
        }
        else {
            return 0;
        }        
    }
}

?>
