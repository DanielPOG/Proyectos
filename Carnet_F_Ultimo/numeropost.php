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
            <nav  class="navbar navbar-expand-lg bg-warning" >
                <div class="container-fluid">
                    <a class="navbar-brand" href="#" ><img src="https://certificadossena.net/wp-content/uploads/2022/10/logo-sena-negro-png-2022-300x294.png" alt="" width="35px" ></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Registro</a>
                            </li>
                           
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Administrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#">Salir</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            
                            <button class="btn btn-outline-dark"  type="submit">Search</button>
                        </form>
                    </div>
                    
                </div>
            </nav>
            <!-- Fin de barra nav de daniel caicedo -->
        </header>
        <main>
            <div class="container mt-3">   
                <div class="row justify-content-center align-items-center g-2">
                    <form action="tablasmulti.php" method="post">
                        <div class="mb-3">
                            <label for="numero" class="form-label">Numero</label>
                            <input type="number" class="form-control" id="numero" name="numero">
                            
                        </div>
                        <div class="mb-3">
                            <label for="hasta" class="form-label">Hasta</label>
                            <input type="number" class="form-control" id="hasta" name="hasta">
                        </div>
                    
                        
                        <button type="submit" class="btn btn-primary">Multiplicar</button>
                    </form>

                </div>
                
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
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
