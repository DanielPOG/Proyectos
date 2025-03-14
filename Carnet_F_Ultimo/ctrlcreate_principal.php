
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion

$nombre=$_POST['nombre']; //Recupera la variable enviada
$apellido=$_POST['apellido']; //Recupera la variable enviada
$password=$_POST['password']; //Recupera la variable enviada
$documento=$_POST['documento']; //Recupera la variable enviada
$tipo_doc=$_POST['tipo_doc'];
$fecha=$_POST['fecha']; //Recupera la variable enviada
$rh=$_POST['rh'];
$rol=$_POST['rol'];
$ficha=$_POST['ficha'];
$fecha=$_POST['fecha'];


$archivo=$_FILES['foto'];
$tmparchivo=$archivo['tmp_name'];
$nombrefoto=$archivo['name'];
$tipofoto=$archivo['type']; 
//var_dump($_FILES);

$ruta='foto/'.$documento.'/';

$user=$_POST['user'];

$sql2="SELECT * FROM usuario WHERE numero_doc='$documento'";
$consulta2= mysqli_query($link,$sql2); //Envia consulta a BD
if ($resultado2=mysqli_fetch_array($consulta2)){
    header("location:index.php?key=3");
}
else{
    if(is_dir($ruta)){
        move_uploaded_file($tmparchivo,$ruta.$nombrefoto);
    }
    else{
        mkdir($ruta,0777);
        move_uploaded_file($tmparchivo,$ruta.$nombrefoto);
    }

    $sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, id_tipo_doc_FK, numero_doc, password, id_rol_FK,id_rh_FK,cod_fichas,fechavencimiento, foto) 
    VALUES ('$nombre', '$apellido', '$tipo_doc','$documento', '$password','$rol','$rh','$ficha','$fecha','$nombrefoto')";//Consulta 
    $consulta= mysqli_query($link,$sql); //Envia consulta a BD
    
    // $sql1="SELECT * FROM usuario ";
    // $prueba=mysqli_query($link,$sql1);
    // while($resultado=mysqli_fetch_array($prueba))
    // {
    // echo "Se registro correctamente el usuario: ". $resultado[0]. "<br>";
    
    
    // }
    header("location:principal.php?user=".$user);
}




?>


