<?php

require "vendor/autoload.php";

$tribunal = 'TJSP';
$consulta = 'ConsultaPorNumeroOAB';
$numeroOab = '245179-SP';

$getProcessByPush = new \BIPBOP\Useful\GetProcessByPush;
$pushesGeneratorByCnj = new \BIPBOP\Useful\PushesGeneratorByCnj;
$pushesGeneratorByOab = new \BIPBOP\Useful\PushesGeneratorByOab($tribunal, $consulta, $numeroOab);

$array = [
    [
        'numero_processo' => '1089270-19.2017.8.26.0100',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ],
    [
        'numero_processo' => '1003102-49.2019.8.57.0292'
    ],
    [
        'numero_processo' => '1002917-11.2019.8.26.0292',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ],
    [
        'numero_processo' => '1500974-33.2018.8.26.0292'
    ],
    [
        'numero_processo' => '1001179-85.2019.8.26.0292',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ],
    [
        'numero_processo' => '1001138-21.2019.8.26.0292'
    ],
    [
        'numero_processo' => '1000652-36.2019.8.26.0292',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ],
    [
        'numero_processo' => '1000419-39.2019.8.26.0292'
    ],
    [
        'numero_processo' => '1000524-16.2019.8.26.0292',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ],
    [
        'numero_processo' => '1000439-30.2019.8.26.0292'
    ],
    [
        'numero_processo' => '1000266-06.2019.8.26.0292',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ],
    [
        'numero_processo' => '1000159-59.2019.8.26.0292'
    ],
    [
        'numero_processo' => '1009588-84.2018.8.26.0292',
        'tribunal_nome' => 'TJSP',
        'tribunal_consulta' => 'PrimeiraInstancia'
    ]
];

$data = $pushesGeneratorByCnj->createPushes($array/*'Limit, Label'*/);

// $data = $PushesGeneratorByOab->createPushes(/*'Limit, Label'*/);

echo "------------------------------------------------------------------------------------";
echo "<br>|=== REGISTERED PUSHES AND PROCESSES ==|<br>";
echo "------------------------------------------------------------------------------------";
echo "<pre>";
print_r($data);
echo "</pre>";

$dom = $getProcessByPush->getProcess($data);

echo "------------------------------------------------------------------------------------";
echo "<br>|=== GETTING NO REGISTERED PUSHES ====|<br>";
echo "------------------------------------------------------------------------------------";
echo "<pre>";
print_r($dom);
echo "</pre>";