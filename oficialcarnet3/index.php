
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Sena.com</title>
    <!-- ICONO TITTLE -->
    <link rel="icon" href="herramientas/img/logo.webp" type="image/x-icon">
    <!-- FIN ICONO TITTLE -->

    <!-- LIBERIAS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- FIN LIBERIAS BOOTSTRAP -->

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- FIN ICONOS -->
    
    <!-- CSS Pagina login -->
    <link rel="stylesheet" href="herramientas/css/index.css">
    <!-- FIN CSS Pagina login-->


    <!-- LIBRERIAS COD ANTERIOR -->
    <link   rel='stylesheet' href='herramientas/dist/css/adminlte.min.css'>
    <script src='https://code.jquery.com/jquery-3.7.0.js' ></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
	<link   rel='stylesheet' href='herramientas/plugins/fontawesome-free/css/all.min.css'>
	<link   rel='stylesheet' href='herramientas/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
	<link   rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
	<link   rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' >
	<link 	rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"> //POSIBLE SCRIPT QUE DAÑE EL CODE
    </script>
    <script src='herramientas/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
	<script src='herramientas/dist/js/adminlte.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src='herramientas/js/index.js'></script>     <!-- Propio pa index-->
    <script src='herramientas/js/cod.js'></script>     <!-- Propio pa index-->
    <!-- FIN LIBRERIAS -->  
     <script src="herramientas/js/index.js" > </script>
     
</head>
<body>
    <?php   
    include_once('archivo/vista/modalesindex.php');
    ?>
    <!-- Inicio Cuerpo LOGIN -->
    <section class="gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="herramientas/img/logo.webp" style="width: 70px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Carnetizacion Sena</h4>
                                    </div>
                                    <form>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="correo1">Correo</label>
                                            <input type="email" id="correo1" name="correo1" class="form-control" placeholder="Correo Sena" />
                                        </div>
                                        <div class="text-center pt-1 mb-5 ">
                                            <button class="btn btn-block" style="background-color:  #64c71e" type="button" id="btnCodigo" name="btnCodigo">Entrar</button>
                                            <br>
                                            <a class="text-muted" href="#!">Olvidaste tu clave?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <div class="text-white px-3 py-4 p-md-1">
                                        <h4 class="mb-4">Somos SENA</h4>
                                        <p class="fs-6">
                                            En el SENA, creemos que la educación es la llave que abre las puertas del futuro. Nuestro propósito es guiar a cada aprendiz en su camino hacia el éxito, brindándole las herramientas necesarias para que puedan alcanzar sus metas y realizar sus sueños.
                                            <br><br>
                                            Juntos, somos agentes de cambio en nuestras comunidades, impulsando el desarrollo y la innovación en cada rincón de Colombia.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fin Cuerpo LOGIN -->
</body>
</html>