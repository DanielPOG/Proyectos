<?php  

include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Estable conexion
$sql="SELECT nombre_usuario, id_usuario, numero_doc, apellido_usuario FROM usuario WHERE 1 " ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD
while($resultado=mysqli_fetch_array($consulta))
{
  
   echo $resultado[0].'<a href="update2.php?id='.$resultado[1].'">'.$resultado[2]. "</a> - ".$resultado[3]."<a  href='delete.php?id=".$resultado[1]."'>"."<img src='img/img2.png'>"."</a>". "<br>";
   
//    echo '<form action="otro.php" method="get">'.'<a href="otro.php?id='.$resultado[1].'">'.$resultado[0].'</a>'.'<br>'.'</form>';

}
echo "FIN";

?>
