<?php
include('../../include/config.php');
session_name($session_name);
session_start();

?>
<?php
include('../../include/conex.php');
$link=Conectarse();

$sql = "SELECT * FROM usuarios WHERE id_usuario = '$_SESSION[id_usu]'";
$consulta=mysqli_query($link,$sql);
$resultado=mysqli_fetch_array($consulta);

$sql2="SELECT * FROM rol WHERE id_rol = '$resultado[9]'";
$consulta2=mysqli_query($link,$sql2);
$resultado2=mysqli_fetch_array($consulta2);

$sql3="SELECT * FROM tipo_doc WHERE id_tipo_doc = '$resultado[2]'";
$consulta3=mysqli_query($link,$sql3);
$resultado3=mysqli_fetch_array($consulta3);


$sql4="SELECT * FROM fichas WHERE codigo_fichas = '$resultado[12]'";
$consulta4=mysqli_query($link,$sql4);
$resultado4=mysqli_fetch_array($consulta4);


$sql5="SELECT * FROM rh WHERE id_rh = '$resultado[10]'";
$consulta5=mysqli_query($link,$sql5);
$resultado5=mysqli_fetch_array($consulta5);

// Información del aprendiz
$nombre = $resultado[4];
$apellido = $resultado[5];
$rol = $resultado2[1];
$rh = $resultado5[1];
$documento = $resultado[3];
$tipoDocumento = $resultado3[1]; // Puede ser T.I o C.C
$ficha = $resultado4[0];

$fecha_fin = $resultado4[2];
$foto = $resultado[13];

?>
<!doctype html>

<html lang="es">
  <head>
  	<title>SENA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../menub/css/styles.css">
    <link rel="stylesheet" href="../../menub/css/carnet.css">
    <link rel="stylesheet" href="../../herramientas/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  </head>
  <header class="header__header">
    <div class="header__group">
        <div class="header__images">
            <img class="images__img" src="../../herramientas/img/sena1.PNG" alt="logo sena">
        </div>
        <div class="header__conten">
            <h1 class="header__title"> Tu carnet seguro aquí ...</h1>
        </div>
    </div>

</header>
<body>
    <div class="body__group">
        <div class="body__back">
            <div class="card">
                <div class="card__header">
                    <div class="logo">
                        <img class="logo__image" src="../../herramientas/img/sena1.PNG" alt="Logo">
                    </div>

                    <div class="photo-placeholder"><img class="placeholder__foto" src="../controlador/fichas/<?php echo $ficha; ?>/fotos/<?php echo $foto; ?>"
                    alt=""></div>
                    
                    <div class="header__rol">
                       <h4 class="title-container"><?php echo $rol ?></h4>
                    </div>

                </div>
                <div class="card-content">
                   
                    <h2 class="name"><?php echo $nombre ?></h2>
                    <h2 class="name"><?php echo $apellido ?></h2>
                    <p class="id"><span class="id__span"><?php echo $tipoDocumento?> :</span><?php echo $documento ?></p>
                    <p class="info">RH: <?php echo $rh ?></p>
                    <div class="barcode-container">
                        <svg id="barcode"></svg>
                    </div>
                    <p class="location"><div class="location__line"> </div><span class="location__span">Regional Cauca </span> <br> Centro Agropecuario</p>
                </div>
            </div>
        </div>
        <div class="body__back">
            <div class="card">
                <div class="card__border">
                    <div class="card-content--back">
                        <h4 class="title-container--back">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus tempore unde provident laudantium veritatis velit temporibus, laboriosam assumenda tenetur modi officiis voluptate pariatur facilis, asperiores sapiente nobis. Atque, in laboriosam?
                        periam amet quod, nostrum, deserunt blanditiis tempore architecto, odit illo reprehenderit exercitationem  elit. Possimus tempore unde provident laudantium veritatis velit temporibus, laboriosam assumenda tenetur modi officiis voluptate pariatur facilis, asperiores sapiente nobis. Atque, in laboriosam?
                        periam amet quod, nostrum, deserunt </h4>
                        <div class="content--back__img">
                            <h4 class="content--back__img-firma"> Firma</h4>
                        </div>

                        <h4 class="content--back__title"> FIRMA AUTORIZADA</h4>
                        <h4 class="content--back__subtitle">Andres Collazos Robles</h4>
                        <h4 class="content--back__date">Vence: <?php echo $fecha_fin ?></h4>
                        <h4 class="content--back__ficha">Ficha: <?php echo $ficha ?></h4>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script>
        JsBarcode("#barcode", "1013262891", {
            format: "CODE128",
            lineColor: "#000000",
            width: 5,
            height: 100,
            displayValue: false
        });
    </script>
</body>
    <button class="back__button"><a class="button__link" href="../../menub/admin.php">Salir</a></button>
<footer class="card__footer">
    <div class="footer__content">
        <ul class="content__list">
            <li class="list__option"><a class="option__link" href="#"><i class="fa-brands fa-youtube"></i></a></li>
            <li class="list__option"><a class="option__link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="list__option"><a class="option__link" href="#"><i class="fa-brands fa-linkedin"></i></a></li>
        </ul>
    </div>
</footer>
</html>