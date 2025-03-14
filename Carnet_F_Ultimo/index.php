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
             include('bn1.php');
             ?>
            <!-- Fin de barra nav de daniel caicedo -->
        </header>
        <main>
            <!-- VENTANA MODAL 1 -->

            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--INICIO FORMULARIO INGRESO  -->
                            <form action="log.php" method="post">
                                <div class="mb-3">
                                    <label for="documento" class="form-label">Documento</label>
                                    <input type="text" class="form-control" id="documento" aria-describedby="emailHelp" name="documento" Required>
                                    <div id="emailHelp" class="form-text">El usuario debe haber sido creado</div>
                                </div>
                                <div class="mb-3">
                                    <label for="clave" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="clave" Required name="clave">
                                </div>
                               
                                <div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                            
                        </div>
                        
                    
                       
                        <!--FIN FORMULARIO INGRESO  -->
                    </div>
                </div>
            </div>
             <!-- FIN VENTANA MODAL 1 -->
            <div class="container mt-3">   
                <div class="row justify-content-center align-items-center g-2">
                    <?php 
                    if (isset($_GET['key'])){
                        $key=$_GET['key'];
                        switch($key){
                            case 1:
                               
                                

                                
                                
                               break;
                            

                            case 2:
                                
                                // echo '<script language="javascript" >alert("pepe");</script>'  ;
                                echo "<h2 style='color: red'>ACCESO DENEGADO</h2>";
                                break;

                            case 3:
                                echo "<h2 style='color: blue'>USUARIO CON EL MISMO DOCUMENTO</h2>";

                            default:
                                $mensaje="";
                                
                                break;
                        }
                        
                    }



                    ?>
                    s
                    
                    <div class="col" >PEPE</div>
                    <div class="col">PEPE2</div>
                    <div class="col">PEPE3</div>

                </div>
                
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
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
