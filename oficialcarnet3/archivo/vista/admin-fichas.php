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
  <link rel="stylesheet" href="../../menub/css/styles.css">
  <link rel="stylesheet" href="../../herramientas/fonts/fontawesome-free-6.1.2-web/css/all.min.css">

  <script src='https://code.jquery.com/jquery-3.7.0.js' ></script>
  <script src="../../herramientas/js/listar.js"></script>
  <script src="../../herramientas/js/fichas.js"></script>
  <!-- ICONO TITTLE -->
  <link rel="icon" href="herramientas/img/logo.webp" type="image/x-icon">
  <!-- FIN ICONO TITTLE -->
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- ICONOS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- FIN ICONOS -->

  <!-- alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <title>Carnetización SENA</title>
  
</head>

<body>


<!-- Modal Crear Ficha-->
<div class="modal fade" id="alo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content " style="margin-top:400px">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear ficha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mt-1"> 
        <h6 class="model-title">Codigo Ficha</h6>
        <input type="text" id="fichacrear" name="fichacrear" class="form-control" placeholder="Numero de Ficha">  <!-- Numero de ficha -->
        </div>
        <div class="row mt-1">
            <h6 class="model-title">Nombre Ficha</h6>
            <input id="nomFicha" name="nomFicha" type="text" class="form-control" placeholder="Escribe un nuevo nombre de ficha"> <!-- Campo para un nuevo nombre -->
        </div>

        <div class="row mt-1">
            <h6 class="model-title">Seleccionar Nombre Ficha</h6>
            <div class="col-12 d-flex align-items-center">
                <span class="input-group-text"><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
                <select id="selectFicha" name="selectFicha" class="form-select ms-2" style="cursor: pointer;">
                    <option value="0" selected>Seleccione:</option> <!-- Opciones se llenarán dinámicamente -->
                </select>
            </div>
        </div>

        <div class="row mt-1">
          <h6 class="model-title">Fecha Inicio</h6>
          <input id="inicioFecha" name="inicioFecha" type="date" class="form-control"> <!-- fecha inicio -->
        </div>
        <div class="row mt-1">
        <h6 class="model-title">Fecha Final</h6>
          <input id="finalFecha" name="finalFecha" type="date" class="form-control"> <!-- fecha final --> 
        </div>
        <div class="row mt-1">
          <h6 class="model-title">Departamentos</h6>
          <div class="col-12 d-flex align-items-center">
            <span class="input-group-text"><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
            <select id="deptoFicha" name="deptoFicha" class="form-select ms-2" style="cursor: pointer;">

            </select>
          </div>
        </div>

        <div class="row mt-1">
          <h6 class="model-title">Municipios</h6>
          <div class="col-12 d-flex align-items-center">
            <span class="input-group-text"><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
            <select id="muniFicha" name="muniFicha" class="form-select ms-2" style="cursor: pointer;">

            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button id="btnRegFicha" name="btnRegFicha" type="button" class="btn btn-primary">Registrar</button>
      </div>
    </div>
  </div>
</div>

  
<!-- FIN Modal Crear Ficha-->

<!-- Modal editar Ficha-->
<div class="modal fade" id="editarFicha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content " style="margin-top:400px">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar ficha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mt-1"> 
        <h6 class="model-title">Codigo Ficha</h6>
        <input type="text" id="inputFicha" name="inputFicha" class="form-control" placeholder="Numero de Ficha" readonly>  <!-- Numero de ficha -->
        </div>
        <div class="row mt-1">
            <h6 class="model-title">Nombre Ficha</h6>
            <input id="editarNomFicha" name="editarNomFicha" type="text" class="form-control" placeholder="Escribe un nuevo nombre de ficha" readonly> <!-- Campo para un nuevo nombre -->
        </div>

        <div class="row mt-1">
          <h6 class="model-title">Fecha Inicio</h6>
          <input id="editarInicioFecha" name="editarInicioFecha" type="date" class="form-control" readonly> <!-- fecha inicio -->
        </div>

        <div class="row mt-1">
        <h6 class="model-title">Fecha Final</h6>
          <input id="editarFinalFecha" name="editarFinalFecha" type="date" class="form-control"> <!-- fecha final --> 
        </div>
        <div class="row mt-1">
          <h6 class="model-title">Departamentos</h6>
          <div class="col-12 d-flex align-items-center">
            <span class="input-group-text"><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
            <select id="editardeptoFicha" name="editardeptoFicha" class="form-select ms-2" style="cursor: pointer;">

            </select>
          </div>
        </div>

        <div class="row mt-1">
          <h6 class="model-title">Municipios</h6>
          <div class="col-12 d-flex align-items-center">
            <span class="input-group-text"><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
            <select id="editarmuniFicha" name="editarmuniFicha" class="form-select ms-2" style="cursor: pointer;">

            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button id="btnRegFicha" name="btnRegFicha" type="button" class="btn btn-primary">Registrar</button>
      </div>
    </div>
  </div>
