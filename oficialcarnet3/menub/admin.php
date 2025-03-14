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
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="../herramientas/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
  <title>Carnetización SENA</title>
  
</head>
<body>
  <header>

    <div class="content">

        <div class="menu container_admin">
          <a href="index.html" class="logo" ><img  src="images/logo.webp" class="logo_sena_header"width="32px" alt="logo sena"></a>
          <h1 class="menu_contaimer-bienvenido">Bienvenid@ a tu carnetización SENA...</h1>
          <input type="checkbox" id="menu"/>
          <label for="menu"> 
            <img src="images/menu.png" class="menu-icono" alt="meniicono">
          </label>
          
          <nav class="navbar">
            <ul>
              <li><a href="../index.php">Salir</a></li>
              <li class="navbar_perfil">

                  <a href="admin.php">
                    <span class="navbar_perfil"><i class="fa-solid fa-user-tie"></i><p class="perfil_admin"><?php echo $_SESSION['nombre_usu'];?></p></span>
                    
                  </a>


              </li>
            </ul>
          </nav>
        </div>

    </div>
  </header>

  <main class="main-content">
    <div class="card-container">

      <div class="card">
        <div class="card-icon">
          <i class=" fa-regular fa-id-badge"></i>
        </div>
        <div class="card-body">
          <a href="../archivo/vista/carnet-admin.php" class="card-btn">Mi carnet</a>
        </div>
      </div>

      <div class="card">
        <div class="card-icon">
          <i class="fa-regular fa-clipboard"></i> 
        </div>
        <div class="card-body">
          <a href="../archivo/vista/admin-fichas.php" class="card-btn">Fichas</a>
        </div>
      </div>
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
</html>
