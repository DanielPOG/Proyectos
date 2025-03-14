<?php  

include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Estable conexion
$id=$_GET['id'];
$user=$_GET['user'];


$sql="DELETE FROM centro WHERE id_tipo='$id' " ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD

header("location:centro.php?user=$user");
?>