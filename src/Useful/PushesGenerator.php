<?php

namespace BIPBOP\Useful;

use BIPBOP\Useful\SearchOab;
use BIPBOP\Useful\PushesCreator;

class PushesGenerator {
	private $searchOab;
	private $pushesCreator;
	function __construct(){
		$this->searchOab = new SearchOab();
		$this->pushesCreator = new PushesCreator();
	}
	public function showProcess(){
		$xpath = $this->searchOab->oabCapture();
		$response = $this->searchOab->parseData($xpath);
		return $response;
	}
	public function showPushes(){
		$pushes = $this->pushesCreator->createPush($this->showProcess());
		return $pushes;
	}
}