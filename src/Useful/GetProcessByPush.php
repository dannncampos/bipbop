<?php

namespace BIPBOP\Useful;

use BIPBOP\Client\WebService;
use BIPBOP\Client\PushJuristek;
use BIPBOP\Client\Exception as MyException;

class GetProcessByPush
{
	private $dom;
	private $webService;
	private $pushJuristek;
	function __construct()
	{
		$this->webService = new WebService();
		$this->pushJuristek = new PushJuristek($this->webService);
	}
	public function getProcess($data)
	{	
		$pushes = $this->getPushes($data);
		$xpath = [];
		foreach ($pushes as $id) {
			try {
				$this->dom = $this->pushJuristek->open($id);
				$xpath[] = $this->dom;
			} catch (MyException $e) {
				if ($e->getCode() == 3) {
					return $e->getMessage();
				}
				if ($erro = ($e->getCode() == 33)) {						
					while ($erro  == 33) {							
				   		sleep(5);
						try {
							$this->dom = $this->pushJuristek->open($id);
							$xpath[] = $this->dom;
							$erro = null;
						} catch (MyException $e) {
							if ($e->getCode() != 33) {
								continue;
							}
						}	
				   	}		
				}
				return $e->getMessage();
			}
		}
		return $xpath;
	}
	private function getPushes($data)
	{
		foreach ($data as $node) {
			if (isset($node['id'])) {
				$ids[] = $node['id'];
			}
		}
		return $ids;
	}
}