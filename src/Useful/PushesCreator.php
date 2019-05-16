<?php

namespace BIPBOP\Useful;

use BIPBOP\Client\WebService;
use BIPBOP\Client\PushJuristek;

class PushesCreator{
	private $webservice;
	private $pushjuristek;
	function __construct(){
		$this->webservice = new WebService();
		$this->pushjuristek = new PushJuristek($this->webservice);
	}
	public function createPush($processes){
		foreach ($processes as $key => $process) {
			sleep(1);
			$label = $process['tribunal_consulta'].$process['numero_processo'];
			$tribunal = $process['tribunal_nome'];
			$instancia = $process['tribunal_consulta'];
			$processnumber = $process['numero_processo'];
			$dompush = $this->pushjuristek->create($label, "http://api.webhookinbox.com/i/dv68NNUw/in/", "SELECT FROM 'JURISTEK'.'INFO'", ["data" => "SELECT FROM '$tribunal'.'$instancia' WHERE 'numero_processo' = '$processnumber'"], false);
			$process['id'] = $dompush;
			$processes[$key] = $process;
			if ($key > 5) {
				break;
			}
		}
		return $processes;
	}
}