</div>

  
<!-- FIN Modal editar Ficha-->

   
  <header>

    <div class="content">

        <div class="menu container_admin">
          <a href="index.html" class="logo" ><img  src="../../menub/images/logo.webp" class="logo_sena_header"width="32px" alt="logo sena"></a>
          <h1 class="menu_contaimer-bienvenido">Bienvenid@ a tu carnetización SENA...</h1>
          <input type="checkbox" id="menu"/>
          <label for="menu"> 
            <img src="../../menub/images/menu.png" class="menu-icono" alt="meniicono">
          </label>
          
          <nav class="navbar">
            <ul>
            <li><a href="../../menub/admin.php">Inicio</a></li>
              <li><a href="../../index.php">Salir</a></li>
              <li class="navbar_perfil">

                  <a href="admin-fichas.php">
                    <span class="navbar_perfil"><i class="fa-solid fa-user-tie"></i><p class="perfil_admin"><?php echo $_SESSION['nombre_usu'];?></p></span>
                    
                  </a>


              </li>
            </ul>
          </nav>
        </div>

    </div>
  </header>

  <main class="main-content">
    <div class="content__main">
      <div class="main__search">
        <div>
          <input class="search__input" type="text" id="buscar_ficha" name="buscar_ficha" placeholder="Buscar"/> 
          <button class="search__button open-modal-btn" type="button" id="btn_buscar" name="btn_buscar">Buscar</button>
        </div>

         <!-- Botón para abrir el modal -->
        <!-- <button class="open-modal-btn" id="openModal">Abrir Modal</button> --> 
      </div>
      <div class="table-container" style="max-height: 400px; overflow-y: auto;">
          <table class="table table-striped table-responsive">
              <thead>

              </thead>
              <tbody id="cuerpo_table" name="cuerpo_table">
                  <!-- Aquí irán los datos -->
              </tbody>
          </table>
      </div>

      <footer>
          <!-- <form action="..//controlador/cargar.php" method="POST" enctype="multipart/form-data">
            <label for="file">Elige un archivo:</label>
            <input type="file" name="file" id="file" required>
            <button type="submit">Subir archivo</button>
          </form> -->
      </footer>
    </div>
  </main>
  <!-- Footer -->
  <footer class="footer">
    <div class="footer-social-icons">
      <ul class="social-icon">
        <li class="icon-elem">
          <a href="#" class="icon"><i class="fa-brands fa-youtube"></i></a>
        </li>
        <li class="icon-elem">
          <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
        </li>
        <li class="icon-elem">
          <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
        </li>
        <li class="icon-elem">
          <a href="#" class="icon"><i class="fa-solid fa-envelope"></i></a>
        </li>
      </ul>
    </div>
  </footer>
</body>
 <!-- Modal -->
 <div class="modal" id="modal">
      <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Título del Modal</h2>
        <p>Este es el contenido del modal. Puedes agregar lo que desees aquí.</p>
      </div>
    </div>

    <!-- <script>
      // Abrir y cerrar el modal usando JavaScript
      const modal = document.getElementById('modal');
      const openModalBtn = document.getElementById('openModal');
      const closeModalBtn = document.getElementById('closeModal');

      // Mostrar el modal
      openModalBtn.addEventListener('click', () => {
        modal.style.display = 'block';
      });

      // Cerrar el modal
      closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
      });

      // Cerrar el modal al hacer clic fuera de él
      window.addEventListener('click', (event) => {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    </script> -->
</html>
