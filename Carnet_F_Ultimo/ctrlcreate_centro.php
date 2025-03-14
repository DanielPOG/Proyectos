
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion

$nombre=$_POST['nombre']; //Recupera la variable enviada
$centro=$_POST['tipo_centro'];
$user=$_POST['user'];


$sql = "INSERT INTO centro (nombre_tipo, id_region_FK) VALUES ('$nombre', '$centro')";//Consulta 
$consulta= mysqli_query($link,$sql); //Envia consulta a BD



header("location:centro.php?user=".$user);




?>


