<?php

require "vendor/autoload.php";

$tribunal = 'TJSP';
$consulta = 'ConsultaPorNumeroOAB';
$numeroOab = '245179-SP';

$pushesGenerator = new \BIPBOP\Useful\PushesGenerator($tribunal, $consulta, $numeroOab);
$getProcessByPush = new \BIPBOP\Useful\GetProcessByPush;

$data = $pushesGenerator->createPushes(/*'Limit, Label'*/);

echo "---------------------------------------------------------------";
echo "<br>|========= REGISTERED PUSHES =========|<br>";
echo "---------------------------------------------------------------";
echo "<pre>";
print_r($data);
echo "</pre>";

$dom = $getProcessByPush->getProcess($data);

echo "---------------------------------------------------------------";
echo "<br>|===== GETTING REGISTERED PUSHES =====|<br>";
echo "---------------------------------------------------------------";
echo "<pre>";
print_r($dom);
echo "</pre>";