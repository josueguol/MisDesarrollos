<?php

$filename = '../application/config/app.ini';
$authfile = $filename;
$size = filesize($authfile);
$fp   = fopen($authfile, 'r');
$iniFile = fread($fp, $size);
require( '../library/My/slowaes/aes_fast.php');
require( '../library/My/slowaes/cryptoHelpers.php');
require( '../library/My/slowaes/crypt.php');
$key = 'www.aztecatrends.com';
$encrip = encrypt($iniFile,$key);
$archivo="../application/config/appEncrypt.ini";
$handle = fopen($archivo, "w");
fwrite($handle, $encrip);
fclose($handle);
die('Archivo appEncrypt.ini generado con exito');
?>
