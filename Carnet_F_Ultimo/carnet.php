<?php

include('conex.php');

require_once('code128.php');
require_once('fpdf/fpdf.php');

$link=conexion();
$user=$_GET['user'];
$id=$_GET['id'];

//Para USUARIO
$sql="SELECT * FROM usuario WHERE id_usuario='$id'";
$consulta=mysqli_query($link,$sql);
$resultado=mysqli_fetch_array($consulta);
//Para rol
$sql="SELECT tipo_rol FROM rol WHERE id_rol='$resultado[6]'";
$consultar=mysqli_query($link,$sql);
$resultador=mysqli_fetch_array($consultar);
//Para rh
$sql="SELECT tipo_rh FROM rh WHERE id_rh='$resultado[7]'";
$consultarh=mysqli_query($link,$sql);
$resultadorh=mysqli_fetch_array($consultarh);
//Para tipodoc
$sql="SELECT tipo FROM tipo_doc WHERE id_tipo_doc='$resultado[3]'";
$consultat=mysqli_query($link,$sql);
$resultadot=mysqli_fetch_array($consultat);


require_once "vendor/autoload.php";

# Indicamos que usaremos el namespace de BarcodeGeneratorHTML
use Picqer\Barcode\BarcodeGeneratorHTML;

# Crear generador
$generador = new BarcodeGeneratorHTML();

# Ajustes
$texto = "1013262891";
$tipo = $generador::TYPE_CODE_128;
# ¿Quieres todos los tipos? mira el código:
// https://github.com/picqer/php-barcode-generator/blob/master/src/BarcodeGenerator.php#L41

$htmlGenerado = $generador->getBarcode($texto, $tipo);
# Hora de imprimir
// echo $htmlGenerado;


class PDF extends PDF_Code128
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/ls.png',20,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Carnet',1,1,'C');
    // Salto de línea
    $this->Ln(20);
}
//$nombre,$apellido,$rol,$tipo_doc,$rh
function Carnet($rol,$nombre,$apellido,$tipo_doc,$numero_doc,$rh,$nombrefoto,$barras){
        // Arial italic 8
        $this->SetFont('Times','I',16);

        // Salto de línea
        $this->Ln(10);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Carnet',1,1,'C');

        // Salto de línea
        $this->Ln(30);
        // Movernos a la derecha
        $this->Cell(25);
        //LOGO SENA carnet
        $this->Image('img/ls.png',50,70,20);
        // Movernos a la derecha
        $this->Cell(65);
        //Imagen
        $this->Image('foto/'.$numero_doc.'/'.$nombrefoto,100,70,50);
       
        // $this->Image('fotos/'.$doc.'/'.$foto,110,65,20);   //Puede dar error si no tiene una carpeta con la imagen
        // $this->Cell(30,13,'Foto',1,0,'C');
        
        // Salto de línea
        $this->Ln(30);
        // Movernos a la derecha
        $this->Cell(45);
        //Palabra
        $this->Cell(1,1,$rol,0,1 ); 
        // Movernos a la derecha
        $this->Cell(35);
        //COLOR VERDE
        $this->SetTextColor(28,176,71);
        //LINEA
        $this->Cell(1,1,"_______________________________________________",0,1 );      
        
        // Salto de línea
        $this->Ln(15);
        
        // Movernos a la derecha
        $this->Cell(35);
        //Palabra
        $this->Cell(1,1,$nombre,0,1 );   

        // Salto de línea
        $this->Ln(10);
        // Movernos a la derecha
        $this->Cell(35);
        //Palabra
        $this->Cell(1,1,$apellido,0,1 );   
        
        // Salto de línea
        $this->Ln(10);
        //COLOR NEGRO
        $this->SetTextColor(18,19,18);
        // Movernos a la derecha
        $this->Cell(40);
        //Palabra
        $this->Cell(1,1,$tipo_doc.':',0,0 );   
        // Movernos a la derecha
        $this->Cell(10);
        //Palabra
        $this->Cell(1,1,$numero_doc,0,1 );   

        // Salto de línea
        $this->Ln(10);
        // Movernos a la derecha
        $this->Cell(35);
        //Palabra
        $this->Cell(1,1,"RH:",0,0 );   
        // Movernos a la derecha
        $this->Cell(10);
        //Palabra
        $this->Cell(1,1,$rh,0,1 );   

        // Salto de línea
        $this->Ln(15);
        // Movernos a la derecha
        $this->Cell(35);
        //LINEAS
      
        
        $this->Cell(1,1,"__",0,0 );     

        // Salto de línea
        $this->Ln(10);
        // Movernos a la derecha
        $this->Cell(35);
        // Arial italic 8
        $this->SetFont('Times','I',25);
        //LINEA
        $this->Cell(1,1,$barras,0,1 );  



        // Salto de línea
        $this->Ln(20);
        // Movernos a la derecha
        $this->Cell(35);
        //Palabra
        $this->Cell(1,1,"Regional Cauca",0,1 );   

        // Salto de línea
        $this->Ln(10);
        //COLOR VERDE
        $this->SetTextColor(28,176,71);
        // Movernos a la derecha
        $this->Cell(35);
        //Palabra
        $this->Cell(1,1,"Centro Agropecuario",0,1 );   
}


// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada

$pdf = new PDF ();

$pdf->AddPage();
$pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)

$code='12345678901234567890';
$pdf->Code128(1,1,$code,50,50);
$pdf->SetXY(10,5);
$pdf1->Write(10,'C set: "'.$code.'"');

$pdf->Carnet($resultador[0],$resultado[1],$resultado[2],$resultadot[0],$resultado[4],$resultadorh[0],$resultado[10],$pdf1);

$pdf->Output();






 


    





?>