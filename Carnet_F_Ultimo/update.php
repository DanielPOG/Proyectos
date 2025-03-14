<?php  

include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Establece conexion
$id=$_GET['id'];
$sql="SELECT * FROM usuario WHERE id_usuario='$id' " ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD
$consulta2=mysqli_fetch_array($consulta2);




echo '<form action="otro_post.php" method="post">'.

    '<label for="nombre" value="">Nombre De Usuario</label>'.'<br>'.
    '<input type="text" name="nombre" id="nombre" value=">'.'<br>'.

    '<label for="apellido">Apellido De Usuario</label>'.'<br>'.
    '<input type="text" name="apellido" id="apellido">'.'<br>'.

    '<label for="password">Password</label>'.'<br>'.
    '<input type="text" name="password" id="password">'.'<br>'.

    '<label for="documento">Documento</label>'.'<br>'.
    '<input type="text" name="documento" id="documento">'.'<br>'.

    '<label for="fecha">Fecha</label>'.'<br>'.
    '<input type="text" name="fecha" id="fecha">'.'<br>'.
    '<select name="" id="" class="form-select" aria-label="Selecione RH" name="rh">'.
    '<option select>Seleccione</option>'.
     $sql="SELECT * FROM rh WHERE '1' " ; //Consulta 
        $consulta=mysqli_query($link,$sql); //Envia consulta a BD



        while($resultado=mysqli_fetch_array($consulta))
        {
        
            echo '<option value="'.$resultado[0].'  " >'.$resultado[1].'</option>';
        
        }
        
       
        
    '</select>'.'<br>'.

        





'</form>';






echo "FIN";

?>