
<?php 


include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Estable conexion
$id=$_GET['id']; //Recupera la variable enviada
$sql="SELECT nombre_usuario,apellido_usuario,numero_doc FROM usuario  WHERE id_usuario=$id"  ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD

while($resultado=mysqli_fetch_array($consulta))
{
   
    echo $resultado[0].' '.$resultado[1].' '.$resultado[2].'<br>';

}

echo "fin";




?>
