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
            <div class="container mt-3">   
                <div class="row justify-content-center align-items-center g-2">
                    <h2>Esto va dentro del container de la fila 1</h2>
                    <div class="col">PEPE</div>
                    <div class="col">PEPE2</div>
                    <div class="col">PEPE3</div>

                </div>
                
            </div>
            
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
