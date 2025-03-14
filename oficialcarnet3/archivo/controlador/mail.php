<?php
// VARIABLES DE CONEXION A BASE DE DATOS GLOBALES
define('DB_HOST', 'localhost');
define('DB_NAME', 'wilmer');
define('DB_USER', 'root');
define('DB_PASS', '');

// Incluye el archivo autoload de PHPMailer
require 'srcmail/PHPMailer.php';
require 'srcmail/SMTP.php';
require 'srcmail/Exception.php';

// Usar el espacio de nombres de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PARA LAS CONSULTAS
include_once("../../include/conex.php");
$conn= Conectarse();

require_once('../../include/config.php'); 
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();



function generarcod($longitud = 0) {
    $numeros = '0123456789';
    $codigo = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $indiceAleatorio = rand(0, strlen($numeros) - 1); //Esta función genera un número entero aleatorio entre 0 y el tamaño de la cadena $numeros menos 1. // es lo mismo que decir rand(0,9)
        $codigo .= $numeros[$indiceAleatorio]; // concatenacion de los numeros cada vez que pase
    }
    
    return $codigo;
}

function guardarcod($codigo,$id) {
 

    try {
        // PDO es una extensión en PHP que proporciona una interfaz para acceder a bases de datos de manera mas segura
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para insertar el código en la tabla
        $sql = "INSERT INTO codigos (codigo , fecha_expiracion, id_usuario_FK) VALUES (:codigo ,CURRENT_TIMESTAMP,$id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['codigo' => $codigo]);

    } catch (PDOException $e) {
        echo "Error al guardar el código en la base de datos: " . $e->getMessage(); // Muestra el mensaje de error
    }
};





