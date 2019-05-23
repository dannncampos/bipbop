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
		$processes = $this->getPushes($data);
		$pushes = $processes['ids'];
		$nonPushes = $processes['nonPushes'];
		is_dir("Documents") ?: mkdir ('Documents', 0755);

		$saveDocument = function ($id){
			$this->dom = $this->pushJuristek->open($id);
			$file = fopen('Documents/'.$id, 'w+');
			fwrite($file, $this->dom->saveXML());
			fclose($file);
			return $this->dom;
		};

		foreach ($pushes as $id) {
			sleep(5);
			try {
				$xpath[] = $saveDocument($id);
			} catch (MyException $e) {
				if ($erro = ($e->getCode() == 33)) {
					$count = 0;
					$max = 3;
					while ($erro  == 33 || $count == $max) {
						sleep(2);
						try {
							$xpath[] = $saveDocument($id);
							break;
						} catch (MyException $e) {
							if ($e->getCode() != 33) {
								break;
							}
						}
						$count++;
				   	}		
				}
				continue;
			}
		}
		return $nonPushes;
	}
	private function getPushes($data)
	{
		foreach ($data as $key => $node) {
			if (isset($node['id'])) {
				$ids[] = $node['id'];
				$processes['ids'] = $ids;
			} else {
				$nonPushes[$key] = $node;
				$processes['nonPushes'] = $nonPushes;
			}
		}
		return $processes;
	}
}