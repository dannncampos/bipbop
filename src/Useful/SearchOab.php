<?php

namespace BIPBOP\Useful;

use BIPBOP\Client\WebService;

class SearchOab {
	private $dom;
	public $processes;
	private $webservice;
	function __construct()
	{
		$this->webservice = new WebService();
	}
	public function oabCapture() {
		try {
			$this->dom = $this->webservice->post("SELECT FROM 'JURISTEK'.'INFO'", ["data" => "SELECT FROM 'TJSP'.'ConsultaPorNumeroOAB' WHERE 'numero_oab'='368336-SP'"]);
		} catch (Exception $e) {
			print_r($e->getMessage());
		}
		return new \DOMXpath($this->dom);
	}
	public function parseData($data) {
		foreach ($data->query('//processo') as $process) {
			$processnumber = $data->query("./numero_processo", $process);
			$tribunal = $data->query("./tribunal_nome", $process);
			$local = $data->query("./tribunal_consulta", $process);
			$this->data['numero_processo'] = $processnumber->item(0)->nodeValue;
			$this->data['tribunal_nome'] = $tribunal->item(0)->nodeValue;
			$this->data['tribunal_consulta'] = $local->item(0)->nodeValue;
			$this->processes[] = $this->data;
		}
		return $this->processes;
	}
}