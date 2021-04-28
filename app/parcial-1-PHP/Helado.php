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
    static function EliminarFoto($nro_pedido) 
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT tipo,sabor FROM ventas WHERE `nro_pedido`=:nro_pedido");
        $consulta->bindValue(':nombre',$nro_pedido, PDO::PARAM_INT);
        $consulta->execute();
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        move_uploaded_file("ImagenesDeHelados/".$array["tipo"]."-".$array["sabor"].".jpg","BACKUPVENTAS/");

    }
    static function BorrarVentaEnBd($nro_pedido) 
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM ventas WHERE `nro_pedido`=:nro_pedido");
        $consulta->bindValue(':nombre',$nro_pedido, PDO::PARAM_INT);
        return $consulta->execute();
    }
    static function RetornarHelados ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from ventas");
        $consulta->execute();			
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        return $array;
    }
    static function ValidarHeladoEnBd($nro_pedido) 
    {
        if($nro_pedido!=NULL)
        {
            $array = Helado::RetornarHelados();
            
            if(!is_null($array)) 
            {
                foreach($array as $producto)
                {
                    if($producto->nro_pedido == $nro_pedido)
                    {
                        return 1;
                    }
                }
                return -1;
            }
        }
        return 0;
    }

    function GuardarArchivo ($archivo)
    {
        $destino = "ImagenesDeHelados/";
        $ext = pathinfo($archivo["name"], PATHINFO_EXTENSION);

        if (!file_exists($destino)) 
        {
            mkdir($destino,0777,true);
        }

        if (move_uploaded_file($archivo["tmp_name"], $destino.$this->tipo."-".$this->sabor.".".$ext)) 
        {   
            return 1;
        } 
        else 
        {
            return 0;
        }
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