
<?php 


include  ("conex.php"); //Archivo para conectar base de dato

$link= conexion(); //Estable conexion
$user=$_POST['user'];


$archivo=$_FILES['lote'];
$tmparchivo=$archivo['tmp_name'];
$nombrelote=$archivo['name'];
$ruta='borrables/'.$nombrelote;
move_uploaded_file($tmparchivo,$ruta);
$infoarchivo=explode("_",$nombrelote);
$mificha=$infoarchivo[0]; 
$mifecha=$infoarchivo[1]; 
$mifecha2=explode(".",$infoarchivo[1]);
$alarma="";



$lineas=file($ruta);
$longmat=count($lineas);
// echo "el archivo tiene:".$longmat;

for ($i=0;$i<=$longmat;$i++){
    // echo $lineas[$i]."-".$i."<br>";
   
    $trozos=explode(";", $lineas[$i]);
    $om=count($trozos);
    for($ii=0;$ii<$om;$ii++){
        
        if($ii==2){
            switch($trozos[$ii]){
                case 'CC':
                    $tipo=1;
                    break;

                case 'TI':
                    $tipo=2;
                    break;
                case 'CE':
                    $tipo=3;
                    break;
                case 'PP':
                    $tipo=4;
                    break;
                case 'LM':
                    $tipo=5;
                    break;
                        
                default:
                $tipo=20;
                break;
            }
                
            //echo $trozos[$ii]."-".$ii."-".$tipo."<br>";
    
        }
        
    }
    $sql2="SELECT * FROM usuario WHERE numero_doc='$trozos[3]'";
    $consulta2= mysqli_query($link,$sql2); //Envia consulta a BD
    if ($resultado2=mysqli_fetch_array($consulta2)){
          //header("location:principal.php?user=2");
        $alarma=$trozos[3]."-".$alarma;    
    }
    else{
        $sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, id_tipo_doc_FK, numero_doc, password, id_rol_FK,id_rh_FK,cod_fichas,fechavencimiento, foto, estado)
        VALUES ('$trozos[0]','$trozos[1]','$tipo','$trozos[3]','$trozos[3]','1','1','$mificha','$mifecha2[0]','nada.png','$trozos[4]')";//Consulta 
        $consulta= mysqli_query($link,$sql); //Envia consulta a BD
        
    }
    header("location:principal.php?user=$user");



    
}





//var_dump($_FILES);


// 
//     if(is_dir($ruta)){
//         move_uploaded_file($tmparchivo,$ruta.$nombrefoto);
//     }
//     else{
//         mkdir($ruta,0777);
//         move_uploaded_file($tmparchivo,$ruta.$nombrefoto);
//     }

//     $sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, id_tipo_doc_FK, numero_doc, password, id_rol_FK,id_rh_FK,cod_fichas,fechavencimiento, foto) VALUES ('$nombre', '$apellido', '$tipo_doc','$documento', '$password','$rol','$rh','$ficha','$fecha','$nombrefoto')";//Consulta 
//     $consulta= mysqli_query($link,$sql); //Envia consulta a BD
    
//     // $sql1="SELECT * FROM usuario ";
//     // $prueba=mysqli_query($link,$sql1);
//     // while($resultado=mysqli_fetch_array($prueba))
//     // {
//     // echo "Se registro correctamente el usuario: ". $resultado[0]. "<br>";
    
    
//     // }
//     header("location:principal.php?user=".$user);
// }




?>


