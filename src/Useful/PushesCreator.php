<?php

namespace BIPBOP\Useful;

use BIPBOP\Client\WebService;
use BIPBOP\Client\PushJuristek;

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
			$tribunal = $process['tribunal_nome'];
			$instancia = $process['tribunal_consulta'];
			$processnumber = $process['numero_processo'];
			$dompush = $this->pushjuristek->create($this->createLabel($label, $instancia, $processnumber), "http://api.webhookinbox.com/i/dv68NNUw/in/", "SELECT FROM 'JURISTEK'.'INFO'", ["data" => "SELECT FROM '$tribunal'.'$instancia' WHERE 'numero_processo' = '$processnumber'"], false);
			$process['id'] = $dompush;
			$processes[$key] = $process;
			if ($key == $limit) {
				break;
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