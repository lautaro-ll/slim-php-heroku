<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.


*******************************************************************************/
$num = rand(0,100);

if($num > 20 && $num < 60)
{
    $numString = (string)$num;
    
    for($i=0; $i<2; $i++)
    {
        switch($numString[$i])
        {
            case '1':
                $unidadTexto = "uno";
                break;
            case '2':
                if($i==0)
                    $decenaTexto = "veinte";
                $unidadTexto = "dos";
                break;
            case '3':
                if($i==0)
                    $decenaTexto = "treinta";
                $unidadTexto = "tres";
                break;
            case '4':
                if($i==0)
                    $decenaTexto = "cuarenta";
                $unidadTexto = "cuatro";
                break;
            case '5':
                if($i==0)
                    $decenaTexto = "cincuenta";
                $unidadTexto = "cinco";
                break;
            case '6':
                $unidadTexto = "seis";
                break;
            case '7':
                $unidadTexto = "siete";
                break;
            case '8':
                $unidadTexto = "ocho";
                break;
            case '9':
                $unidadTexto = "nueve";
                break;
        }
    }
    if($decenaTexto == "veinte")
        printf("veinti$unidadTexto");
    else    
        printf("$decenaTexto y $unidadTexto");
}
else
    printf("$num está fuera del rango de entre 20 y 60");
?>

