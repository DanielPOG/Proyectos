<?php

include_once('conex.php');
require_once('config.php'); 
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn=Conectarse();
switch ($_REQUEST['action']) 
	{
		case 'crgrDepto':			
			$jTableResult = array();				
				$jTableResult['listDepto']="";
				$jTableResult['listDepto']="<option value='0' selected >seleccione:.</option>";
				$query=" SELECT codDepto, nombreDepto FROM departamento; ";
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listDepto'].="<option value='".$registro['codDepto']."'>".$registro['nombreDepto']."</option>";
					}		
			print json_encode($jTableResult);
		break;		
		
		case 'crgrNomFicha':			
			$jTableResult = array();				
				$jTableResult['listFicha']="";
				$jTableResult['listFicha']="<option value='0' selected >seleccione:.</option>";
				$query=" SELECT idPrograma, nombrePrograma FROM nombreprograma; ";
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listFicha'].="<option value='".$registro['idPrograma']."'>".$registro['nombrePrograma']."</option>";
					}		
			print json_encode($jTableResult);
		break;	
		case 'crgrMuni':
			$jTableResult = array();		
				
				$jTableResult['listMuni']="";
				$jTableResult['listMuni']="<option value='0' selected >seleccione.</option>";
				$query="SELECT codMuni,nombreMuni FROM municipios WHERE codDepto='".$_POST['deptoNewReg']."'";
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listMuni'].="<option value='".$registro['codMuni']."'>".$registro['nombreMuni']."</option>";
						
					}
			print json_encode($jTableResult);
		break;
		
	}		
mysqli_close($conn);
?>