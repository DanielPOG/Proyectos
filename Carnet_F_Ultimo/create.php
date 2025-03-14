<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        /> 
</head>
<body>
<div class="container mt-3">
                <div
                    class="row justify-content-center align-items-center g-2"
                >
                <form action="otro_post.php" method="post"> 
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="nombre">
                    <div class="mb-3">
                        <label for="apellido" class="form-label">apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="number" class="form-control" id="documento" name="documento">
                    </div>
                    <div class="mb-3">
                        <select name= "rh">
                        <option selected>Selecione</option>
                            <?php
                            include ("conex.php");//Modulo para connectar base de datos
                            $link=conexion();
                            $sql="SELECT * FROM rh " ;//Consulta sentencia SQL
                            $consulta=mysqli_query($link,$sql); //enviar consulta a BD
                            while ($resultado=mysqli_fetch_array($consulta)){
                                echo '<option value="'.$resultado[0].' ">'.$resultado[1].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
</body>
</html>