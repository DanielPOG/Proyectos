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
    <header>
        <?php 
        include('bn2.php')
        ?>
    </header>
<?php 


$user=$_GET['id'];

$sql="SELECT * FROM usuario WHERE id_usuario='$user' " ; //Consulta 
$consulta=mysqli_query($link,$sql); //Envia consulta a BD


$resultado2=mysqli_fetch_array($consulta); //LOS RECUPERA





?>
<div class="container mt-3">
                <div
                    class="row justify-content-center align-items-center g-2"
                >

                <div class="col-3">
                        1
                </div>
                <div class="col-6 ">
                    
                        <div class="card" style="padding:3%">
                            <form action="ctrlupdate_principal.php" method="post" > 
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nombre" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="Nombre" name="nombre" value="<?php echo $resultado2[1] ?>">
                                        </div>
                                        <div class="col">
                                            <label for="apellido" class="form-label">apellido</label>
                                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $resultado2[2] ?>">
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $resultado2[5] ?>">
                                        </div>
                                        <div class="col">
                                            <label for="documento" class="form-label">Documento</label>
                                            <input type="number" class="form-control" arial- id="documento" name="documento" value="<?php echo $resultado2[4] ?>"readonly>
                                        </div>
                                        <div class="col d-none"> 
                                             <!--USUARIO DE ADMIN-->
                                            <input type="text" class="form-control " arial- id="user" name="user" value="<?php echo $id;?>"readonly>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3">
                                <div class="row">
                                        <div class="col">
                                            <label for="documento" class="form-label">Tipo Documento</label>
                                            <select name= "tipo_doc" class="form-control">
                                            <option selected >Selecione</option>
                                            <?php
                                            $sql2="SELECT * FROM tipo_doc " ;//Consulta sentencia SQL
                                            $consulta2=mysqli_query($link,$sql2); //enviar consulta a BD
                                            while ($resultado3=mysqli_fetch_array($consulta2)){
                                                if ($resultado2[3]==$resultado3[0]){
                                                    $seleccionado="selected";
                                                }
                                                else{
                                                    $seleccionado="";
                                                }
                                                echo '<option '.$seleccionado.' value="'.$resultado3[0].' ">'.$resultado3[1].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="documento" class="form-label">RH</label>
                                            <select name= "rh" class="form-control">
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

                                </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="documento" class="form-label">Rol</label>
                                            <select name= "rol" class="form-control">
                                            <option selected >Selecione</option>
                                            <?php
                                            $sql4="SELECT * FROM rol " ;//Consulta sentencia SQL
                                            $consulta4=mysqli_query($link,$sql4); //enviar consulta a BD
                                            while ($resultado5=mysqli_fetch_array($consulta4)){
                                                if ($resultado2[6]==$resultado5[0]){
                                                    $seleccionado="selected";
                                                }
                                                else{
                                                    $seleccionado="";
                                                }
                                                echo '<option '.$seleccionado.' value="'.$resultado5[0].' ">'.$resultado5[1].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="" class="form-label">Ficha</label>
                                            <input type="number" class="form-control" arial- id="" name="" value="2971602"readonly>
                                        </div>


                                    </div>
                                    
                                </div>
                            
                                <div class="mb-3">
                                    <div class="row">
                                            <div class="col">
                                                <label for="fecha" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $resultado2['fechavencimiento'];?>">
                                            </div>
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary"  name="" id="">Registrar</button>
                        </div>
                

                    
                </div>
                <div class="col-3">
                        3
                </div>
                
               
                
                
</body>
<footer>
<?php
           include("footer1.php");


           ?>
</footer>
</html>