<?php  
include  ("conex.php"); //Archivo para conectar base de datos
$link= conexion(); //Estable conexion



$id=$_GET['user'];
$user1=$id;




$sql9="SELECT * FROM usuario WHERE id_usuario='$id' " ; //Consulta
$consulta9=mysqli_query($link,$sql9); //Envia consulta a BD
$resultado9=mysqli_fetch_array($consulta9);

 ?>


<style>
                #nav1{
                    background-color: #39A900;
                }
                #fo1{
                    
                    background-color: #00340D;
                }
</style>

<nav id="nav1" class="navbar navbar-expand-lg navbar-dark" >
                <div class="container-fluid">
                    <a class="navbar-brand " href="#" ><img src="img/ls.png" alt="sena" width="50px" ></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                            
                                <a class="nav-link" href="principal.php?user=<?php  echo $resultado9[0];?>">Principal</a>
                            </li>
                           
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-target="#centro" data-bs-toggle="modal">Agregar Centro</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="centro.php?user=<?php  echo $resultado9[0];?>" >Centro</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="index.php">Salir</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <a href="" class="navbar-brand d-flex">
                            <img src="foto/<?php echo $resultado9[4]."/". $resultado9[10];?>"  alt="Usuario" width="100px"  class="d-inline-block align-text-top"><?php echo $resultado9[1];?>
                            </a>
                            
                        </form>
                    </div>
                    
                </div>
</nav>