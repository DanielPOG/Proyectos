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
        include('bn3.php')
        ?>
    </header>
<?php 


$id=$_GET['id'];
$sql="SELECT * FROM centro WHERE id_tipo='$id' " ; //Consulta 
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
                            <form action="ctrlupdate_centro.php" method="post" > 
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $resultado2[1]; ?>">
                                            <select name= "tipo_centro" class="form-control">
                                            <option selected >Selecione</option>
                                            <?php
                                            $sql2="SELECT * FROM region " ;//Consulta sentencia SQL
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
                                        <div class="col d-none"> 
                                             <!--USUARIO DE ADMIN-->
                                            <input type="text" class="form-control " arial- id="user" name="user" value="<?php echo $user1;?>"readonly>
                                        </div>
                                        <div class="col d-none"> 
                                             <!--USUARIO DE CENTRO-->
                                            <input type="text" class="form-control " arial- id="id_centro" name="id_centro" value="<?php echo $resultado2[0];?>"readonly>
                                        </div>
                                       
                                    </div>
                                
                                </div>
                               
                                <button type="submit" class="btn btn-primary"  name="" id="">Registrar</button>
                            </form>
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