<?php

require('ean13/ean13.php'); // Asegúrate de que la ruta sea correcta

$id = $_GET['id'];
$user = $_GET['user'];
include('conex.php');
$link = conexion();

// Usuario
$sql = "SELECT * FROM usuario WHERE id_usuario='$id'";
$consulta = mysqli_query($link, $sql);
$resultado = mysqli_fetch_array($consulta);

// Para rol
$sql = "SELECT tipo_rol FROM rol WHERE id_rol='$resultado[6]'";
$consultar = mysqli_query($link, $sql);
$resultador = mysqli_fetch_array($consultar);

// Para rh
$sql = "SELECT tipo_rh FROM rh WHERE id_rh='$resultado[7]'";
$consultarh = mysqli_query($link, $sql);
$resultadorh = mysqli_fetch_array($consultarh);

// Para tipodoc
$sql = "SELECT tipo FROM tipo_doc WHERE id_tipo_doc='$resultado[3]'";
$consultat = mysqli_query($link, $sql);
$resultadot = mysqli_fetch_array($consultat);

class PDF extends PDF_EAN13 {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('https://certificadossena.net/wp-content/uploads/2022/10/logo-sena-negro-png-2022-300x294.png', 8, 6, 20);
        // Arial bold 10
        $this->SetFont('Arial', 'B', 10);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 13, 'Carnet', 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    function carnet($nombre, $apellido, $doc, $rol, $rh, $tipodoc, $foto, $codigo) {
        // Logo
        $this->Image('https://certificadossena.net/wp-content/uploads/2022/10/logo-sena-negro-png-2022-300x294.png', 75, 65, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Salto de línea
        $this->Ln(42);
        // Movernos a la derecha
        $this->Cell(90);
        // Información del usuario
        $this->Cell(30, 13, $rol, 'C');
        $this->Ln(1);
        $this->Cell(60);
        $this->SetTextColor(28, 176, 71);
        $this->Cell(30, 13, '_________', 'C');
        $this->Ln(9);
        $this->Cell(65);
        $this->Cell(30, 13, $nombre, 'C');
        $this->Ln(8);
        $this->Cell(65);
        $this->Cell(30, 13, $apellido, 'C');
        $this->Ln(9);
        $this->Cell(70);
        $this->SetTextColor(18, 19, 18);
        $this->Cell(9, 13, $tipodoc, 'C');
        $this->Cell(10, 13, $doc, 'C');
        $this->Ln(10);
        $this->Cell(66);
        $this->Cell(18, 13, 'RH:', 'C');
        $this->Cell(10, 13, $rh, 'C');
        $this->Ln(15);

        // Aquí se añade el código de barras
        $this->Cell(64);
        $this->SetFont('Arial', 'B', 25);
        $this->EAN13(80, $this->GetY(), $codigo);
        $this->Ln(15);
        $this->Cell(61);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(8, 13, '__', 'C');
        $this->Ln(6);
        $this->Cell(64);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(8, 13, 'Regional Cauca', 'C');
        $this->Ln(6);
        $this->Cell(64);
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(28, 176, 71);
        $this->Cell(8, 13, 'Centro Agropecuario', 'C');

        // Generar el código de barras
        $this->Ln(10); // Espacio antes del código de barras // Ajusta la posición y el código
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Cell(60);
$pdf->Cell(70, 10, $resultado[1], 1, 1, 'C');

// Aquí pasamos el código para el código de barras
$codigo = '1061716233'; // Reemplaza con el código que deseas
$pdf->carnet($resultado[1], $resultado[2], $resultado[4], $resultador[0], $resultadorh[0], $resultadot[0], $resultado[10], $codigo);

$pdf->Output();
?>




 


    





?>