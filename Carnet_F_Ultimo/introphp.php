<!doctype html>
<html lang="en">
    <head>
        <title>Plantilla1</title></title>
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
            
            <?php echo '<div class="container mt-3">'; ?>
                <?php echo '<div class="row justify-content-center align-items-center g-2">'?>
                    <?php 
                    $a=10;
                    $A='Esto es cadena';
                    $b="otra cadena lbre";
                    echo $b.'<br>'. $A . '<br>'. $a . '<br>';
                    $op1=4 ; $op2=12;
                    $res=$op1+$op2;
                    for ($i=0; $i <10; $i++){
                        echo "<h".$i."> Tipo".$i. "</h".$i.">";

                    }
                    ?>
                    <?php echo '<h1>'.$A.'</h1>'?>
                    
                    <?php
                        if(isset($_GET['columnas'])){
                            $filas=$_GET['filas'];
                            $columnas=$_GET['columnas'];
                    
                        } 
                        else{
                        $columnas=0;
                        $filas=0;
                        }

                        
                    ?>
                    <table class="table-bordered" >
                    
                        <?php  
                        //Genero filas
                        
                        for($i=0; $i < $filas; $i++)
                        {
                            echo '<tr>';
                            //Genero columnas
                            for($k=0; $k < $columnas; $k++)
                            {
                                echo '<td>'.$k.'</td>';
                            }
                            echo '</tr>';
                        
                        }   ?>
                        
                        
                    </table>
                        
                        <?php
                        if(isset($_GET['nombre'])){
                            $nombre=$_GET['nombre'];
                            $edad=$_GET['edad'];
                            echo $nombre.' '.'tiene'.' '. $edad.' '. 'años'; 
                    
                        } 
                        else{
                        $nombre=0;
                        $edad=0;
                        } ?>
                        <!-- PARA VERIFICAR SI ES UN ENTERO -->
                        <?php /* $l="alo";
                        if (is_int($l)){
                            echo "pepe";
                        }
                        else{
                            echo "papo";
                        } */
                        
                        ?>
                    


                    <!-- prueba de tablas-->
                     <?php 
                     /*$tabla=5;
                     $filas=5;
                     $columnas=8;
                     
                     ?>
                        <?php for ($p=0; $p < $tabla; $p++){
                            echo '<table class="table-bordered">';
                                 //Genero filas
                                for($i=0; $i < $filas; $i++)
                                {
                                    echo '<tr>';
                                    //Genero columnas
                                    for($k=0; $k < $columnas; $k++)
                                    {
                                        echo '<td>'.$k.'</td>';
                                    }
                                    echo '</tr>';
                                
                                }   

                        } */ 
                       
                        ?>
                    <!-- fin prueba de tablas -->
                  
                    <h1>Sin php</h1>
                    <h1><?php echo $op1. '+' .$op2.'='. $res; ?></h1>
                    <?php echo '<h1>' .$A. '</h1>' ?>
                </div>
            </div>
            <!-- CICLO while -->
            <?php 
            $a=10;
                while($a >=5){
                    echo "el pepe".$a.'<br>';
                    $a--;
                
                };

            /*FOREACH PARA RECORRER UN ARRAY/LISTA */
            $colores= array("azul","Blanco","Rojo");
           
            foreach ($colores as $clave => $valor){
                echo $clave.":".$valor."<br>";
            }
                
            $nombres_1= array("pepe","luis","ramon","juan");

            foreach($nombres_1 as $it => $valor_1){
                
            };
            if ($nombres_1[0] == "dani"){
                echo "Si esta!!!!";
            }
            else{
                echo "No esta!!!   ";
            };
     
            
            ?>
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
