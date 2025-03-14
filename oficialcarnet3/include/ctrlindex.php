<?php
require_once('config.php'); 
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
include('conex.php');
session_name($session_name);
session_start();
$conn=Conectarse();
//require_once('consultas.php');
// $ObjConsultas = new ayudas();
switch ($_REQUEST['action']) 
	{
		
		// case 'inicioSesion':
		// 	$jTableResult = array();
		// 	$query="SELECT *
		// 			FROM   usuarios 
		// 			WHERE  correo_usuarios='".trim($_POST['correoLog'])."' 
		// 			AND clave_usuarios='".trim($_POST['claveLog'])."';";				
		// 		$regis = mysqli_query($conn, $query);
		// 		$numero = mysqli_num_rows($regis);
		// 		if(($_POST['correoLog']==NULL) or ($_POST['claveLog']==NULL) ) 
		// 		{
		// 			$jTableResult['msj']= "Uno o varios campos ";
		// 			$jTableResult['msj'].= "están sin diligenciar.";
		// 			$jTableResult['rspst']= "0";	
					
				
					
		// 		}
		// 		else{
		// 			if($numero==0){
		// 				$jTableResult['msj']= "No existe.";
		// 				$jTableResult['rst']= "0"; 	
		// 			}
		// 			else if($numero==1){ 
		// 				$jTableResult['msj']= "Entrando";
		// 				$jTableResult['rst']= "1"; 			

		// 				while($registro = mysqli_fetch_array($regis))
		// 				{	
		// 					// if($registro['estado']=="0"){
		// 					// 	$jTableResult['msj_DelSistema']="USUARIO SIN PERMISOS DE ENTRADA.";
		// 					// 	$jTableResult['Resultado']= "0";
		// 					// }else{	
								
		// 					// }								
		// 					$_SESSION['id_usu'] = $registro['id_usuario'];
		// 					$_SESSION['nombre_usu']	= $registro['nombres_usuarios'];
		// 					 $_SESSION['apellido_usu'] = $registro['apellidos_usuarios'];
				
		// 				}	
		// 			}
		// 		}
		// 	print json_encode($jTableResult);
		// break;

		
			
		case 'registrarUsuario':

			$jTableResult = array();
     
				$jTableResult['msj']="";
				$jTableResult['rspst']="";
				if(($_POST['nombreNewReg']==NULL) or ($_POST['numDocNewReg']==NULL) or ($_POST['apellidoNewReg']==NULL) or ($_POST['clave']==NULL) or ($_POST['tipoDocNewReg']==0) or ($_POST['correoNewReg']==NULL)  or ($_POST['deptoNewReg']==0)) 
				{   
						$jTableResult['msj']= "Uno o varios campos ";

						$jTableResult['msj'].= "están sin diligenciar.";
						$jTableResult['rspst']= "0";	
				}else{
						$query ="SELECT id_usuario FROM usuarios WHERE numero_doc='".$_POST['numDocNewReg']."'";
						$resultado = mysqli_query($conn, $query);
						$numero = mysqli_num_rows($resultado);

						$query ="SELECT correo_usuarios FROM usuarios WHERE correo_usuarios='".$_POST['correoNewReg']."'";
						$resultado = mysqli_query($conn, $query);
						$correo = mysqli_num_rows($resultado);
						

						
						if($numero>0){
								$jTableResult['msj']= "El numero de documento ya existe.";
								$jTableResult['rspst']= "0";

								
								
								
						}else{
							if($correo>0){
								$jTableResult['msj']= "El correo ya existe.";
								$jTableResult['rspst']= "0";
							}else{
									$query="INSERT INTO usuarios
									SET
									nombres_usuarios='".trim($_POST['nombreNewReg'])."',
									apellidos_usuarios='".trim($_POST['apellidoNewReg'])."', 
									clave_usuarios='".trim($_POST['clave'])."', 
									id_tipo_doc_FK='".trim($_POST['tipoDocNewReg'])."', 
									telefono='".trim($_POST['telefonoNewReg'])."', 
									dir_usuarios='".trim($_POST['direccionNewReg'])."', 
									correo_usuarios='".trim($_POST['correoNewReg'])."',
									codMuni_FK='".trim($_POST['municipioNewReg'])."',
									codDepto_FK='".trim($_POST['deptoNewReg'])."',
									fecha='".trim($_POST['fechaReg'])."',
									estado='0',
									numero_doc='".trim($_POST['numDocNewReg'])."'; "; 
									if($result=mysqli_query($conn,$query)){

									
									$jTableResult['msj']= "Registro realizado con éxito.";
									$jTableResult['rspst']= "1";	
									
									}else{  $jTableResult['msj']= "Se presento un error. Intenta nuevamente.";
									$jTableResult['rspst']= "0"; 
									}
							}
							
							}
				}					
			print json_encode($jTableResult);
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