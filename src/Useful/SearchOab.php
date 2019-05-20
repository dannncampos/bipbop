<?php

namespace BIPBOP\Useful;

use BIPBOP\Client\WebService;
use BIPBOP\Client\Exception as MyException;

class SearchOab 
{
	private $dom;
	public $processes;
	private $webservice;
	protected $tribunal;
	protected $consulta;
	protected $numeroOab;
	function __construct($tribunal, $consulta, $numeroOab)
	{	
		$this->tribunal = $tribunal;
		$this->consulta = $consulta;
		$this->numeroOab = $numeroOab;
		$this->webservice = new WebService();
	}
	public function oabCapture()
	{
		try {
			$query = ["data" => "SELECT FROM '$this->tribunal'.'$this->consulta' WHERE 'numero_oab'='$this->numeroOab'"];
			$this->dom = $this->webservice->post("SELECT FROM 'JURISTEK'.'INFO'", $query);
		} catch (MyException $e) {
			throw new MyException($e->getMessage());
		}
		return new \DOMXpath($this->dom);
	}
	public function parseData($data)
	{
		foreach ($data->query('//processo') as $process) {
			$processnumber = $data->query("./numero_processo", $process);
			$tribunal = $data->query("./tribunal_nome", $process);
			$local = $data->query("./tribunal_consulta", $process);
			$node['numero_processo'] = $processnumber->item(0)->nodeValue;
			$node['tribunal_nome'] = $tribunal->item(0)->nodeValue;
			$node['tribunal_consulta'] = $local->item(0)->nodeValue;
			$this->processes[] = $node;
		}
		return $this->processes;
	}
}