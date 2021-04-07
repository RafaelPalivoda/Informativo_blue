<?php

use App\PDFPageGenerator;

ini_set('display_errors', true );
ini_set('error_reporting', E_ALL );
require '../vendor/autoload.php';
require '../php/PDFPageGenerator.php';

$texto = $_POST["texto_financeiro"];
$subtitulo = $_POST["sub_financeiro"];
$texto = nl2br($texto);

$template = '../html/Informativo_financeiro.html';

$filename = '../processados/' . md5( time() ) .'.pdf';

try {
    $pdfGenerator = new PDFPageGenerator();

    $htmlContent = $pdfGenerator->generateHtml( $subtitulo, $texto, $template );
    $pdfFiloe = $pdfGenerator->generate( $htmlContent, $filename );
    header("Content-type:application/pdf");

    echo file_get_contents( $filename );
}catch ( \Exception $e )
{
    echo $e->getMessage();
}
?>