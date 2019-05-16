<?php

require "vendor/autoload.php";

$pushesGenerator = new \BIPBOP\Useful\PushesGenerator;

echo "<pre>";
print_r($pushesGenerator->showPushes());
echo "</pre>";