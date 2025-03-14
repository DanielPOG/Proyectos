
<!doctype html>
<html lang="en">
    <head>
        <title>Plantilla</title></title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Libreria de icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>


        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

    </head>

    <body>
        <header>
            <!-- Barra de nav daniel -->
             <?php
             include('bn2.php');


            $sql="SELECT * FROM usuario WHERE 1 " ; //Consulta
            $consulta=mysqli_query($link,$sql); //Envia consulta a BD
            $resultado=mysqli_fetch_array($consulta);
             ?>
            <!-- Fin de barra nav de daniel caicedo -->
        </header>
        <main>


            <div class="container mt-3">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-lg-4">
                       <div class="container mt-3">
                            <div class="col-2 fixed-top mt-5">
                                <a type="button" class="btn btn-light" width="50px" data-bs-toggle="modal" data-bs-target="#paquetes" href=""><img src="img/per.jpeg" alt=""></a>
                                <div class="m-1">
                                    <form action="ctrlcreate_lote.php" enctype="multipart/form-data" method="post">
                                        <label for="lote">Lote</label>
                                        <input type="file" name="lote" id="lote" >
                                        <input type="hidden" value="<?php echo $resultado9[0]?>" name="user">
                                        <button type="submit">PEPE</button>


                                    </form>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="col-lg-7">
                            <!-- Inicio T1 -->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Tipo Documento</th>
                                    <th scope="col" >Numero Documento</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">RH</th>
                                    <th scope="col">E</th>
                                    <th scope="col">B</th>
                                    <th scope="col">C</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                while($resultado=mysqli_fetch_array($consulta))
                                {
                                    //PARA TIPO DOC
                                    $sql2="SELECT * FROM tipo_doc WHERE id_tipo_doc='$resultado[3] ' " ; //Consulta
                                    $consulta2=mysqli_query($link,$sql2); //Envia consulta a BD
                                    $resultado2=mysqli_fetch_array($consulta2);

                                    //PARA ROL
                                    $sql3="SELECT * FROM rol WHERE id_rol='$resultado[6] ' " ; //Consulta
                                    $consulta3=mysqli_query($link,$sql3); //Envia consulta a BD
                                    $resultado3=mysqli_fetch_array($consulta3);
                                    //PARA RH
                                    $sql4="SELECT * FROM rh WHERE id_rh='$resultado[7] ' " ; //Consulta
                                    $consulta4=mysqli_query($link,$sql4); //Envia consulta a BD
                                    $resultado4=mysqli_fetch_array($consulta4);



                                    $i+=1;
                                    echo' 
                                                <tr>
                                                <th scope="row">'.$i.'</th>
                                                <td >'.$resultado[1].'</td>
                                                <td>'.$resultado[2].'</td>
                                                <td>'.$resultado2[1].'</td>
                                                <td>'.$resultado[4].'</td>
                                                <td>'.$resultado3[1].'</td>
                                                <td>'.$resultado4[1].'</td>
                                                <td><a href="editar_principal.php?user='.$resultado9[0].'&&id='.$resultado[0].'"><i class="fa fa-pencil" style="color:black"></i></a></td>
                                                <td><a href="delete.php?user='.$resultado9[0].' &&id='.$resultado[0].'" onclick="if(!confirm('."'Va Borrar un usuario!'".'))return false">'.'<i class="fa fa-minus-circle fa-spin" style="color:black"></i></a></td>
                                                <td><a href="carnet.php?user='.$resultado9[0].' &&id='.$resultado[0].'" >'.'<i class="fa fa-address-card-o" style="color:black"></i></a></td>
                                                
                                                </tr>
                                            ';
                               

                                 }
                                // .'" onclick="if(!confirm('."'Va borrar un usuario!'".'))return false">'.'

                                ?>

                                <!-- <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr> -->

                            </tbody>

                        </table>
                            <!-- Fin T1 -->




                    </div>
                    <div class="col-lg-1">
                        3
                    </div>


                </div>

            </div>

             <!-- VENTANA MODAL EDITAR -->
                

            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                      
                            // $sql5="SELECT * FROM usuario WHERE id_usuario='$id' " ; //Consulta
                            // $consult5a=mysqli_query($link,$sql5); //Envia consulta a BD
                            // $resultado5=mysqli_fetch_array($consulta5);

                            ?>
                            <!--INICIO FORMULARIO EDITAR  -->
                            <form action=".php" method="post"> <!--FALTA EL ACTION-->
                                <div class="mb-3 ">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" name="nombre" Required value="<?php // echo $resultado5[1];?>">
                                        <div id="emailHelp" class="form-text">El usuario debe haber sido creado</div>
                                </div>
                                <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" Required name="apellido">
                                </div>
                                <div class="mb-3">
                                    <label for="clave" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="clave" Required name="clave">
                                </div>
                                <div class="mb-3">
                                    <label for="documento" class="form-label">Documento</label>
                                    <input type="text" class="form-control" id="documento" Required name="documento">
                                </div>
                                <div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>

                        </div>



                        <!--FIN FORMULARIO DE EDITAR  -->
                    </div>
                </div>
            </div>
             <!-- FIN VENTANA MODAL 1 -->




             <!-- VENTANA MODAL AGREGAR -->
                

            <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--INICIO FORMULARIO AGREGAR  -->
                            <form action="ctrlcreate2_principal.php" method="post" enctype="Multipart/form-data"> 
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nombre" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" name="nombre" Required value=>
                                            <div id="emailHelp" class="form-text">El usuario debe haber sido creado</div>
                                        </div>
                                        <div class="col">
                                        <label for="apellido" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="apellido" Required name="apellido">
                                        </div>
                                    </div>
                             
                                </div>
                                 
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="clave" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="clave" Required name="clave">
                                        </div>
                                        <div class="col">
                                            <label for="documento" class="form-label">Documento</label>
                                            <input type="text" class="form-control" id="documento" Required name="documento">
                                        </div>
                                    </div>
                           
                                </div>
        
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tipo_doc" class="form-label">Tipo Documento</label>
                                            <select name= "tipo_doc" class="form-control">
                                            
                                                <option selected>Selecione</option>
                                                <?php   
                                                $sql="SELECT * FROM tipo_doc  " ;//Consulta sentencia SQL
                                                $consulta=mysqli_query($link,$sql); //enviar consulta a BD
                                                while ($resultado=mysqli_fetch_array($consulta)){
                                                    echo '<option value="'.$resultado[0].' ">'.$resultado[1].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="" class="form-label">RH</label>
                                            <select name= "rh" class="form-control">
                                            
                                                <option selected>Selecione</option>
                                                <?php   
                                                $sql="SELECT * FROM rh " ;//Consulta sentencia SQL
                                                $consulta=mysqli_query($link,$sql); //enviar consulta a BD
                                                while ($resultado=mysqli_fetch_array($consulta)){
                                                    echo '<option value="'.$resultado[0].' ">'.$resultado[1].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    

                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">ROL</label>
                                            <select name= "rol" class="form-control">
                                            
                                                <option selected>Selecione</option>
                                                <?php   
                                                $sql="SELECT * FROM rol " ;//Consulta sentencia SQL
                                                $consulta=mysqli_query($link,$sql); //enviar consulta a BD
                                                while ($resultado=mysqli_fetch_array($consulta)){
                                                    echo '<option value="'.$resultado[0].' ">'.$resultado[1].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="ficha" class="form-label">Ficha</label>
                                            <input type="text" class="form-control" id="ficha" Required name="ficha">
                                        </div>

                                    </div>

                                </div>
                                <!-- PARA AGREGAR FOTOS -->
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="fecha" class="form-label">Fechas</label>
                                            <input type="date" class="form-control" id="fecha" Required name="fecha">
                                        </div>
                                        <div class="row justify-content-center align-items-center g-2 mb-3">
                                            <div class="col">
                                                <label for="formFile" class="form-label">FOTO</label>
                                                <input class="form-control" type="file"     accept="image/*" id="formFile" name="foto">
                                            </div>
                                        </div>
                                        <div class="col d-none"> 
                                            <label for="user" class="form-label">USER</label> <!--USUARIO DE ADMIN-->
                                            <input type="number" class="form-control " arial- id="user" name="user" value="<?php  echo $id;?>"readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="modal-footer">
                                
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>

                        </div>


                    </div>
                </div>
            </div>
             <!-- FIN VENTANA AGREGAR-->
           
        </main>
        <footer >
           <?php
           include("footer1.php");


           ?>
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
