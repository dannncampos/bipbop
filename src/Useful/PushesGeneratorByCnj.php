<?php

namespace BIPBOP\Useful;

use BIPBOP\Useful\PushesCreator;
use BIPBOP\Client\Exception as MyException;

class PushesGeneratorByCnj
{
	private $pushesCreator;
	function __construct()
	{
		$this->pushesCreator = new PushesCreator();
	}
	public function createPushes($data, $limit = 5, $label = NULL)
	{
		if (is_array($data)) {
			try {
				$pushes = $this->pushesCreator->createPush($data, $limit, $label);
				return $pushes;
			} catch (MyException $e) {
				return $e->getMessage();
			}
		}
		return "This array is not valid. Please, insert a valid array to create pushes!";
	}
}