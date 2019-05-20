<?php

namespace BIPBOP\Useful;

use BIPBOP\Useful\SearchOab;
use BIPBOP\Useful\PushesCreator;
use BIPBOP\Client\Exception as MyException;

class PushesGenerator 
{
	private $searchOab;
	private $pushesCreator;
	function __construct($tribunal, $consulta, $numeroOab)
	{
		$this->searchOab = new SearchOab($tribunal, $consulta, $numeroOab);
		$this->pushesCreator = new PushesCreator();
	}
	public function showProcess()
	{	
		try {
			$xpath = $this->searchOab->oabCapture();
		} catch (MyException $e) {
			return $e->getMessage();
		}
		return $this->searchOab->parseData($xpath);
	}
	public function createPushes($limit = 5, $label = NULL)
	{	
		$data = $this->showProcess();
		if (is_array($data)) {
			$pushes = $this->pushesCreator->createPush($data, $limit, $label);
			return $pushes;
		}
		return $data;
	}
}