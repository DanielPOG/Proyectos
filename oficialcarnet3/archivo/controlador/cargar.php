<?php
header('Cache-Control: no-cache, must-revalidate');
date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d ");

include('../../include/conex.php');
session_start();
$conn = Conectarse();

// Directorios de subida
$uploadDirExcel = 'fichas/' . $_POST["ficha"] . '/'; // Carpeta para Excel
$uploadDirImages = 'fichas/' . $_POST["ficha"] . '/fotos/'; // Carpeta para imágenes

// Respuesta inicial
$response = [
    "result" => 1,
    "excel_procesado" => false,
    "imagenes_subidas" => 0,
    "error_imagenes" => [],
    "insertados" => 0
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Procesar archivo Excel
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Extensiones de archivo permitidas para Excel
        $allowedfileExtensions = ['xls', 'xlsx', 'csv'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = uniqid('excel_', true) . '.' . $fileExtension;
            $destPath = $uploadDirExcel . $newFileName;

            // Mover el archivo Excel a la carpeta de destino
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                try {
                    require_once 'Classes/PHPExcel.php'; // Asegúrate de que el path sea correcto
                    $obJetoExcel = PHPExcel_IOFactory::load($destPath);
                    $hoja = $obJetoExcel->setActiveSheetIndex(0);
                    $numeroFilas = $obJetoExcel->setActiveSheetIndex(0)->getHighestRow();
                    $numero = 0;

                    // Eliminar registros previos
                    $query = "DELETE FROM usuarios WHERE codigo_fichas_FK = '" . $_POST["ficha"] . "'";
                    mysqli_query($conn, $query);

                    // Procesar filas del Excel
                    for ($i = 6; $i <= $numeroFilas; $i++) {
                        $a1 = $hoja->getCell('A' . $i)->getCalculatedValue();
                        $a2 = $hoja->getCell('B' . $i)->getCalculatedValue();
                        $a3 = $hoja->getCell('C' . $i)->getCalculatedValue();
                        $a4 = $hoja->getCell('D' . $i)->getCalculatedValue();
                        $a5 = $hoja->getCell('E' . $i)->getCalculatedValue();
                        $a6 = $hoja->getCell('F' . $i)->getCalculatedValue();
                        $a7 = $hoja->getCell('G' . $i)->getCalculatedValue();

                        // Procesar solo aquellos en "EN FORMACION"
                        if ($a7 == "EN FORMACION") {
                            // Verificar el tipo de documento
                            $query1 = "SELECT id_tipo_doc FROM tipo_doc WHERE tipo = '$a1'";
                            $consulta1 = mysqli_query($conn, $query1);
                            $resultado1 = mysqli_fetch_array($consulta1);

                            // Verificar si el número de documento ya existe
                            $query2 = "SELECT numero_doc FROM usuarios WHERE numero_doc = '$a2'";
                            $consulta2 = mysqli_query($conn, $query2);
                            $resultado2 = mysqli_num_rows($consulta2);

                            // Si no existe el documento, insertamos el nuevo usuario
                            if ($resultado2 == 0) {
                                $query = "
                                    INSERT INTO usuarios 
                                    SET 
                                        fecha_registro = '$fecha', 
                                        id_tipo_doc_FK = '" . $resultado1['id_tipo_doc'] . "', 
                                        numero_doc = '$a2', 
                                        nombres_usuarios = '$a3', 
                                        apellidos_usuarios = '$a4', 
                                        clave_usuarios = '', 
                                        telefono = '$a5', 
                                        correo_usuarios = '$a6', 
                                        id_rol_FK = '1', 
                                        codigo_fichas_FK = '" . $_POST['ficha'] . "', 
                                        estado = '0', 
                                        foto = '" . $a2 . ".jpg'
                                ";
                                mysqli_query($conn, $query);
                                mysqli_commit($conn);
                                $numero++;
                            }
                        }
                    }

                    $response["excel_procesado"] = true;
                    $response["insertados"] = $numero;

                } catch (Exception $e) {
                    $response["error_excel"] = 'Error al procesar el Excel: ' . $e->getMessage();
                }
            } else {
                $response["error_excel"] = "Error al mover el archivo Excel al destino.";
            }
        } else {
            $response["error_excel"] = "Tipo de archivo Excel no permitido.";
        }
    }

    // Procesar imágenes
    if (isset($_FILES['img_extra']) && count($_FILES['img_extra']['tmp_name']) > 0) {
        foreach ($_FILES['img_extra']['tmp_name'] as $index => $tmpName) {
            // Verificar que el archivo no esté vacío
            if (!empty($tmpName)) {
                $fileName = $_FILES['img_extra']['name'][$index];
                $fileTmp = $tmpName;
                $fileType = mime_content_type($fileTmp); // Aquí se usa mime_content_type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                // Validar que el tipo de archivo sea uno permitido
                if (in_array($fileType, $allowedTypes)) {
                    // Mantener el nombre original de la imagen
                    $newFileName = $fileName;

                    // Verificar si el archivo ya existe en el destino
                    if (!file_exists($uploadDirImages . $newFileName)) {
                        if (move_uploaded_file($fileTmp, $uploadDirImages . $newFileName)) {
                            $response['imagenes_subidas']++;
                        } else {
                            $response['error_imagenes'][] = "Error al mover la imagen: " . $fileName;
                        }
                    } else {
                        $response['error_imagenes'][] = "La imagen con el nombre " . $fileName . " ya existe.";
                    }
                } else {
                    $response['error_imagenes'][] = "El archivo " . $fileName . " no es un tipo de imagen válido.";
                }
            } else {
                $response['error_imagenes'][] = "El archivo está vacío o no se ha subido correctamente.";
            }
        }
    } else {
        $response['error_imagenes'][] = "No se enviaron imágenes.";
    }


    // Ajustar el resultado general
    if ($response["excel_procesado"] === false && $response["imagenes_subidas"] === 0) {
        $response["result"] = 0;
    }

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
}
?>
