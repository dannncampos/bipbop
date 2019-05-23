<?php

namespace BIPBOP\Useful;

use BIPBOP\Client\WebService;
use BIPBOP\Client\PushJuristek;
use BIPBOP\Client\Exception as MyException;

class PushesCreator
{
	const LABEL = "Push";
	private $webservice;
	private $pushjuristek;
	function __construct()
	{	
		$this->webservice = new WebService();
		$this->pushjuristek = new PushJuristek($this->webservice);
	}
	public function createPush($processes, $limit = 5, $label = NULL)
	{	
		$limit = --$limit;
		if ($limit > count($processes)) {
			$limit = count($processes);
		}
		foreach ($processes as $key => $process) {
			sleep(1);
			$processnumber = $process['numero_processo'];
			if (isset($process['tribunal_nome']) && isset($process['tribunal_consulta'])) {
				$tribunal = $process['tribunal_nome'];
				$instancia = $process['tribunal_consulta'];
				try {
					$dompush = $this->pushjuristek->create($this->createLabel($label, $instancia, $processnumber), "http://api.webhookinbox.com/i/dv68NNUw/in/", "SELECT FROM '$tribunal'.'$instancia'", ["numero_processo" => "$processnumber"], false);
					$process['id'] = $dompush;
					$processes[$key] = $process;
				} catch (Exception $e) {
					continue;
				}
				if ($key == $limit) {
					break;
				}
			} else {
				try {
					$dompush = $this->pushjuristek->create($this->createLabel($label, 'CNJ', $processnumber), "http://api.webhookinbox.com/i/dv68NNUw/in/", "SELECT FROM 'CNJ'.'PROCESSO'", [
				"PROCESSO" => "$processnumber"
				], false);
					$process['id'] = $dompush;
					$processes[$key] = $process;
				} catch (Exception $e) {
					continue;
				}
				if ($key == $limit) {
					break;
				}
			}
		}
		return $processes;
	}
	private function createLabel($label, $instancia, $processnumber)
	{
		if (! is_null($label)) {
			return sprintf('%s%s%s', $label, $instancia, $processnumber);
		}
		return  sprintf('%s%s%s', static::LABEL, $instancia, $processnumber);
	}
}