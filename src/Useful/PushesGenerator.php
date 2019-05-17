<?php

namespace BIPBOP\Useful;

use BIPBOP\Useful\SearchOab;
use BIPBOP\Useful\PushesCreator;

class PushesGenerator {
	private $searchOab;
	private $pushesCreator;
	function __construct($tribunal, $consulta, $numeroOab){
		$this->searchOab = new SearchOab($tribunal, $consulta, $numeroOab);
		$this->pushesCreator = new PushesCreator();
	}
	public function showProcess(){
		$xpath = $this->searchOab->oabCapture($tribunal, $consulta, $numeroOab);
		$response = $this->searchOab->parseData($xpath);
		return $response;
	}
	public function createPushes($amount, $label){
		$pushes = $this->pushesCreator->createPush($this->showProcess(), $amount, $label);
		return $pushes;
	}
}