<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        /> 
</head>
<body>
<?php 


include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Establece conexion
$id=$_GET['id'];
$sql="SELECT * FROM usuario WHERE id_usuario='$id' " ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD


$resultado2=mysqli_fetch_array($consulta); //LOS RECUPERA





?>
<div class="container mt-3">
                <div
                    class="row justify-content-center align-items-center g-2"
                >
                <form action="ctrlupdate.php" method="post" > 
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="nombre" value="<?php echo $resultado2[1] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $resultado2[2] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $resultado2[5] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="number" class="form-control" arial- id="documento" name="documento" value="<?php echo $resultado2[4] ?>"readonly>
                        
                    </div>
                    <div class="mb-3">
                        <select name= "rh">
                        <option selected >Selecione</option>
                        <?php
                        $sql="SELECT * FROM rh " ;//Consulta sentencia SQL
                        $consulta=mysqli_query($link,$sql); //enviar consulta a BD
                        while ($resultado=mysqli_fetch_array($consulta)){
                            if ($resultado2[7]==$resultado[0]){
                                $seleccionado="selected";
                            }
                            else{
                                $seleccionado="";
                            }
                            echo '<option '.$seleccionado.' value="'.$resultado[0].' ">'.$resultado[1].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha">
                    </div>
                    <button type="submit" class="btn btn-primary" >Registrar</button>
                
</body>
</html>