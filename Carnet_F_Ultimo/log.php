
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion
$documento=$_POST['documento']; //Recupera la variable enviada
$clave=$_POST['clave']; //Recupera la variable enviada


$sql="SELECT * FROM usuario WHERE numero_doc='$documento' AND password='$clave' AND id_rol_FK=7" ; //Consulta 
$consulta= mysqli_query($link,$sql); //Envia consulta a BD

$resultado=mysqli_fetch_array($consulta);


if(isset($resultado)){

    header("location:principal.php?user=$resultado[0]");
} 
else{
header("location:index.php?key=2");
}




// header("location:index.php");


?>