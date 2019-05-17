<?php

require "vendor/autoload.php";

$tribunal = 'TJSP';
$consulta = 'ConsultaPorNumeroOAB';
$numeroOab = '368336-SP';

$pushesGenerator = new \BIPBOP\Useful\PushesGenerator($tribunal, $consulta, $numeroOab);

echo "<pre>";
print_r($pushesGenerator->createPushes());
echo "</pre>";