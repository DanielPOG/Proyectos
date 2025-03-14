<?php
require_once('../../include/config.php'); 
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
include('../../include/conex.php');
session_name($session_name);
session_start();
$conn=Conectarse();

switch ($_REQUEST['action']) 
	{

		case 'registrarFicha':
            $jTableResult = array();
            $jTableResult['msj'] = "";
            $jTableResult['rspst'] = "";
        
            // Validar campos obligatorios
            if (empty($_POST['fichacrear']) || empty($_POST['inicioFecha']) || empty($_POST['finalFecha']) || empty($_POST['deptoFicha']) || empty($_POST['muniFicha'])) {
                $jTableResult['msj'] = "Uno o varios campos están sin diligenciar.";
                $jTableResult['rspst'] = "0";
                print json_encode($jTableResult);
                break;
            }
        
            $idNomPrograma = null;
        
            // Validar si se envió un nuevo nombre
            if (!empty($_POST['nomFicha'])) {
                $nomFicha = trim($_POST['nomFicha']);
                $query = "SELECT idPrograma FROM nombreprograma WHERE nombrePrograma = '$nomFicha'";
                          $resultado = mysqli_query($conn, $query);
        
                if (mysqli_num_rows($resultado) > 0) {
                    // El nombre ya existe
                    $row = mysqli_fetch_array($resultado);
                    $idNomPrograma = $row['idPrograma'];
                } else {   
                    // Crear el nuevo nombre
                    $query = "INSERT INTO nombreprograma (nombrePrograma) VALUES ('$nomFicha')";
                    if (mysqli_query($conn, $query)) {
                        $idNomPrograma = mysqli_insert_id($conn); // Obtener el ID recién creado
                    } else {
                        $jTableResult['msj'] = "Error al crear el nombre de la ficha.";
                        $jTableResult['rspst'] = "0";
                        print json_encode($jTableResult);
                        break;
                    }
                }
            } elseif (!empty($_POST['idFichaSeleccionada'])) {
                // Usar el ID seleccionado
                $idNomPrograma = intval($_POST['idFichaSeleccionada']);
            }
        
            // Validar que se haya obtenido un ID de programa
            if ($idNomPrograma === null) {
                $jTableResult['msj'] = "No se seleccionó ni se ingresó un nombre de ficha válido.";
                $jTableResult['rspst'] = "0";
                print json_encode($jTableResult);
                break;
            }
        
            // Insertar en la tabla `fichas`
            $query = "INSERT INTO fichas (codigo_fichas, idNomPrograma, fecha_inicio, fecha_final, codDeptoFK, codMuniFK)
                      VALUES ('".trim($_POST['fichacrear'])."', '$idNomPrograma', '".trim($_POST['inicioFecha'])."', '".trim($_POST['finalFecha'])."', '".trim($_POST['deptoFicha'])."', '".trim($_POST['muniFicha'])."')";
            if (mysqli_query($conn, $query)) {
                $jTableResult['msj'] = "Registro de ficha realizado con éxito.";
                $jTableResult['rspst'] = "1";
            } else {
                $jTableResult['msj'] = "Error al registrar la ficha.";
                $jTableResult['rspst'] = "0";
            }
        
            print json_encode($jTableResult);
            break;
            case 'editarFicha':

                break;
            
        
		case 'salir';
			unset($_SESSION['id_usu']);
			unset($_SESSION['nombre_usu']);
			unset($_SESSION['apellido_usu']);
			session_destroy();
			header('location:../index.php');
		break;

	
	}		
mysqli_close($conn);
?> 																		