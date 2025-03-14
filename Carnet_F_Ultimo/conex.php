<?php
function conexion(){

    $servidor='localhost';
    $basedatos='carnetizacion.db';
    $usuario='root';
    $password='';
    $link=mysqli_connect($servidor,$usuario,$password,$basedatos);

    if(!$link)
    {
        die ("No hay conexion:". mysqli_connect_error());
    }
    else
    {
        return $link;
    };
}

// $link=conexion();

?>