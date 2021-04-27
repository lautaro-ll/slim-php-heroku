<?php

class Helado
{
    public $sabor;
    public $precioBruto;
    public $tipo;
    public $stock;
    public $precioFinal;
    public $id;

    function nuevaHelado($sabor, $precioBruto, $tipo, $cantidad)
    {
        $this->sabor = $sabor;
        $this->precioBruto = $precioBruto;
        $this->tipo = $tipo;
        $this->stock = $cantidad;
        $this->precioFinal = $precioBruto * 1.21;
    }

    static function TraerProducto ($sabor, $tipo) 
    {    
        $listado = Helado::RetornarArrayJson();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["sabor"] == $sabor && $listado[$i]["tipo"] == $tipo)  
                {
                    return $listado[$i];
                }
            }
        }
        else {
            return NULL;
        }
    }

    static function AltaHeladoJson($producto) 
    {
        if(file_exists("helados.json") && Helado::VerificarSiExisteJson($producto->sabor, $producto->tipo))
        {
            if(Helado::ActualizarStockJson($producto->sabor, $producto->tipo, $producto->stock)) {
                return 1;
            }
            return 0;
        }
        else {
            if(Helado::AgregarProductoJson($producto)) {
                return 1;
            }
            return 0;
        }
    }

    static function VerificarSiExisteJson($sabor, $tipo) 
    {
        $haySabor=false;
        $hayTipo=false;
        $listado = Helado::RetornarArrayJson();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["sabor"] == $sabor && $listado[$i]["tipo"] == $tipo) 
                {
                    return 1;
                }
                if($listado[$i]["sabor"] == $sabor) {
                    $haySabor = true;
                }
                if($listado[$i]["tipo"] == $tipo) {
                    $hayTipo = true;
                }
                if($haySabor) {
                    return 2;
                }
                if($hayTipo) {
                    return 3;
                }
            }
        }
        return 0;
    }

    static function ActualizarStockJson($sabor, $tipo, $nuevoStock) 
    {    
        $listado = Helado::RetornarArrayJson();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["sabor"] == $sabor && $listado[$i]["tipo"] == $tipo) 
                {
                    $listado[$i]["stock"] = $nuevoStock;
                }
            }
            unlink("helados.json");
            for($i=0;$i<sizeof($listado);$i++) 
            {
                Helado::AgregarProductoJson($listado[$i]);
            }
            return 1;
        }
        else {
            return 0;
        }        
    }

    static function AgregarProductoJson($producto) 
    {
        $producto["id"] = rand(1,10000);
        if(!file_exists("helados.json") || is_writable("helados.json")) 
        {
            $archivo = fopen("helados.json", "a");
            fwrite($archivo, json_encode($producto)."\n");
            fclose($archivo);
            return 1;
        }
        else {
            return 0;
        }
    }

    static function RetornarArrayJson()
    {
        if(($archivo = fopen("helados.json","r")) !== FALSE) 
        {
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
}

?>