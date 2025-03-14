
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion

$nombre=$_POST['nombre']; //Recupera la variable enviada
$user=$_POST['user'];
$id_centro=$_POST['id_centro'];
$centro=$_POST['tipo_centro'];


$sql="UPDATE centro SET nombre_tipo = '$nombre' , id_region_FK='$centro' WHERE id_tipo ='$id_centro'";


// $sql = "INSERT INTO usuario (nombre_usuario,apellido_usuario,numero_doc,password,id_rh_FK,fechavencimiento) VALUES ('$nombre', '$apellido', '$documento', '$password','$rh','$fecha')";//Consulta 
$consulta= mysqli_query($link,$sql); //Envia consulta a BD

echo $user;

header("location:centro.php?user=".$user);

 echo "FIN";


?>


