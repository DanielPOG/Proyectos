<?php
include('../../include/config.php');
session_name($session_name);
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnetización SENA</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="../../menub/css/styles.css">
    <link rel="stylesheet" href="../../herramientas/fonts/fontawesome-free-6.1.2-web/css/all.min.css">

    <script src='https://code.jquery.com/jquery-3.7.0.js' ></script>
    <script src="../../herramientas/js/listar.js"></script>

</head>
<?php
include_once('modalesadmin/modalesA.php');
?>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../menub/admin-nuevo.php">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center" style="background-color: gray;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 mx-auto">

                    <div class="input-group">
                        <input class="form-control border-end-0 border rounded-pill" type="search" placeholder="Buscar" id="buscar_ficha" name="buscar_ficha">
                        <span class="input-group-append">
                        <button id="btn_buscar" name="btn_buscar" class="btn btn-outline-secondary bg-danger border-bottom-0 border rounded-pill ms-n5" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                    </div>
                </div>

            </div>
            <div class="row justify-content-center">
                <table class="table table-striped">

                    <tbody id="cuerpo_table" name="cuerpo_table">
                       
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center text-dark mt-auto" >
        <div class="container py-2 width-auto" >
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Copyright:
                <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
