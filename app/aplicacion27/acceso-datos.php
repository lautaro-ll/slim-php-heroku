<?php

try 
{
    $conStr = 'mysql:host = localhost; dbname = pruebaDB';
    $pdo = new PDO($conStr, $user, $pass);
}
    catch(PDOException $e){
    echo "Error: " .$e->getMessage() . "<br/>";
}

class AccesoDatos 
{
    public function RetornarUltimoIdInsertado() 
    {
    return $this->objetoPDO->lastInsertId();
    }
}

?>