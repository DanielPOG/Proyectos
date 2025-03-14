
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion

$nombre=$_POST['nombre']; //Recupera la variable enviada
$apellido=$_POST['apellido']; //Recupera la variable enviada
$password=$_POST['password']; //Recupera la variable enviada
$documento=$_POST['documento']; //Recupera la variable enviada
$fecha=$_POST['fecha']; //Recupera la variable enviada
$rh=$_POST['rh'];
$tipo_doc=$_POST['tipo_doc'];
$rol=$_POST['rol'];

$user=$_POST['user'];

$sql="UPDATE usuario SET nombre_usuario = '$nombre', apellido_usuario = '$apellido', password = '$password', numero_doc = '$documento', id_rh_FK = '$rh' , id_tipo_doc_FK='$tipo_doc' , id_rol_FK='$rol' WHERE numero_doc = $documento";


// $sql = "INSERT INTO usuario (nombre_usuario,apellido_usuario,numero_doc,password,id_rh_FK,fechavencimiento) VALUES ('$nombre', '$apellido', '$documento', '$password','$rh','$fecha')";//Consulta 
$consulta= mysqli_query($link,$sql); //Envia consulta a BD

echo $user;

header("location:principal.php?user=".$user);

 echo "FIN";


?>


