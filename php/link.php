<?php
define("HOST", "191.250.24.214");
define("PATH", "/smb/file-manager/list/domainId/10");
define("LOGIN", "admin");
define("PASSWD", 'hqs@HQS!@#');
define("FILENAME", $_POST['link']);

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