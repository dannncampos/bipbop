<?php

require "vendor/autoload.php";

$tribunal = 'TJSP';
$consulta = 'ConsultaPorNumeroOAB';
$numeroOab = '368336-SP';
$amount = '3';
$label = 'Nome';

$pushesGenerator = new \BIPBOP\Useful\PushesGenerator($tribunal, $consulta, $numeroOab);

echo "<pre>";
print_r($pushesGenerator->createPushes($amount, $label));
echo "</pre>";