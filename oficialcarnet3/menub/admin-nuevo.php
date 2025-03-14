<?php
include('../include/config.php');
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
</head>
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
                            <a class="nav-link" href="#">Pricing</a>
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
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Mi Carnet</h5>
                            <p class="card-text">Entra y conoce tu carnet SENA.</p>
                            <a href="../archivo/vista/admin-fichas-nuevo.php" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center text-dark mt-auto">
        <div class="container py-4">
            <section class="mb-4">
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button"><i class="fab fa-google"></i></a>
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button"><i class="fab fa-linkedin"></i></a>
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button"><i class="fab fa-github"></i></a>
            </section>
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