switch ($_REQUEST['action']) 
	{
        case 'mandarcod':
            

        if (isset($_POST['correo1'])) {

            $jTableResult = array();
            
            // Primera consulta para verificar si el correo existe
            $query = "SELECT correo_usuarios, id_usuario FROM usuarios WHERE correo_usuarios='".$_POST['correo1']."'";
            $consulta = mysqli_query($conn, $query); 
            $resultado = mysqli_fetch_array($consulta); 



            if ($resultado) {  // Se verifica si la consulta devuelve algún resultado
                // Segunda consulta para verificar si el usuario tiene un código asociado
                $query1 = "SELECT id_usuario_FK FROM codigos WHERE id_usuario_FK = '" . $resultado['id_usuario'] . "'";
                $consulta = mysqli_query($conn, $query1);
                $resultado1 = mysqli_fetch_array($consulta);

                // Generar código y guardar si se encuentra el usuario
                $codigo = generarcod(5);
                $guardar = guardarcod($codigo, $resultado['id_usuario']);  // Guarda el código en la base de datos
                
                // Crear una instancia de PHPMailer
                $mail = new PHPMailer(true);

                //PARAMETROS PARA ENVIAR UN EMAIL A QUIEN LE LLEGA (correo), ASUNTO (Verificacion), CONTENIDO (codigo)

                try {
                    // Configuración del servidor
                    $mail->isSMTP();                            // Configurar el uso de SMTP
                    $mail->Host = 'smtp.gmail.com';             // Servidor SMTP de Gmail
                    $mail->SMTPAuth = true;                     // Habilitar la autenticación SMTP
                    $mail->Username = 'santiagocaicedo140@gmail.com';    // Tu dirección de correo
                    $mail->Password = 'ybgs nfmc fvby dgaj ';          // Tu contraseña de Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar encriptación TLS
                    $mail->Port = 587;                          // Puerto de Gmail para TLS

                    // Destinatarios
                    $mail->setFrom($_POST['correo1'], 'Codigo'); // De
                    $mail->addAddress($_POST['correo1'], 'Nombre Destinatario'); // Para
                    $mail->addReplyTo($_POST['correo1'], 'Informacion'); // Responder a

                    // Contenido del correo
                    $mail->isHTML(true);                                  // Establecer el formato de correo a HTML
                    $mail->Subject = 'Codigo de Verificacion';
                    $mail->Body    = '<b>¡Hola! </b> Este es tu codigo de verificacion: ' .$codigo; //COLOCAR CODIGO
                    $mail->AltBody = '¡Hola! Este es tu codigo de verificacion: ' .$codigo; //COLOCAR CODIGO

                    // Enviar el correo
                    $mail->send();
                  
                    // Si el envío fue exitoso, devolvemos un mensaje JSON
                    echo json_encode(['success' => 1, 'message' => 'El mensaje ha sido enviado']);
                } catch (Exception $e) {
                    echo json_encode(['success' => 0, 'message' => "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}"]);
                }

             

        } else {
                if(($_POST['correo1']==NULL)  ) 
                {
                    $jTableResult['msj']= "El campo esta ";
                    $jTableResult['msj'].= "están sin diligenciar.";
                    $jTableResult['rspst']= "0";	
                
                    print json_encode($jTableResult);
                    
                }elseif ($resultado==false) {
                    $jTableResult['msj']= "No ";
                    $jTableResult['msj'].= "Existe este correo";
                    $jTableResult['rspst']= "0";	
                
                    print json_encode($jTableResult);
                }
                
            }
        } else {
            echo "Correo no recibido.";
        }
        break;

    
    
        case 'verificarCod':
            $jTableResult = array();
            $codigo = $_POST['codigo'];
            $correo1 = $_POST['correo1'];

            $query = "SELECT id_usuario FROM usuarios WHERE correo_usuarios = '$correo1'";
            $consulta = mysqli_query($conn, $query);
            $resultado = mysqli_fetch_array($consulta);

            $query1 = "SELECT * FROM codigos WHERE codigo = '$codigo' AND id_usuario_FK='".$resultado['id_usuario']."'";
            $consulta = mysqli_query($conn, $query1);
            $resultado1 = mysqli_fetch_array($consulta);

            if ($resultado1==true){
                try {
                    // Conexión a la base de datos con PDO
                    $pdo = new PDO("mysql:host=localhost;dbname=wilmer", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    // Consulta para obtener el código y la fecha de creación
                    $sql = "SELECT codigo,fecha_expiracion FROM codigos WHERE codigo = :codigo";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['codigo' => $codigo]);
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                    $query2 = "SELECT estado FROM usuarios WHERE correo_usuarios = '$correo1'";
                    $consulta = mysqli_query($conn, $query2);
                    $resultado2 = mysqli_fetch_array($consulta);
            
                    if ($resultado) {
                        // Crea un objeto DateTime a partir de la fecha de creación
                        $fechaCreacion = new DateTime($resultado['fecha_expiracion']);
                        $fechaActual = new DateTime(); // Fecha y hora actuales
            
                        // Calcula la diferencia de tiempo en minutos
                        $diferencia = $fechaActual->diff($fechaCreacion); // Devuelve un objeto DateInterval
            
                        // Verifica si han pasado menos de 10 minutos
                        if ($diferencia->i < 10 || ($diferencia->h === 0 && $diferencia->i === 0)) {

                            if($resultado2['estado'] == '0'){
                                $jTableResult['rspst']= "1";	
                                print json_encode($jTableResult);



                            }else{
                                $jTableResult['rspst']= "2";	
                                print json_encode($jTableResult);  
                            } 
                            
                        } else {
                            $jTableResult['msj']= "Este codigo ";
                            $jTableResult['msj'].= "Ha expirado";
                            $jTableResult['rspst']= "0";	
                            print json_encode($jTableResult);
                            $query = "DELETE FROM codigos WHERE codigo = '$codigo'";
                            $consulta = mysqli_query($conn, $query);
                        }
                    } 
            
                } catch (PDOException $e) {
                    return "Error al verificar el código: " . $e->getMessage();
                }
            }else{
                    $jTableResult['msj']= "Este codigo ";
                    $jTableResult['msj'].= "No existe";
                    $jTableResult['rspst']= "0";	
                
                    print json_encode($jTableResult);
            }
            
        break;

        // aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        case 'verificarClave':
            $jTableResult = array();
            $clave = $_POST['clave1'];
            $correo = $_POST['correo1'];
            // Consulta para verificar si la clave existe en la base de datos
            $query = "SELECT * FROM usuarios WHERE correo_usuarios = '$correo'";
            $consulta = mysqli_query($conn, $query);
            $resultado = mysqli_fetch_array($consulta);
            
  
            if ($resultado['clave_usuarios'] === $clave && $resultado['id_rol_FK'] == '1') { // Si la clave existe en la base de datos
                $jTableResult['rspst'] = "1";  // Respuesta positiva, clave encontrada
                $jTableResult['msj'] = "Clave verificada exitosamente."; // Mensaje opcional
                
                // Establece las variables de sesión
                $_SESSION['id_usu'] = $resultado['id_usuario'];
                $_SESSION['nombre_usu'] = $resultado['nombres_usuarios'];
                $_SESSION['apellido_usu'] = $resultado['apellidos_usuarios'];
            } elseif ($resultado['clave_usuarios'] === $clave && $resultado['id_rol_FK'] ==' 2'){
                $jTableResult['rspst'] = "2";  // Respuesta positiva, clave encontrada
                $jTableResult['msj'] = "Clave verificada exitosamente."; // Mensaje opcional
                
                // Establece las variables de sesión
                $_SESSION['id_usu'] = $resultado['id_usuario'];
                $_SESSION['nombre_usu'] = $resultado['nombres_usuarios'];
                $_SESSION['apellido_usu'] = $resultado['apellidos_usuarios'];
            }
            elseif ($resultado['clave_usuarios'] === $clave && $resultado['id_rol_FK'] ==' 3'){
                $jTableResult['rspst'] = "3";  // Respuesta positiva, clave encontrada
                $jTableResult['msj'] = "Clave verificada exitosamente."; // Mensaje opcional
                
                // Establece las variables de sesión
                $_SESSION['id_usu'] = $resultado['id_usuario'];
                $_SESSION['nombre_usu'] = $resultado['nombres_usuarios'];
                $_SESSION['apellido_usu'] = $resultado['apellidos_usuarios'];
            }
            
            else {
                // Clave no encontrada
                $jTableResult['msj'] = "Esta clave no existe";
                $jTableResult['rspst'] = "0";  // Respuesta negativa
            }
            
            // Devuelve la respuesta en formato JSON
            print json_encode($jTableResult);
            break;
        
        

            case 'crearClave':
                $jTableResult = array();
                $claveNew = $_POST['claveNew'];
                $claveNew1 = $_POST['claveNew1'];
                $correo = $_POST['correo1'];
                $rh = $_POST['newRH'];
            
                $jTableResult['msj'] = "";
                $jTableResult['rspst'] = "";
            
                if (empty($claveNew) || empty($claveNew1)) {   
                    $jTableResult['msj'] = "Uno o varios campos están sin diligenciar.";
                    $jTableResult['rspst'] = "0";
                } else {
                    // Verificar que las contraseñas coincidan
                    if ($claveNew == $claveNew1) {
                        // Verificar longitud mínima de la clave
                        if (strlen($claveNew) >= 6) {
                            $query = "SELECT clave_usuarios FROM usuarios WHERE correo_usuarios='$correo'";
                            $consulta = mysqli_query($conn, $query);
                            $resultado = mysqli_fetch_array($consulta);
            
                            if ($resultado == true) {
                                $query = "UPDATE usuarios SET estado='1', clave_usuarios = '".trim($claveNew)."', id_rhFK = '".trim($rh)."' WHERE correo_usuarios ='$correo'";                    
                                if ($result = mysqli_query($conn, $query)) {
                                    $jTableResult['rspst'] = "1";	
                                } else {
                                    $jTableResult['msj'] = "Se presentó un error. Intenta nuevamente.";
                                    $jTableResult['rspst'] = "0"; 
                                }
                            }
                        } else {
                            $jTableResult['msj'] = "La clave debe tener al menos 6 caracteres.";
                            $jTableResult['rspst'] = "0";
                        }
                    } else {
                        $jTableResult['msj'] = "Las claves no coinciden. Verifica.";
                        $jTableResult['rspst'] = "0";
                    }
                }					
            print json_encode($jTableResult);
            break;
            

    }





?>                                                                                                          