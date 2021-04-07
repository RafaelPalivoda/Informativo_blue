<?php
ini_set('display_errors', true );
ini_set('error_reporting', E_ALL );
require 'C:xampp\phpMyAdmin\vendor\autoload.php';
require '../php/PDFPageGenerator.php';

$texto = $_POST["texto"];
$subtitulo = $_POST["sub_marketing"];
$texto = nl2br($texto);

$template = '../html/Informativo_marketing.html';

$filename = '../processados/' . md5( time() ) .'.pdf';

try {
    $pdfGenerator = new \App\PDFPageGenerator();

    $htmlContent = $pdfGenerator->generateHtml( $subtitulo, $texto, $template );

    $pdfFiloe = $pdfGenerator->generate( $htmlContent, $filename );
    header("Content-type:application/pdf");

    echo file_get_contents( $filename );
}catch ( \Exception $e )
{
    echo $e->getMessage();
}
define("HOST", "002.hqssolucoes.com.br");
define("PATH", "/smb/file-manager/list/domainId/10/httpsdocs");
define("LOGIN", "admin");
define("PASSWD", 'hqs@HQS!@#');
define("FILENAME", $filename);

function write_callback($ch, $data)
{
echo $data;
return strlen($data);
}

function uploadFile($filename)

{$url = "https://" . HOST . ":8443" . PATH;

$headers = array(
"HTTP_AUTH_LOGIN: " . LOGIN,
"HTTP_AUTH_PASSWD: " . PASSWD,
"HTTP_PRETTY_PRINT: TRUE",
"Content-Type: multipart/form-data;",
);


$ch = curl_init();


curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_POSTFIELDS, array
('sampfile'=>"@$filename"));

$result = curl_exec($ch);

if (curl_errno($ch)) {
echo "\n\n-------------------------\n" .
"cURL error number:" .
curl_errno($ch);
echo "\n\ncURL error:" . curl_error($ch);
}

curl_close($ch);



return;
}

uploadFile(realpath(FILENAME));
?>