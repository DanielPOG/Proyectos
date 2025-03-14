<?php

include_once('../../include/conex.php');
require_once('../../include/config.php'); 
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn=Conectarse();


switch($_REQUEST['action']){

    case 'listar':
        $jTableResult = array();
        $jTableResult['listar'] = "";
    
        if ($_POST['buscar_ficha'] == "") {
            $jTableResult['msj'] = "INGRESE DATO A BUSCAR.";
            $jTableResult['result'] = "0";
            $jTableResult['listar'] = "<thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;INGRESE DATO A BUSCAR</th></tr></thead>";
        } else {
            // Consulta con parámetro preparado
            $query = "
                SELECT 
                    fichas.codigo_fichas, 
                    nombreprograma.nombrePrograma, 
                    GROUP_CONCAT(usuarios.nombres_usuarios SEPARATOR ', ') AS lista_usuarios 
                FROM fichas
                JOIN nombreprograma ON fichas.idNomPrograma = nombreprograma.idPrograma
                LEFT JOIN usuarios ON fichas.codigo_fichas = usuarios.codigo_fichas_FK
                WHERE fichas.codigo_fichas = ?
                GROUP BY fichas.codigo_fichas;
            ";
    
            // Preparar la consulta
            if ($stmt = mysqli_prepare($conn, $query)) {
                // Vincular el parámetro (s = string, i = entero, d = doble, b = blob)
                mysqli_stmt_bind_param($stmt, "s", $_POST['buscar_ficha']);
    
                // Ejecutar la consulta
                mysqli_stmt_execute($stmt);
    
                // Obtener el resultado
                $resultado = mysqli_stmt_get_result($stmt);
    
                // Verificar si se obtuvieron resultados
                $numero = mysqli_num_rows($resultado);

                $query5= "SELECT codigo_fichas, fecha_inicio, fecha_final, codDeptoFK, codMuniFK FROM fichas WHERE codigo_fichas ='".$_POST['buscar_ficha']."'";
                $consulta5 = mysqli_query($conn, $query5);
                $resultado5 = mysqli_fetch_array($consulta5);


                
                // $query6= "SELECT nombreDepto FROM departamento WHERE codDepto ='".$resultado5['codDeptoFK']."'";
                // $consulta6 = mysqli_query($conn, $query6);
                // $resultado6 = mysqli_fetch_array($consulta6);

                // $query7= "SELECT nombreMuni FROM municipios WHERE codMuni ='".$resultado5['codMuniFK']."'";
                // $consulta7 = mysqli_query($conn, $query7);
                // $resultado7 = mysqli_fetch_array($consulta7);

                if ($numero == 0) {
                    $jTableResult['msj'] = "NO SE ENCONTRARON COINCIDENCIAS.";
                    $jTableResult['result'] = "0";
                    $jTableResult['listar'] = "
                        <thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;NO EXISTEN COINCIDIENCIAS</th></tr></thead>
                        <tr><td><button id='btncrear' type='button' class='btn btn-primary' data-ficha='" . $_POST['buscar_ficha'] . "' data-bs-toggle='modal' data-bs-target='#alo'>
                        Crear Ficha
                        </button></td></tr>";
                } else {
                    $jTableResult['listar'] .= "<thead><tr><td>Nombre</td><td>Ficha</td><td>Usuarios</td></thead>";
                    while ($registro = mysqli_fetch_array($resultado)) {
                        $jTableResult['listar'] .= "
                            <tr>
                                <td width='20%'>" . $registro['nombrePrograma'] . "</td>  
                                <td width='20%'>" . $registro['codigo_fichas'] . "
                                <span><button id='btnEditarFicha' name='btnEditarFicha' 
                                data-editarFicha2='".$registro['codigo_fichas']."' 
                                data-nomFicha ='".$registro['nombrePrograma']."'
                                data-fechainicio ='".$resultado5['fecha_inicio']."'
                                data-fechafinal ='".$resultado5['fecha_final']."'
                      


                                data-bs-toggle='modal' data-bs-target='#editarFicha'>Editar</button></span> </td>
                                <td width='20%'>
                                <button class='btnVerUsuarios' data-ficha='".$registro['codigo_fichas']."'>
                                    <i class='fa fa-users'></i> Ver usuarios
                                </button>
                                <div style='max-height: 300px; overflow-y: auto;'>
                                    <table id='tablaUsuarios'>
                                        <thead>
                                            <tr><th>Usuarios</th></tr>
                                        </thead>
                                        <tbody>
                                            <!-- Los usuarios se agregarán aquí -->
                                        </tbody>
                                    </table>
                                </div>


                                </td>
                                
                            </tr>";
                        $jTableResult['result'] = "1";
                    }
                    $jTableResult['listar'] .= "
                        <tfoot><tr><td colspan='2'>
                            <form id='formA' method='POST' enctype='multipart/form-data'>
                                <h6 class='model-title'>Insertar Usuarios</h6>
                                <label for='file'>Elige un archivo:</label>
                                <input type='file' name='file' id='file' accept='.xls, .xlsx, .csv'>
                                
                                <h6 class='model-title'>Insertar Fotos</h6>
                                <label for='imageFile'>Elige un archivo:</label>
                                <input type='file' name='img_extra[]' id='imageFile' accept='.jpg, .jpeg, .png, .gif' multiple>
                                
                                <br> <br>
                                <button id='buttonForm' type='submit'>Subir archivo</button>
                            </form>
                        </td></tfoot>";
                }
                // Cerrar la sentencia preparada
                mysqli_stmt_close($stmt);
            }
        }
    
        // Imprimir el resultado
        print json_encode($jTableResult);
        break;

        case 'listarUsuarios':
            $jTableResult = array();
            $jTableResult['usuarios'] = [];
        
            if (empty($_POST['ficha'])) {
                $jTableResult['msj'] = "No se proporcionó una ficha.";
                $jTableResult['result'] = "0";
            } else {
                $query = "SELECT nombres_usuarios FROM usuarios WHERE codigo_fichas_FK = '".$_POST['ficha']."'";
                $resultado = mysqli_query($conn, $query);
                while ($usuario = mysqli_fetch_assoc($resultado)) {
                    $jTableResult['usuarios'][] = $usuario['nombres_usuarios'];
                }
                $jTableResult['result'] = !empty($jTableResult['usuarios']) ? "1" : "0";
                $jTableResult['msj'] = empty($jTableResult['usuarios']) ? "No hay usuarios para esta ficha." : "";
            }
        
            print json_encode($jTableResult);
        break;
        
    
//     <button 
//     type='button'
//     id='eliminarCons'
//     name='eliminarCons'
//     class='btn btn-danger btn-sm'										
//     data-bs-toggle='modal'
//     data-bs-target='#eliminarCons'
  
// action='..//controlador/cargar.php'
//data-id_construccion='".$registro['id_usuario']."'
//data-codigo_co='".$registro['nombres_usuarios']."'
//data-presupuesto='".$registro['codigo_fichas_FK']."'           
//data-fecha_co='".$registro['numero_doc']."'>         

//     data-id_construccion='".$registro['id_usuario']."'>         

//     Eliminar
// </button>

// <!-- Button trigger modal -->







    case 'leer':

        $query="SELECT * FROM construccion";
        $result= mysqli_query($conn,$query);
    
        if (!$result) {
            die('Query Faild'. mysqli_error($conn));
        }
    
        $json=array();
        while ($row = mysqli_fetch_array($result)) {
            $json[]=array(
                'codigo_co' => $row['codigo_co'],
                'presupuesto' => $row['presupuesto'],
                'fecha' => $row['fecha_co']
                
            );
        }
        
        $jsonstring= json_encode($json);
        echo $jsonstring;
    
        
        
    mysqli_close($conn);
    
    break;
}
?>