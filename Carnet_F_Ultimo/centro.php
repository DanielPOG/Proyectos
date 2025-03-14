
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
             include('bn3.php');



    







            $sql="SELECT * FROM centro WHERE 1 " ; //Consulta
            $consulta=mysqli_query($link,$sql); //Envia consulta a BD
            // $resultado=mysqli_fetch_array($consulta);
             ?>
            <!-- Fin de barra nav de daniel caicedo -->
        </header>
        <main>


            <div class="container mt-3">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-lg-2">
                       1
                    </div>
                    <div class="col-lg-8">
                            <!-- Inicio T1 -->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">E</th>
                                    <th scope="col">B</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                while($resultado=mysqli_fetch_array($consulta))
                                {
                                    


                                    $i+=1;
                                    echo "<tr>
                                            <th scope='row' >".$i."</th>
                                            <td>".$resultado[1]."</td>
        
                                            <td><a name='id' id=''  href=editar_centro.php?user=$resultado9[0]&id=$resultado[0] ><i class='fa fa-pencil '></i></a></td>
                                            <td><a href=delete_centro.php?user=$resultado9[0]&id=$resultado[0] ><img src='img/del.png' alt='alo'></a> </td>
                                        </tr>";

                                 }


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
                    <div class="col-lg-2">
                        3
                    </div>


                </div>

            </div>

             <!-- VENTANA MODAL AGREGAR CENTRO-->
                

            <div class="modal fade" id="centro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Centro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--INICIO FORMULARIO AGREGAR CENTRO -->
                            <form action="ctrlcreate_centro.php" method="post"> 
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" name="nombre" Required value=>
                                            
                                        </div>
                                        <div class="col">
                                            <label for="tipo_doc" class="form-label">Region</label>
                                            <select name= "tipo_centro" class="form-control">
                                            
                                                <option selected>Selecione</option>
                                                <?php   
                                                $sql="SELECT * FROM region  " ;//Consulta sentencia SQL
                                                $consulta=mysqli_query($link,$sql); //enviar consulta a BD
                                                while ($resultado=mysqli_fetch_array($consulta)){
                                                    echo '<option value="'.$resultado[0].' ">'.$resultado[1].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col d-none"> 
                                            <label for="user" class="form-label">USER</label> <!--USUARIO DE ADMIN-->
                                            <input type="number" class="form-control " arial- id="user" name="user" value="<?php  echo $user1;?>"readonly>
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
             <!-- FIN VENTANA AGREGAR CENTRO-->
           
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
