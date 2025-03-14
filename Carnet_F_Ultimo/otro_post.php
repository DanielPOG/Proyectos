
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion

$nombre=$_POST['nombre']; //Recupera la variable enviada
$apellido=$_POST['apellido']; //Recupera la variable enviada
$password=$_POST['password']; //Recupera la variable enviada
$documento=$_POST['documento']; //Recupera la variable enviada
$fecha=$_POST['fecha']; //Recupera la variable enviada
$rh=$_POST['rh'];


$sql = "INSERT INTO usuario (nombre_usuario,apellido_usuario,numero_doc,password,id_rh_FK,fechavencimiento) VALUES ('$nombre', '$apellido', '$documento', '$password','$rh','$fecha')";//Consulta 
$consulta= mysqli_query($link,$sql); //Envia consulta a BD

    
$sql1="SELECT * FROM usuario ";
$prueba=mysqli_query($link,$sql1);
while($resultado=mysqli_fetch_array($prueba))
{
echo "Se registro correctamente el usuario: ". $resultado[0]. "<br>";


}
header("location:principal.php?user=14");


?>


