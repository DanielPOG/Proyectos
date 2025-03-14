<?php  

include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Estable conexion
$id=$_GET['id'];
$user=$_GET['user'];

$sql="DELETE FROM usuario WHERE id_usuario='$id' " ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD

header("location:principal.php?user=$user");
?>