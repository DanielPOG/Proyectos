<?php
/**
 * Ejemplo 1 para generar códigos de barras
 * con PHP
 *
 * Generar un código de barras que dice "parzibyte.me"
 *
 * @author parzibyte
 */

# Incluimos el autoload
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
echo $htmlGenerado;
?>
