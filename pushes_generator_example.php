<?php

require "vendor/autoload.php";

$tribunal = 'TJSP';
$consulta = 'ConsultaPorNumeroOAB';
$numeroOab = '945179-SP';

$pushesGenerator = new \BIPBOP\Useful\PushesGenerator($tribunal, $consulta, $numeroOab);

echo "<pre>";
print_r($pushesGenerator->createPushes(/*'Limit, Label'*/));
echo "</pre>";